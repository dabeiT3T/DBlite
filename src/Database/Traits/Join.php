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
        $this->_join .= ($this->_join? ' ': '').'left join '.$table.' on '.$on;
        return $this;
    }

    /**
     * right join
     */
    public function rightJoin($table, $on)
    {
        $this->_join .= ($this->_join? ' ': '').'right join '.$table.' on '.$on;
        return $this;
    }

    /**
     * outter join
     */
    public function outerJoin($table, $on)
    {
        
    }
}
