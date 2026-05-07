<?php
namespace App\Repositories;

use PDO;
use PDOexpection;
use App\Models\User;

class UserRepository
{
    private PDO $db;
    public function __construct(PDO $pdo)
    {
        $this->db = $pdo;
    }
}


