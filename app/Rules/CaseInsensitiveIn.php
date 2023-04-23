<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Validation\Concerns\ValidatesAttributes;
use Illuminate\Validation\Rules\In;

class CaseInsensitiveIn extends In implements Rule
{
    use ValidatesAttributes;

    public function __construct(array $values)
    {
        parent::__construct($values);

        $this->values = array_map('strtolower', $this->values);
    }

    public function passes($attribute, $value): bool
    {
        return $this->validateIn($attribute, strtolower($value), $this->values);
    }

    public function message(): string
    {
        return __('validation.in');
    }
}
