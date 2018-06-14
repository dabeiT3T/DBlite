<?php

namespace Database\Traits;

use Exception;

trait Query {
    protected $_select     = '';
    protected $_where   = '';

    protected $whereOperator = [
        '=', '>', '>=', '<', '<=', '<>', '!=', 'LIKE',
    ];

    /**
     * select
     */
    public function select()
    {
        $args = [];
        foreach (func_get_args() as $key => $item) {
            $args[] = $item;
        }

        $this->_select .= ($this->_select? ', ': '').implode(', ', $args);
        return $this;
    }

    protected function quote($arg)
    {
        $safe = $this->_db->quote($arg);
        $safe = strtr($safe, ['_'=>'\_', '%'=>'\%']);
        return $safe;
    }

    protected function where2Args($data, $operator)
    {
        if ($this->_where)
            $this->_where .= $operator;
        $this->_where .= '(' . $data[0] . ' = ' . $this->quote($data[1]) . ')';
    }

    protected function where3Args($data, $operator)
    {
        if (!in_array(strtoupper($data[1]), $this->whereOperator))
            throw new Exception("Error Processing Request", 1);
        
        if ($this->_where)
            $this->_where .= $operator;

        if (strtoupper($data[1]) != 'LIKE')
            $this->_where .= '(' . $data[0] . " {$data[1]} " . $this->quote($data[1]) . ')';
        else
            $this->_where .= '(' . $data[0] . " {$data[1]} " . $this->_db->quote($data[1]) . ')';
    }

    /**
     * where query(and)
     */
    public function where()
    {
        if (func_num_args() == 2)
            $this->where2Args(func_get_args(), ' AND ');
        else if (func_num_args() == 3)
            $this->where3Args(func_get_args(), ' AND ');
        else
            throw new Exception("Error Processing Request", 1);
        
        return $this;
    }

    /**
     * where query(or)
     */
    public function orWhere()
    {
        if (func_num_args() == 2)
            $this->where2Args(func_get_args(), ' OR ');
        else if (func_num_args() == 3)
            $this->where3Args(func_get_args(), ' OR ');
        else
            throw new Exception("Error Processing Request", 1);
        
        return $this;
    }

    /**
     * where raw(and)
     */
    public function whereRaw($raw)
    {
        if ($this->_where)
            $this->_where .= ' AND ';

        $this->_where .= '(' . $raw . ')';
    }

    /**
     * where raw(and)
     */
    public function orWhereRaw($raw)
    {
        if ($this->_where)
            $this->_where .= ' OR ';

        $this->_where .= '(' . $raw . ')';
    }
}
