<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class NoProfanity implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // Add your list of blocked words here.
        // Keep them lowercase, as we will use a case-insensitive search.
        $blockedWords = [
            'badword1',
            'badword2',
            'offensiveword',
            // ... add more as needed
        ];

        // Convert the input to lowercase to catch variations (e.g., BaDwOrD)
        $valueLowercase = strtolower($value);

        foreach ($blockedWords as $word) {
            // Check if the blocked word exists anywhere in the string
            if (str_contains($valueLowercase, $word)) {
                $fail('The comment contains inappropriate language and cannot be posted.');
                return; // Stop checking after the first match
            }
        }
    }
}
