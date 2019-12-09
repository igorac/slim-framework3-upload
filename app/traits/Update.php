<?php

namespace App\traits;

trait Update
{
    public function update(array $attributes)
    {
        if (!isset($this->field) || !isset($this->value)) {
            throw new \Exception("Antes de fazer o update, por favor chame o find");
        }

        $this->sql = "UPDATE {$this->table} SET ";

        foreach($attributes as $field => $value) {
            $this->sql.= "{$field} = :{$field},";
        }

        $this->sql = rtrim($this->sql, ',');

        $this->sql.= " WHERE {$this->field} = :{$this->field}";


        $attributes['id'] = $this->value; // Valor do id


        $update = $this->connect->prepare($this->sql);
        return ($update->execute($attributes)) ? true : false;

        // return $update->rowCount();

    }

}
