<?php

namespace database;

class GetEnv {

    protected $path;
    /**
     * Creates a new instance
     *
     */
    public function __construct($path=__DIR__.'/../config/env')
    {
        $this->path = $path;
    }

    public function getDBSets()
    {
        $file = fopen($this->path, 'r');
        if ($file) {
            $data = [];
            while(($buffer = fgets($file)) !== false) {
                $tmp = explode('=', $buffer);
                if (count($tmp) != 2)
                    throw new Exception("Error Processing Request", 1);
                $data[trim($tmp[0])] = trim($tmp[1]);
            }
        } else
            throw new Exception("Error Processing Request", 1);

        return $data;
    }
}
