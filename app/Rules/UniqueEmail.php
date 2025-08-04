<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Contracts\Validation\Rule;
use App\Models\User;

class UniqueEmail implements Rule
{
    public function passes($attribute, $value)
    {
        return !User::where('email', $value)->exists();
    }

    public function message()
    {
        return 'Email sudah terdaftar di sistem.';
    }
}
