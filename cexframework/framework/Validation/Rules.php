<?php

namespace Framework\Validation;

use Framework\Exception\ValidationException;

class Rules
{
    protected $fields = [];
    protected $inputs = [];

    public function __construct(array $fields, $inputs)
    {
        $this->fields = $fields;
        $this->inputs = $inputs;
    }

    public function validate()
    {
        $errors = [];

        foreach ($this->fields as $field) {

            if (!isset($this->inputs[$field])) {
                $errors[] = $field . ' field is required.';
            } else if ($this->isFieldNull($this->inputs[$field])) {
                $errors[] = $field . ' can not be blank.';
            } else if (!$this->{'isValid' . ucfirst($field)}($this->inputs[$field]) && !$this->isLoginPath()) {
                $errors[] = $field . ' is not valid.';
            }
        }

        if (count($errors) > 0) {
            throw new ValidationException($errors);
        }
    }

    public function isLoginPath()
    {
        return explode('/', $_SERVER['REQUEST_URI'])[4] == 'login';
    }

    public function isFieldNull($field)
    {
        return empty($field);
    }

    public function isValidUsername($userName)
    {
        return preg_match("/^[A-Za-z0-9]{3,15}+$/", $userName) == TRUE;
    }

    public function isValidEmail($email)
    {
        return preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/i", $email) == TRUE;
    }

    public function isValidPassword($password)
    {
        return  preg_match("/^(?=.*[A-Za-z])(?=.*\d)(?=.*[!@#$%&])[A-Za-z\d!@#$%&]{6,15}$/", $password) == TRUE;
    }

    public function isValidContact($contact)
    {
        return preg_match("/^[0-9]{8,10}$/", $contact) == TRUE;
    }
}
