<?php

namespace App;

class Registration
{
    public function register()
    {

    }

    public function validate($formData)
    {
        if(empty($formData['email'])) {
            throw new \Exception("Email doesn't exist in the request", 1);
        } elseif(empty($formData['password'])) {
            throw new \Exception("Password doesn't exist in the request", 1);
        } elseif (empty($formData['confirm_password'])) {
            throw new \Exception("Password doesn't exist in the request", 1);
        }

        return true;
    }
}