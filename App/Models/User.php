<?php
namespace App\Models;
defined("APPPATH") OR die("Access denied");
 
use \Core\Database;
 
class User
{
    public static function getAll()
    {
        try {
			$connection = Database::instance();
			$sql = "SELECT * from user";
			$query = $connection->prepare($sql);
			$query->execute();
			return $query->fetchAll();
		}
        catch(\PDOException $e)
        {
			print "Error!: " . $e->getMessage();
		}
    }

    public static function getAllJoin()
    {
        try {
			$connection = Database::instance();
			$sql = "SELECT * from user";
			$query = $connection->prepare($sql);
			$query->execute();
			return $query->fetchAll();
		}
        catch(\PDOException $e)
        {
			print "Error!: " . $e->getMessage();
		}
    }

    public function getLogin($user=null,$pass=null)
    {
        $pass = $this->encryptPassword($_POST['password']);
        try {
            $connection = Database::instance();
            $sql = "SELECT * FROM user WHERE email=:email AND password=:pass LIMIT 1";
            $query = $connection->prepare($sql);
            $query->execute(array(':email' => $user, ':pass' => $pass));
            $user = $query->fetchAll();

            return $user;
        }
        catch(\PDOException $e)
        {
            $response['response'] = false;
            $response['msg'] = "Error: " . $e->getMessage();
            return $response;
        }
    }

    public function addUser($fname,$lname,$email,$pass)
    {
       try
       {
            $encryptPass = $this->encryptPassword($pass);
            $connection = Database::instance();
            $sql = "SELECT * FROM users WHERE email=:email LIMIT 1";
            $query = $connection->prepare($sql);
            $query->execute(array(':email' => $email));
            $user = $query->fetchAll();
            //return $user;
            if (isset($user[0]['email']) AND $user[0]['email'] == $email) {
                $response['msg'] = 'Email Already Exist';
            } else {
                $sql = "INSERT INTO users(name, lastname, email, password, client_id, role_id, user_status_id,created) VALUES (:fname, :lname, :email, :pass, :client, :role, :status, NOW())";
                $query = $connection->prepare($sql);
                $query->execute(array(
                    ':fname' => $fname, 
                    ':lname' => $lname, 
                    ':email' => $email, 
                    ':pass' => $encryptPass, 
                    ':client' => 1, 
                    ':role' => 1, 
                    ':status' => 1,
                    )
                );
                //$response['rsp'] = $query->fetch(\PDO::FETCH_ASSOC);
                $response['id'] = $connection->lastInsertId();
                $response['email'] = $email;
            }
            
            //$user = $query->fetchAll();

            return $response;

       }
       catch(PDOException $e)
       {
            $response['msg'] = "Error: " . $e->getMessage();
            return $response;
       }    
    }


    private function encryptPassword($pass = null)
    {
        $long = strlen($pass);
        $encryptPass = '';
        for ($i=0; $i < $long; $i++) { 
            $encryptPass .= ($i % 2) != 0 ? md5($pass[$i]) : $i;
        }
        return md5($encryptPass);
    }


    public function sayHi()
    {
    	return 'Hi I\'m a User';
    }

}