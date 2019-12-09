<?php

namespace App\traits;

trait Create
{

    public function create(array $attributes)
    {
        $fields = implode(',', array_keys($attributes));
        $values = ":".implode(', :', array_keys($attributes));
        $sql = "INSERT INTO {$this->table}({$fields}) VALUES ($values)";

        $create = $this->connect->prepare($sql);
        $create->execute($attributes);

        return $this->connect->lastInsertId();
    }

}
