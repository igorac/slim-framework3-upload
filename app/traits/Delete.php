<?php

namespace App\traits;

trait Delete
{
    public function delete()
    {

        if (!isset($this->field) || !isset($this->value)) {
            throw new \Exception("Antes de fazer o delete, por favor chame o find");
        }

        $this->sql = "DELETE FROM {$this->table} WHERE {$this->field} = :{$this->field}";
        $delete = $this->connect->prepare($this->sql);
        $delete->bindValue(":$this->field", $this->value);
        $delete->execute();

        return $delete->rowCount();
    }
}
