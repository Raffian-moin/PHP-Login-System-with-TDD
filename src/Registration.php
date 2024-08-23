<?php
namespace App;

require "./vendor/autoload.php";

use PDO;
use App\DatabaseConfig;

class Registration
{
    public function dbConnect()
    {
        $DbConfig = new DatabaseConfig();
        $host = $DbConfig->host;
        $db = $DbConfig->db;
        $user = $DbConfig->user;
        $password = $DbConfig->password;

        $dsn = "mysql:host=$host;dbname=$db;charset=UTF8";
        $pdo = new PDO($dsn, $user, $password);

        return $pdo;
    }

    public function register($formData)
    {
        // $formData = [];
        try {
            $this->checkRequiredFields($formData);
            $this->validateInput($formData);

            $pdo = $this->dbConnect();

            $sql = 'INSERT INTO users(full_name, email, password) VALUES(:full_name, :email, :password)';

            $statement = $pdo->prepare($sql);

            $statement->execute([
                ':full_name' => $formData['full_name'],
                ':email' => $formData['email'],
                ':password' => $formData['password'],
            ]);

            $userId = $pdo->lastInsertId();
            if ($userId) {
                echo "User created successfully";
            }

        } catch (\Throwable $th) {
            //throw $th;;
            echo $th->getMessage();
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

$registration = new Registration();

$registration->register([
    'full_name'=> 'Raffian Moin',
    'email'=> 'raf@gmail.con',
    'password' => '12345678',
    'confirm_password' => '12345678'
]);