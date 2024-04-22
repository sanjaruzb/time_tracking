<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Spatie\Permission\Models\Role;

class ValidRoles implements Rule
{
    public function passes($attribute, $value)
    {
        $roles = is_array($value) ? $value : [$value];
        foreach ($roles as $name) {
            if (!Role::where('name',$name)->first()) {
                return false;
            }
        }
        return true;
    }

    public function message()
    {
        return 'Одна или несколько выбранных ролей не существуют.';
    }
}
