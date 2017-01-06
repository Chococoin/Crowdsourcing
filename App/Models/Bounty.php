<?php
namespace App\Models;
defined("APPPATH") OR die("Access denied");
 
use \Core\Database;
 
class Bounty
{
    public function getAll()
    {
        try {
			$connection = Database::instance();
			$sql = "SELECT * FROM bounties JOIN bounties_type ON bounties_type.id_bt = bounties.id_bounty_type JOIN status_bounties ON status_bounties.id_sb = bounties.id_status";
			$query = $connection->prepare($sql);
			$query->execute();
			return $query->fetchAll();
		}
        catch(\PDOException $e)
        {
			print "Error!: " . $e->getMessage();
		}
    }
    
    public function getBounty($id)
    {
        try {
            $connection = Database::instance();
            $sql = "SELECT * FROM bounties JOIN bounties_type ON bounties_type.id_bt = bounties.id_bounty_type JOIN status_bounties ON status_bounties.id_sb = bounties.id_status WHERE bounties.id = :id LIMIT 1";
            $query = $connection->prepare($sql);
            $query->execute(array(':id' => $id));
            $bounty = $query->fetchAll();
            if ($bounty[0]['description_status'] == 'Available') {
                return $bounty;
            } else {
                try {
                    $sql = "SELECT * FROM bounties JOIN bounties_type ON bounties_type.id_bt = bounties.id_bounty_type JOIN status_bounties ON status_bounties.id_sb = bounties.id_status JOIN bounties_user ON bounties_user.id_bounty = bounties.id JOIN user ON user.id_user = bounties_user.id_user WHERE bounties.id = :id ";
                    $query = $connection->prepare($sql);
                    $query->execute(array('id' => $id));
                    $bounty = $query->fetchAll();
                    if (!empty($bounty)) {
                        return $bounty;
                    } else {
                        $response['msg'] = "Bounty not found";
                        return $response;
                    }
                } 
                catch(\PDOException $e)
                {
                    $response['msg'] = "Error: " . $e->getMessage();
                    return $response;
                }
            }
        }
        catch(\PDOException $e)
        {
            $response['msg'] = "Error: " . $e->getMessage();
            return $response;
        }
    }

    public function addBounty($title,$description,$estimated,$typeBounty)
    {
       try
       {
            $connection = Database::instance();
            
            $sql = "INSERT INTO bounties(title, description, estimated_time, offer, id_bounty_type, id_status, created,modified) VALUES (:title, :description, :estimated, NULL, :typeBounty, 1, NOW(),NOW())";
            $query = $connection->prepare($sql);
            $query->execute(array(
                ':title' => $title, 
                ':description' => $description, 
                ':estimated' => $estimated, 
                ':typeBounty' => $typeBounty
                )
            );
            //$response['rsp'] = $query->fetch(\PDO::FETCH_ASSOC);
            $response['id'] = $connection->lastInsertId();
            //$response['email'] = $email;
            
            
            //$user = $query->fetchAll();

            return $response;

       }
       catch(PDOException $e)
       {
            $response['msg'] = "Error: " . $e->getMessage();
            return $response;
       }    
    }

    public function addBountyToUser($id)
    {
       try
       {
            $connection = Database::instance();
            
            $sql = "INSERT INTO bounties_user (id_user, id_bounty,created_bu,modified_bu) VALUES (:user, :id, NOW(),NOW())";
            $query = $connection->prepare($sql);
            $query->execute(array(
                ':user' => $_SESSION['user_id'], 
                ':id' => $id
                )
            );
            //$response['rsp'] = $query->fetch(\PDO::FETCH_ASSOC);
            $response['id'] = $connection->lastInsertId();
            //$response['email'] = $email;
            $sql = "UPDATE bounties SET id_status = 2 WHERE id=:id";
            $query = $connection->prepare($sql);
            $query->execute(array(
                ':id' => $id
                )
            );
            
            
            //$user = $query->fetchAll();

            return $response;

       }
       catch(PDOException $e)
       {
            $response['msg'] = "Error: " . $e->getMessage();
            return $response;
       }    
    }

    public function finishedBounty($id)
    {
       try
       {
            $connection = Database::instance();
            $sql = "SELECT bounties.id, bounties.estimated_time, bounties_type.price, bounties_type.share FROM bounties JOIN bounties_user ON bounties_user.id_bounty = bounties.id JOIN bounties_type ON bounties_type.id_bt = bounties.id_bounty_type WHERE bounties_user.id=:id";
            $query = $connection->prepare($sql);
            $query->execute(array('id' => $id));
            $bounty = $query->fetchAll();
            $sql = "UPDATE bounties SET id_status = 3 WHERE id=:id";
            $query = $connection->prepare($sql);
            $query->execute(array('id' => $bounty[0]['id']));
            //$bounty = $query->fetchAll();
            $sql = "INSERT INTO pays (id_bounty_user, pay_reference,amount,id_processor, created, modified) VALUES (:id, 'REF', :amount, 1, NOW(),NOW())";
            $query = $connection->prepare($sql);
            $amount = ($bounty[0]['price'] * $bounty[0]['estimated_time' ] * $bounty[0]['share']) / 100;
            $shares = ($bounty[0]['price'] * $bounty[0]['estimated_time' ]) - $amount;
            $query->execute(array(
                ':id' => $id,
                ':amount' => $amount,
                )
            );
            $sql = "INSERT INTO shares (id_bounty_user, shares, created, modified) VALUES (:id, :shares, NOW(),NOW())";
            $query = $connection->prepare($sql);
            $query->execute(array(
                ':id' => $id,
                ':shares' => $shares,
                )
            );
            //$response['rsp'] = $query->fetch(\PDO::FETCH_ASSOC);
            $response['id'] = $bounty[0]['id'];
            //$response['email'] = $email;         
            
            //$user = $query->fetchAll();

            return $response;

       }
       catch(PDOException $e)
       {
            $response['msg'] = "Error: " . $e->getMessage();
            return $response;
       }    
    }


    public function sayHi()
    {
    	return 'Hi I\'m a User';
    }

}