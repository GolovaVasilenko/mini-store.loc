<?php

namespace Core\Components\Auth;


use Core\Components\Mailer\Mailer;
use Delight\Auth\Auth;
use Core\DB\DbConnect;

class AuthComponent
{
    protected $auth;

    protected $mailer;

    public function __construct(DbConnect $connect, Mailer $mailer)
    {
        $this->auth = new Auth($connect->getDbh());
        $this->mailer = $mailer;
        return $this->auth;
    }

    public function getInstance()
    {
        return $this->auth;
    }

    public function registration($data)
    {
        try {
            $userId = $this->auth->register($data['email'], $data['password'], $data['username'], function ($selector, $token) {
                $this->mailer->createMessage(
                    'vasilenko@lanars.com',
                    'Aleks Weber',
                    'vasilenko75@gmail.com',
                    'test register message<br>Send ' . $selector . ' and ' . $token . ' to the user (e.g. via email)'
                );
                $this->mailer->send();
            });

            return $userId;
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

    public function login($data)
    {
        try {
            $this->auth->login($data['email'], $data['password']);

            echo 'User is logged in';
        }
        catch (\Delight\Auth\InvalidEmailException $e) {
            die('Wrong email address');
        }
        catch (\Delight\Auth\InvalidPasswordException $e) {
            die('Wrong password');
        }
        catch (\Delight\Auth\EmailNotVerifiedException $e) {
            die('Email not verified');
        }
        catch (\Delight\Auth\TooManyRequestsException $e) {
            die('Too many requests');
        }
    }

    public function emailVerification($data)
    {
        try {
            $this->auth->confirmEmail($data['selector'], $data['token']);

            echo 'Email address has been verified';
        }
        catch (\Delight\Auth\InvalidSelectorTokenPairException $e) {
            die('Invalid token');
        }
        catch (\Delight\Auth\TokenExpiredException $e) {
            die('Token expired');
        }
        catch (\Delight\Auth\UserAlreadyExistsException $e) {
            die('Email address already exists');
        }
        catch (\Delight\Auth\TooManyRequestsException $e) {
            die('Too many requests');
        }
    }

    public function logout()
    {
        $this->auth->logOut();
    }
}
