<?php

namespace App\traits;

trait Validations
{

    private $errors = [];

    protected function required(string $field): void
    {
        if (empty($_POST[$field])) {
            $this->errors[$field][] = flash($field, error('Esse campo é obrigatório'));
        }
    }

    protected function email(string $field): void
    {
        if (!filter_var($_POST[$field], FILTER_VALIDATE_EMAIL)) {
            $this->errors[$field][] = flash($field, error('Esse campo tem que ter um email válido'));
        }
    }

    protected function phone(string $field): void
    {
        if (!preg_match("/^\(?\d{2}\)?\s?\d{5}\s?-?\d{4}$/", $_POST[$field])) {
            $this->errors[$field][] = flash($field, error('Esse formato é inválido, por favor utilize o formato xx xxxxxxxxx'));
        }
    }

    protected function unique(string $field, string $model): void
    {
        $model = "App\\models\\" . ucfirst($model);
        $model = new $model();

        $find = $model->select()->where($field, $_POST[$field])->first();

        if ($find && !empty($_POST[$field])) {
            $this->errors[$field][] = flash($field, error("Esse valor já está cadastrado no banco de dados"));
        }
    }

    protected function max(string $field, string $max): void
    {
        if (mb_strlen($_POST[$field]) > $max) {
            $this->errors[$field][] = flash($field, error("O número de caracteres para esse campo não pode ser maior que {$max}"));
        }
    }

    protected function min(string $field, string $min): void
    {
        if (mb_strlen($_POST[$field]) < $min) {
            $this->errors[$field][] = flash($field, error("O número de caracteres para esse campo não pode ser menor que {$min}"));
        }
    }

    public function hasErrors(): bool
    {
        // return (count($this->errors) > 0) ? true : false;
        return !empty($this->errors);
    }

    public function errors()
    {
        dd($this->errors);
    }


}