<?php

namespace NetworkRailBusinessSystems\Entra\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use NetworkRailBusinessSystems\DirectoryLink\Interfaces\DirectoryModel;

class ExistsInDirectory implements ValidationRule
{
    /** @param class-string<DirectoryModel> $directoryModelClass */
    public function __construct(
        public string $directoryModelClass,
        public string $field = 'email',
    ) {
        //
    }

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if ($this->directoryModelClass::exists($value, $this->field) !== true) {
            $fail("An entry with the $this->field \"$value\" does not exist in the directory");
        }
    }
}
