<?php
session_start(); 
// zapnem session

require_once __DIR__. "/../vendor/autoload.php"; 
// načítam všetky triedy z App/ cez composer autoload

use App\Core\Database;
use App\Repositories\UserRepository;
use App\Models\User;
// poviem PHP, ktoré triedy idem používať

$db = new Database();
// vytvorím objekt databázy

$pdo = $db->getConnection();
// pripojím sa k databáze a dostanem PDO objekt

var_dump($pdo);
// skontrolujem, či pripojenie funguje

$userRepo = new UserRepository($pdo);
// vytvorím repository a dám mu PDO, aby vedel robiť SQL dotazy
/*
$user = $userRepo -> findByUsername("Majo");
var_dump($user);
*/

$user = new User("Fero","Fero","user", false);
$userRepo->save($user);


if($user = $userRepo->findByUsername("Fero")){
    $user->setUsername("Rudo");
    $userRepo->update($user);

}


