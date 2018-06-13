<?php

namespace database\trait;

trait Limit {


    protected $skip = null;
    protected $take = null;

    /**
     * skip
     */
    public function skip(int $skip)
    {
        $this->skip = $skip;
        return $this;
    }

    /**
     * take
     */
    public function take(int $take)
    {
        $this->take = $take;
        return $this;
    }
}
