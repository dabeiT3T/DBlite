<?php

namespace Database;

use Database\Traits\Join;
use Database\Traits\Limit;
use Database\Traits\Query;
use Database\Traits\Utils;
use Database\Traits\Delete;
use Database\Traits\Insert;
use Database\Traits\Update;
use Database\Traits\Execute;
use Database\Traits\GroupBy;
use Database\Traits\OrderBy;
use Database\Traits\Aggregation;

class DBBuilder {
    
    protected $_table    = null;
    protected $_db       = null;

    use Join, Limit, Utils, Query, Execute, GroupBy, OrderBy;
    use Delete, Insert, Update;
    use Aggregation;

    protected function setDB()
    {
        $env = (new GetEnv)->getDBIni();
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
