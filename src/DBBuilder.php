<?php

class DBBuilder {
    protected $table = null;
    protected $db = null;
    protected $whereQuery = [];
    protected $joinQuery = [];
    protected $orderByQuery = [];
    protected $groupByQuery = [];

    protected $whereOperator = [
        '=', '>', '>=', '<', '<=', '<>',
    ];

    protected function getEnv()
    {
        $file = fopen(__DIR__ . '/env', 'r');
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

    protected function setDB()
    {
        $env = $this->getEnv();
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

    protected function quote($arg)
    {
        $safe = $this->db->quote($arg);
        $safe = strtr($safe, ['_'=>'\_', '%'=>'\%']);
        return $safe;
    }

    protected function where2Args($data)
    {
        $this->whereQuery[] = $data[0] . ' = ' . $this->quote($data[1]);
    }

    protected function where3Args($data)
    {
        if (!in_array($data[1], $this->whereOperator))
            throw new Exception("Error Processing Request", 1);
            
        $this->whereQuery[] = $data[0] . " {$data[1]} " . $this->quote($data[1]);
    }

    public function where()
    {
        if (func_num_args() == 2)
            $this->where2Args(func_get_args());
        else if (func_num_args() == 3)
            $this->where3Args(func_get_args());
        else
            throw new Exception("Error Processing Request", 1);
        
        return $this;
    }

    public function find($id, $col='id')
    {

    }

    public function first()
    {

    }

    public function all()
    {

    }
}
