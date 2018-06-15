<?php

namespace Database\Traits;

use Exception;

trait Utils {

    protected function combineSelect($col=null)
    {
        $query = 'SELECT ';
        if (!$col) {
            if (!$this->_select)
                $query .= "* FROM {$this->_table}";
            else
                $query .= "{$this->_select} FROM {$this->_table}";
        } else
            $query .= "{$col} FROM {$this->_table}";

        return $query;
    }

    protected function combineQuery($select=null)
    {
        $query = $this->combineSelect($select);
        if ($this->_join)
            $query .= " {$this->_join}";
        if ($this->_where)
            $query .= " WHERE {$this->_where}";
        if ($this->_groupBy)
            $query .= " GROUP BY {$this->_groupBy}";
        if ($this->_orderBy)
            $query .= " ORDER BY {$this->_orderBy}";
        if ($this->_take !== null)
            $query .= " LIMIT {$this->_skip}, {$this->_take}";
        else if ($this->_skip)
            $query .= " LIMIT {$this->_skip}, 99999999";

        return $query;
    }

    protected function combineALLQuery()
    {
        if ($this->_join || 
            $this->_where || 
            $this->_groupBy || 
            $this->_orderBy || 
            $this->_skip ||
            $this->_take
        )
            throw new Exception("Error Processing Request", 1);

        $query = 'SELECT ';
        if (!$this->_select)
            $query .= "* FROM {$this->_table}";
        else
            $query .= "{$this->_select} FROM {$this->_table}";

        return $query;
    }

    public function beginTransaction()
    {
        return \PDO::beginTransaction();
    }

    public function commit()
    {
        return \PDO::commit();
    }

    public function rollBack()
    {
        return \PDO::rollBack();
    }

    public function __toString()
    {
        return $this->combineQuery() . "\n";
    }
}
