<?php

namespace App\traits;

use App\src\Paginate;
use Exception;

trait Read
{
    private $binds;
    private $paginate;

    public function select($fields = '*'): self
    {
        $this->sql = "SELECT {$fields} FROM {$this->table}";
        return $this;
    }

    public function where(): self
    {
        $num_args = func_num_args();
        $args     = func_get_args();

        $args = $this->whereArgs($num_args, $args);

        $this->sql .= " WHERE {$args['field']} {$args['operator']} :{$args['field']}";
        $this->binds = [
            $args['field'] => $args['value'],
        ];
        
        return $this;
    }

    private function whereArgs(int $num_args, array $args): array
    {
        if ($num_args < 2) {
            throw new \Exception("Opa, algo errado aconteceu, o where precisa de no mínimo 2 argumentos");
        }

        if ($num_args === 2) {
            $field = $args[0];
            $operator = '=';
            $value = $args[1];
        }

        if ($num_args === 3) {
            $field = $args[0];
            $operator = $args[1];
            $value = $args[2];
        }

        if ($num_args > 3) {
            throw new \Exception("Opa, algo errado aconteceu, o where não pode ter mais do que 3 argumentos");
        }

        return [
            'field' => $field,
            'operator' => $operator,
            'value' => $value
        ];
    }

    public function links()
    {
        return $this->paginate->links();
    }

    public function busca(string $fields): self
    {
        $fields = explode(',', $fields);

        $this->sql .= " WHERE ";
        foreach ($fields as $field) {
            $this->sql .= "{$field} LIKE :{$field} OR ";
            $this->binds[$field] = "%". buscaSanitize() ."%";
        }

        $this->sql = rtrim($this->sql, 'OR ');
        return $this;
    }

    public function paginate(int $perPage): self
    {
        $this->paginate = new Paginate;
        $this->paginate->records( $this->count() ); // retorna a quantidade de elementos na base de dados

        $this->paginate->paginate($perPage);

        $this->sql .= $this->paginate->sqlPaginate(); // Retorna a query com LIMIT e OFFSET


        
        return $this;
    }

    public function count()
    {
        $select = $this->bindAndExecute();
        return $select->rowCount();
    }

    public function get()
    {
        $select = $this->bindAndExecute();
        return $select->fetchAll();
    }

    public function first()
    {
        $select = $this->bindAndExecute();
        return $select->fetch();
    }

    private function bindAndExecute()
    {
        $select = $this->connect->prepare($this->sql);
        $select->execute($this->binds);

        return $select;
    }

}