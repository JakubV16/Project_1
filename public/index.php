<?php
session_start(); 
// zapnem session

require_once __DIR__. "/../vendor/autoload.php"; 
// načítam všetky triedy z App/ cez composer autoload

use App\Core\Database;
use App\Repositories\UserRepository;
use App\Models\User;
use App\Core\Router;
use App\Controllers\UserController;
// poviem PHP, ktoré triedy idem používať

$db = new Database();
// vytvorím objekt databázy

$pdo = $db->getConnection();
// pripojím sa k databáze a dostanem PDO objekt

$userRepo = new UserRepository($pdo);
// vytvorím repository a dám mu PDO, aby vedel robiť SQL dotazy

$userController = new UserController($userRepo);


$router = new Router();

$router->add("/",$userController, "index");

$router->add("/login",$userController, "login");

$router->add("/register",$userController, "register");

$router->add("/dashboard",$userController, "dashboard");

$router->add("/logout",$userController, "logout");

$router->resolve();