<?php

namespace App;

class Registration
{
    public function register()
    {
        $formData = [];
        try {
            $this->checkRequiredFields($formData);
            $this->validateInput($formData);
        } catch (\Throwable $th) {
            //throw $th;;
        }
    }

    public function checkRequiredFields($formData)
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

    public function validateInput($formData)
    {
        if (empty(filter_var($formData['email'], FILTER_VALIDATE_EMAIL))) {
            throw new \Exception("Email is not valid", 1);
        }

        if (strlen($formData['password']) !== 8) {
            throw new \Exception("Password should be at least 8 characters in length", 1);
        }

        if ($formData['password'] !== $formData['confirm_password']) {
            throw new \Exception("Confirmation password did not match password", 1);
        }

        return true;
    }
}