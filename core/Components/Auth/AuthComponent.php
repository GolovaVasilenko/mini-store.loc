<?php

namespace Core\Components\Auth;


use Delight\Auth\Auth;
use Core\DB\DbConnect;

class AuthComponent
{
    private $auth;

    public function __construct(DbConnect $connect)
    {
        $this->auth = new Auth($connect->getDbh());
        return $this->auth;
    }

    public function registration($data)
    {
        try {
            $userId = $this->auth->register($data['email'], $data['password'], $data['username'], function ($selector, $token) {
                echo 'Send ' . $selector . ' and ' . $token . ' to the user (e.g. via email)';
            });

            echo 'We have signed up a new user with the ID ' . $userId;
        }
        catch (\Delight\Auth\InvalidEmailException $e) {
            die('Invalid email address');
        }
        catch (\Delight\Auth\InvalidPasswordException $e) {
            die('Invalid password');
        }
        catch (\Delight\Auth\UserAlreadyExistsException $e) {
            die('User already exists');
        }
        catch (\Delight\Auth\TooManyRequestsException $e) {
            die('Too many requests');
        }
    }
}
