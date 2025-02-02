<?php

include_once('models/LoginModel.php');

class LoginController
{
    private $model;

    public function __construct()
    {
        $this->model = new LoginModel();
    }

    public function login_validation($email, $sandi)
    {
        return $this->model->login_validation($email, $sandi);
    }

    public function addUsers($email,$nama,$sandi)
    {
        return $this->model->addUsers($email,$nama,$sandi);
    }

}
