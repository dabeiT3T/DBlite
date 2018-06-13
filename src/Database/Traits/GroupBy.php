<?php

namespace database\Traits;

trait GroupBy {
    
    protected $_groupBy = '';
    protected $_having  = '';

    /**
     * group by query
     */
    public function groupBy()
    {
        $args = [];
        foreach (func_get_args() as $key => $item) {
            $args[] = $item;
        }
        $this->_groupBy .= ($this->_groupBy? ', ': '').implode(', ', $args);
        return $this;
    }

    public function having()
    {
        // 
    }
}
