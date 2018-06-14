<?php

namespace Database\Traits;

use Exception;
use Database\DBlite;

trait Execute {

    public function first()
    {
        if (!$this->_db) throw new Exception("Error Processing Request", 1);

        $rows = $this->_db->query($this->combineQuery(), \PDO::FETCH_ASSOC);
        return $rows? $rows->fetch(): null;
    }

    public function all()
    {
        if (!$this->_db) throw new Exception("Error Processing Request", 1);

        $rows = $this->_db->query($this->combineALLQuery(), \PDO::FETCH_ASSOC);
        return $rows? $rows->fetchAll(): null;
    }

    public function get()
    {
        if (!$this->_db) throw new Exception("Error Processing Request", 1);

        $rows = $this->_db->query($this->combineQuery(), \PDO::FETCH_ASSOC);
        return $rows? $rows->fetchAll(): null;
    }

    public function find($id, $col='id')
    {
        if ($this->_join || 
            $this->_where || 
            $this->_groupBy || 
            $this->_orderBy || 
            $this->_skip ||
            $this->_take
        )
            throw new Exception("Error Processing Request", 1);
            
        $this->where($col, $id);

        return $this->first();
    }

    public function getIter()
    {
        if (!$this->_db) throw new Exception("Error Processing Request", 1);

        $rows = $this->_db->query($this->combineQuery(), \PDO::FETCH_ASSOC);
        while ($data = $rows->fetch()) {
            yield $data;
        }
    }

    public function paginate($per=15, $col='page', $page=null)
    {
        if ($this->_skip || $this->_take)
            throw new Exception("Error Processing Request", 1);

        // get page from $_GET
        if ($page === null) {
            $page = $_GET[$col] ?? 1;
        }

        $per    = max(intval($per), 1);
        $page   = max(intval($page), 1);
        $pages  = [];
        $pages['per_page'] = $per;
        $total  = intval(DBlite::table($this->_table)->select('COUNT(*) as total')->first()['total']);
        $pages['total'] = $total;
        $pages['last_page']     = (int)ceil($total/$per);
        $pages['current_page']  = min($page, $pages['last_page']);
        $pages['from']  = ($pages['current_page']-1) * $per + 1;
        $pages['to']    = $pages['from'] + min($per, $total-$pages['from']);
        $next = min($pages['current_page']+1, $pages['last_page']);
        $prev = max($pages['current_page']-1, 1);
        $pages['next_page_url'] = $pages['current_page'] == $pages['last_page']? null: "{$_SERVER['REQUEST_URI']}?page={$next}";
        $pages['prev_page_url'] = $pages['current_page'] == 1? null: "{$_SERVER['REQUEST_URI']}?{$col}={$prev}";

        // get data
        $this->_skip = $pages['from'] - 1;
        $this->_take = $per;
        $pages['data'] = $this->get();
        return $pages;
    }
}
