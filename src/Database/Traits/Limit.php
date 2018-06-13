<?php

namespace Database\Traits;

trait Limit {

    protected $_skip = 0;
    protected $_take = null;

    /**
     * skip
     */
    public function skip(int $skip)
    {
        $this->_skip = $skip;
        return $this;
    }

    /**
     * take
     */
    public function take(int $take)
    {
        $this->_take = $take;
        return $this;
    }
}
