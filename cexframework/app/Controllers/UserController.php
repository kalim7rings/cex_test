<?php

namespace App\Controllers;

use App\Models\User;
use App\Module\Decryption;
use App\Exceptions\UnautorizedException;

class UserController
{
    public function index($id)
    {
        $user = User::find($id);

        if (!$user) {
            throw new UnautorizedException('Unautorized user.');
        }

        return $this->decryptUserDetails($user);
    }

    public function decryptUserDetails($user)
    {
        $inputs = [
            'username' => $user->username,
            'password' => $user->password,
            'email' => $user->email,
            'contact' => $user->contact,
        ];

        return (new Decryption($inputs))();
    }
}
