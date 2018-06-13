<?php

namespace Database\Traits;

use Exception;

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

    public function paginate($per=15, $page=1)
    {
        
    }
}
