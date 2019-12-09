<?php

namespace App\traits;

trait Sanitize
{

    protected function sanitize(): array
    {
        $sanitized = [];

        foreach ($_POST as $field => $value) {
            $sanitized[$field] = filter_var($value, FILTER_SANITIZE_STRING);
        }

        return $sanitized;
    }
}