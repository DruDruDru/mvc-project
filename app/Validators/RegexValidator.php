<?php

namespace Validators;

use Src\Validator\AbstractValidator;

class RegexValidator extends AbstractValidator
{
    protected string $message = "Field :field don't match";

    public function rule(): bool
    {
        return preg_match($this->args[0], $this->value);
    }
}