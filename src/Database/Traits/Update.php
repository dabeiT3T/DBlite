<?php

namespace Database\Traits;

trait Update {

    protected function combineUpdate($data)
    {
        $prepare = '';
        $data['updated_at'] = date('Y-m-d H:i:s', time());
        foreach ($data as $key => $item) {
            $prepare .= "$key = $item, ";
        }

        return substr($prepare, 0, -2);
    }

    public function update(array $data)
    {
        if ($this->_join || 
            $this->_groupBy || 
            $this->_orderBy || 
            $this->_skip
        )
            throw new Exception("Error Processing Request", 1);

        $exec = 'UPDATE ' . $this->_table . ' SET ';
        $exec .= $this->combineUpdate($data);
        if ($this->_where)
            $exec .= " WHERE {$this->_where}";

        $this->_db->exec($exec);
        return $this->_db->rowCount();
    }
}
