<?php

namespace database\trait;

trait Execute {

    public function first()
    {
        if (!$this->db) throw new Exception("Error Processing Request", 1);
        
    }

    public function all()
    {
        if (!$this->db) throw new Exception("Error Processing Request", 1);
    }

    public function get()
    {
        if (!$this->db) throw new Exception("Error Processing Request", 1);
    }

    public function find($id, $col='id')
    {
        $this->whereQuery[] = 'id = ' . $this->quote($col);

        if (!$this->db) throw new Exception("Error Processing Request", 1);
    }

    public function __toString()
    {
        return '';
    }
}
