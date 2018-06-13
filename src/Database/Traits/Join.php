<?php

namespace Database\Traits;

trait Join {
    protected $_join = '';

    /**
     * join
     */
    public function join($table, $on)
    {
        $this->_join .= ($this->_join? ' ': '').'join '.$table.' on '.$on;
        return $this;
    }

    /**
     * left join
     */
    public function leftJoin($table, $on)
    {
        
    }

    /**
     * right join
     */
    public function rightJoin($table, $on)
    {
        
    }

    /**
     * outter join
     */
    public function outterJoin($table, $on)
    {
        
    }
}
