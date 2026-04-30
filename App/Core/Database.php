<?php

namespace App\Core;

use PDO;
use PDOException;

// Základné údaje pre pripojenie k databáze
class Database
{
    private string $host = "localhost";
    private string $dbname = "db_users";
    private string $user = "root";
    private string $password = "";
    private string $charset = "utf8mb4";

    private ?PDO $conn = null;

    public function getConnection(): PDO
    {

    //Vrátime pripojenie    
        if ($this->conn !== null) {
            return $this->conn;
        }

    //Adresa databázy
        $dsn = "mysql:host={$this->host};dbname={$this->dbname};charset={$this->charset}";

        try {
            $this->conn = new PDO($dsn, $this->user, $this->password);      //PDO pripojenie
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  
            $this->conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Database connection error: " . $e->getMessage());   //Vyhodenie chyby ak sa nepodarí pripojiť
        }

    //Vrátime vytvorené pripojenie
        return $this->conn;
    }
}
