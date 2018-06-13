<?php

namespace database;

use database\Traits\Join;
use database\Traits\Limit;
use database\Traits\Query;
use database\Traits\Utils;
use database\Traits\Delete;
use database\Traits\Insert;
use database\Traits\Update;
use database\Traits\Execute;
use database\Traits\GroupBy;
use database\Traits\OrderBy;

class DBBuilder {
    
    protected $_table    = null;
    protected $_db       = null;

    use Join, Limit, Utils, Query, Execute, GroupBy, OrderBy;
    use Delete, Insert, Update;

    protected function setDB()
    {
        $env = (new GetEnv)->getDBSets();
        $req = "{$env['DB_CONNECTION']}:host={$env['DB_HOST']};port={$env['DB_PORT']};dbname={$env['DB_DATABASE']}";
        $this->_db = new \PDO($req, $env['DB_USERNAME'], $env['DB_PASSWORD']);
    }

    /**
     * Creates a new instance.
     *
     * @param str table
     */
    public function __construct($table)
    {
        $this->_table = $table;
        $this->setDB();
    }

    public function __destruct() {}
}
