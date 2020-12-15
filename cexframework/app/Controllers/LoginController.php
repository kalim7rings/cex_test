<?php

namespace App\Controllers;

use App\Models\User;
use App\Module\Encryption;
use Framework\Http\Request;
use Framework\Validation\Rules;
use App\Exceptions\UnautorizedException;

class LoginController
{
    public function store()
    {
        $input = resolve(Request::class)->all();

        $this->validateFields($input);

        $input = (new Encryption($input))();

        $user = User::where('username', $input['username'])->where('password', $input['password'])->first();

        if (!$user) {
            throw new UnautorizedException(false);
        }

        return [
            'status' => true,
            'user' => $user->id,
        ];
    }

    public function validateFields($input)
    {
        (new Rules([
            'username',
            'password',
        ], $input))->validate();
    }
}
