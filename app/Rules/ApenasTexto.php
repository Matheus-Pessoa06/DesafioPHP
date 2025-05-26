<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\Rule;

class ApenasTexto implements Rule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function passes($attribute, $value): bool
    {
        // Verifica se o valor contém apenas letras (inclusive com acentos) e espaços
        return preg_match('/^[\pL\s]+$/u', $value);
    }

    public function message(): string
    {
        return 'O campo :attribute deve conter apenas letras.';
    }
}
