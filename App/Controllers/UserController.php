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
        include __DIR__ ."/../../views/home.php";
    }

    public function login(){

        if($_SERVER["REQUEST_METHOD"]==="POST"){
            $username= trim($_POST["username"]?? "");
            $password= trim($_POST["password"]?? "");

            $user = $this->userRepo->findByUsername($username);

            if(!$user || !$user->passwordVerify($password)){

                $_SESSION["flash_error"] = "Nespravne meno alebo heslo";

                header("Location:/Project_1/public/login");
                exit();
            }

            $_SESSION["user_id"]=$user->getID();
            $_SESSION["username"]=$user->getUsername();
            $_SESSION["role"]=$user->getRole();

            if($user->getRole()==="admin"){
                header("Location:/Project_1/public/admin");
            }
            else{
                header("Location:/Project_1/public/admin");
            }
            exit();
        }

        include __DIR__ ."/../../views/login.php";
    }

    public function register(){

        if($_SERVER["REQUEST_METHOD"]==="POST"){
            $username= trim($_POST["username"]?? "");
            $password= trim($_POST["password"]?? "");

            if($this->userRepo->findByUsername($username)){
                $_SESSION["flash_error"] = "Uživatelské meno už exituje";

                header("Location:/Project_1/public/register");
                exit();
            }
            if(mb_strlen($username) < 3 || mb_strlen($password) < 6){
                $_SESSION["flash_error"] = "Uživatelské meno musí mať aspoň 3 znaky a heslo 6 znakov!";

                header("Location:/Project_1/public/register");
                exit();
            }

            $newUser = new User($username, $password, );

            if($this->userRepo->save($newUser)){
                $_SESSION["flash_success"] = "Registrácia úspešná";

                header("Location:/Project_1/public/login");
                exit();
            }

        }



        include __DIR__ ."/../../views/register.php";
    }


    public function logout() :void 
    {
        session_destroy();
        header("Location:/Project_1/public/");
        exit();
    }
}
