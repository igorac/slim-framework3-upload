<?php

namespace App\src;

use App\traits\Sanitize;
use App\traits\Validations;

class Validate
{
    use Validations, Sanitize;

    public function validate(array $rules): object
    {
        foreach ($rules as $field => $validation) {
            

            $validation = $this->validationWithParameter($field, $validation);

            if ($this->hasOneValidation($validation)) {
                $this->$validation($field); // $this->required($field) // $this->phone($field) ...
            }

            if ($this->hasTwoOrMoreValidation($validation)) {
                $validations = explode(':', $validation);

                foreach ($validations as $validation) {
                    $this->$validation($field);  // $this->required($field) // $this->phone($field) ...
                }
            }

        }

        return (object) $this->sanitize();
    }

    private function validationWithParameter(string $field, string $validation): string
    {

        $validations = []; // Inicializa como array vazio, para evitar erros, como no caso de não definir uma regra com ( @ )

        if (substr_count($validation, '@') > 0) {
            $validations = explode(':', $validation);
        } 

        foreach ($validations as $key => $value) {
            if (substr_count($value, '@') > 0) {
                list($validationWithParameter, $parameter) = explode('@', $value);

                $this->$validationWithParameter($field, $parameter);

                unset($validations[$key]); // Remove todas as regras que utilizam param ( @ ) do validations
            } 

            $validation = implode(':', $validations); // Transforma o array em uma string separada por ( : )
        }

        return $validation;
        
    }

    private function hasOneValidation(string $validate): bool 
    {
        return substr_count($validate, ':') == 0;
    }

    private function hasTwoOrMoreValidation(string $validate): bool
    {
        return substr_count($validate, ':') >= 1;
    }
}