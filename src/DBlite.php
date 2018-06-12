<?php
require_once (__DIR__ . '/DBBuilder.php'); 

class DBlite {

    /**
     * Instance of DBBuilder
     *
     * @var ImageManager
     */
    // public static $builder;

    /**
     * Creates a new instance
     *
     * @param WarpingManager $manager
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


$db = DBlite::table('apple');
