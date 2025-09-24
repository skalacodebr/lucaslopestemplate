<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ValidCpf implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (!$this->isValidCpf($value)) {
            $fail('O campo :attribute deve conter um CPF válido.');
        }
    }

    /**
     * Validate CPF
     */
    private function isValidCpf($cpf): bool
    {
        // Remove non-numeric characters
        $cpf = preg_replace('/\D/', '', $cpf);

        // Check if has 11 digits
        if (strlen($cpf) !== 11) {
            return false;
        }

        // Check for known invalid patterns
        if (preg_match('/(\d)\1{10}/', $cpf)) {
            return false;
        }

        // Calculate first digit
        $sum = 0;
        for ($i = 0; $i < 9; $i++) {
            $sum += $cpf[$i] * (10 - $i);
        }

        $remainder = $sum % 11;
        $digit1 = $remainder < 2 ? 0 : 11 - $remainder;

        if ($cpf[9] != $digit1) {
            return false;
        }

        // Calculate second digit
        $sum = 0;
        for ($i = 0; $i < 10; $i++) {
            $sum += $cpf[$i] * (11 - $i);
        }

        $remainder = $sum % 11;
        $digit2 = $remainder < 2 ? 0 : 11 - $remainder;

        return $cpf[10] == $digit2;
    }
}