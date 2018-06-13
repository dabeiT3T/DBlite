<?php

namespace Database;

class DBlite {

    /**
     * Creates a new instance
     *
     */
    public function __construct()
    {
        // self::$builder = $builder ? $builder : new DBBuilder($table);
    }

    public static function table($table)
    {
        return new DBBuilder($table);
    }
}

