<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ValidCnpj implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (!$this->isValidCnpj($value)) {
            $fail('O campo :attribute deve conter um CNPJ válido.');
        }
    }

    /**
     * Validate CNPJ
     */
    private function isValidCnpj($cnpj): bool
    {
        // Remove non-numeric characters
        $cnpj = preg_replace('/\D/', '', $cnpj);

        // Check if has 14 digits
        if (strlen($cnpj) !== 14) {
            return false;
        }

        // Check for known invalid patterns
        if (preg_match('/(\d)\1{13}/', $cnpj)) {
            return false;
        }

        // Calculate first digit
        $sum = 0;
        $weights = [5, 4, 3, 2, 9, 8, 7, 6, 5, 4, 3, 2];

        for ($i = 0; $i < 12; $i++) {
            $sum += $cnpj[$i] * $weights[$i];
        }

        $remainder = $sum % 11;
        $digit1 = $remainder < 2 ? 0 : 11 - $remainder;

        if ($cnpj[12] != $digit1) {
            return false;
        }

        // Calculate second digit
        $sum = 0;
        $weights = [6, 5, 4, 3, 2, 9, 8, 7, 6, 5, 4, 3, 2];

        for ($i = 0; $i < 13; $i++) {
            $sum += $cnpj[$i] * $weights[$i];
        }

        $remainder = $sum % 11;
        $digit2 = $remainder < 2 ? 0 : 11 - $remainder;

        return $cnpj[13] == $digit2;
    }
}