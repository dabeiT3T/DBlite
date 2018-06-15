<?php

namespace Database\Traits;

use Exception;
use Database\DBlite;

trait Aggregation {

    public function count($count='*')
    {
        if (!$this->_db) throw new Exception("Error Processing Request", 1);

        $rows = $this->_db->query($this->combineALLQuery("COUNT({$count}) as ct"), \PDO::FETCH_ASSOC);
        if (!$rows) throw new Exception("Error Processing Request", 1);
        return $rows->fetch()['ct'];
    }
}
