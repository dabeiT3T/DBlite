<?php

namespace Database\Traits;

trait OrderBy {

    protected $_orderBy= '';

    /**
     * order by query
     */
    public function orderBy($col, $order='ASC')
    {
        $this->_orderBy .= ($this->_orderBy? ', ': '').$col.' '.$order;
        return $this;
    }
}
