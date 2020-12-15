<?php

namespace App\Controllers;

use App\Models\User;
use App\Module\Encryption;
use Framework\Http\Request;
use Framework\Validation\Rules;
use App\Exceptions\UserExistsException;

class RegisterController
{
    public function store()
    {
        $input = resolve(Request::class)->all();

        $this->validateFields($input);

        $input = (new Encryption($input))();

        $this->isUserAlreadyExists($input['username']);

        User::create([
            'username' => $input['username'],
            'email' => $input['email'],
            'password' => $input['password'],
            'contact' => $input['contact'],
        ]);

        return true;
    }

    public function validateFields($input)
    {
        (new Rules([
            'username',
            'email',
            'password',
            'contact'
        ], $input))->validate();
    }

    public function isUserAlreadyExists($username){

        $user = User::where('username', $username)->first();

        if ($user) {
           throw new UserExistsException(false);
        }
    }
}
