<?php

namespace App\Controllers;

use App\Models\User;
use App\Repositories\UserRepository;

class UserController{
    private UserRepository $userRepo;

    public function __construct(UserRepository $userRepo){
        $this->userRepo = $userRepo;
    }

    public function index(){
        echo"index";
    }

    public function login(){
        include __DIR__ ."/../../views/login.php";
    }

    public function register(){
        include __DIR__ ."/../../views/register.php";
    }
}
