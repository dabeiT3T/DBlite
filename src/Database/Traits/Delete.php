<?php

namespace Database\Traits;

use Exception;

trait Delete {

    public function delete()
    {
        if ($this->_join || 
            $this->_groupBy || 
            $this->_orderBy || 
            $this->_skip
        )
            throw new Exception("Error Processing Request", 1);

        $exec = 'DELETE FROM ' . $this->_table;
        if ($this->_where)
            $exec .= " WHERE {$this->_where}";

        return $this->_db->exec($exec);
    }
}
