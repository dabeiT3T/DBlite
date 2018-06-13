<?php

namespace database\trait;

trait Query {
    protected $select       = [];
    protected $whereQuery   = [];

    protected $whereOperator = [
        '=', '>', '>=', '<', '<=', '<>', '!=',
    ];

    /**
     * select
     */
    public function select()
    {

    }

    protected function quote($arg)
    {
        $safe = $this->db->quote($arg);
        $safe = strtr($safe, ['_'=>'\_', '%'=>'\%']);
        return $safe;
    }

    protected function where2Args($data)
    {
        $this->whereQuery[] = $data[0] . ' = ' . $this->quote($data[1]);
    }

    protected function where3Args($data)
    {
        if (!in_array($data[1], $this->whereOperator))
            throw new Exception("Error Processing Request", 1);
            
        $this->whereQuery[] = $data[0] . " {$data[1]} " . $this->quote($data[1]);
    }

    /**
     * where query
     */
    public function where()
    {
        if (func_num_args() == 2)
            $this->where2Args(func_get_args());
        else if (func_num_args() == 3)
            $this->where3Args(func_get_args());
        else
            throw new Exception("Error Processing Request", 1);
        
        return $this;
    }

    /**
     * where raw query
     */
    public function whereRaw($query)
    {

    }
}
