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
    public function findByUsername(string $username):?User
    {
        try{

        
            $user = null;

            $sql = "SELECT * FROM users WHERE username = :username LIMIT 1";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([":username"=> $username]);

            if($row = $stmt->fetch()){

                $user = new User($row["username"], $row["password"], $row["role"], true);
                $user->setId((int)$row["id"]);
                $user->setCreatedAt($row["created_at"]);

                return $user;
            } 

            return null;
        }
        catch(PDOExpextion $e){
            return null;
        }

        
    }

    public function save(User $user) :bool 
    {
        try{
            $sql = "INSERT INTO users (username, password, role) VALUES (:username, :password, :role)";
            $stmt = $this->db->prepare($sql);

            $result = $stmt->execute([
                ":username"=>$user->getUsername(),
                ":password"=>$user->getPassword(),
                ":role"=>$user->getRole()
            ]);
            
            if($result){
                $user->setId((int)$this->db->lastInsertId());
            }
            return $result;
        }
        catch(PDOExpection $e){
            return false;
        }
    }

    public function update(User $user) :bool 
    {
        try{
            $sql="UPDATE users SET username = :username, password=:password, role=:role WHERE id=:id";
            $stmt = $this->db->prepare($sql);
            return $result = $stmt->execute([
                ":username"=>$user->getUsername(),
                ":password"=>$user->getPassword(),
                ":role"=>$user->getRole(),
                ":id"=>$user->getId()
            ]);
  
        }
        catch(PDOExpection $e){
            return false;
        }
    }
    /*
    public function delete(int $id) :bool 
    {
        try{
            $sql="DELETE FROM users WHERE id = :id";
            $stmt = $this->db->prepare($sql);
            $result = $stmt->execute([":id"=> $id]);

            

        }
        catch(PDOExpection $e){
            return false;
        }
    }*/
}


