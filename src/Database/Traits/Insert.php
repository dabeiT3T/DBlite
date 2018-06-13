<?php

namespace Database\Traits;

use Exception;

trait Insert {

    protected function combineInsert($data)
    {
        $keys = '(';
        $values = '(';
        $data['created_at'] = date('Y-m-d H:i:s', time());
        $data['updated_at'] = date('Y-m-d H:i:s', time());
        foreach ($data as $key => $item) {
            $keys .= $key . ', ';
            $values .= $this->quote($item) . ', ';
        }

        $keys = substr($keys, 0, -2).')';
        $values = substr($values, 0, -2).')';
        return $keys . ' VALUES ' . $values;
    }

    public function create(array $data)
    {
        if ($this->_join || 
            $this->_where || 
            $this->_groupBy || 
            $this->_orderBy || 
            $this->_skip
        )
            throw new Exception("Error Processing Request", 1);

        $exec = "INSERT INTO {$this->_table} " . $this->combineInsert($data);

        $this->_db->exec($exec);
        return $this->_db->rowCount();
    }
}
