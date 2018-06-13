<?php

namespace database;

use database\trait\Join;
use database\trait\Limit;
use database\trait\Query;
use database\trait\Execute;
use database\trait\GroupBy;
use database\trait\OrderBy;

class DBBuilder {
    
    protected $table    = null;
    protected $db       = null;

    use Join, Limit, Query, Execute, GroupBy, OrderBy;

    protected function setDB()
    {
        $env = GetEnv::getDBSets();
        $req = "{$env['DB_CONNECTION']}:host={$env['DB_HOST']};port={$env['DB_PORT']};dbname={$env['DB_DATABASE']}";
        $this->db = new PDO($req, $env['DB_USERNAME'], $env['DB_PASSWORD']);
    }

    /**
     * Creates a new instance.
     *
     * @param str table
     */
    public function __construct($table)
    {
        $this->table = $table;
        $this->setDB();
    }

    public function __destruct()
    {
        if ($this->db)
            $this->db->close();
    }
}
