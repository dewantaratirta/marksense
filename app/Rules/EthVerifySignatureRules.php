<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\DataAwareRule;
use Illuminate\Contracts\Validation\ValidationRule;

class EthVerifySignatureRules implements ValidationRule, DataAwareRule
{
    protected $data = [];

    public function setData(array $data)
    {
        $this->data = $data;
        return $this;
    }

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        //log data
        $result = fromMessage($this->data['message'], $this->data['signature']);

        if( strtolower($result) !== strtolower($this->data['address'])) {
            $fail('The :attribute is invalid.');
        }
    }
}
