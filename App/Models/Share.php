<?php
namespace App\Models;
defined("APPPATH") OR die("Access denied");
 
use \Core\Database,
    \App\Models\User as UserModel;
 
class Share
{
    
    private $User;
    private $shares;

    function __construct(){
        $this->User = new UserModel();
    }

    public function getAll()
    {
        try {
            $users = $this->User->getAll();
			$connection = Database::instance();
            $aux = 0;
            foreach ($users as $user) {
                $this->shares[$aux]['User'] = $user;
                $sql = "SELECT * FROM shares JOIN bounties_user ON bounties_user.id = shares.id_bounty_user JOIN bounties ON bounties.id = bounties_user.id_bounty JOIN user ON user.id_user = bounties_user.id_user JOIN bounties_type ON bounties_type.id_bt = bounties.id_bounty_type JOIN status_bounties ON status_bounties.id_sb = bounties.id_status WHERE status_bounties.description_status = 'Finished' AND user.id_user = :id";
                $query = $connection->prepare($sql);
                $query->execute(array(':id' => $user['id_user']));
                $shares = $query->fetchAll();
                if (!empty($shares)) {
                    $this->shares[$aux]['User']['shares'] = $shares;
                }

                $aux++;
            }
			
			return $this->shares;
		}
        catch(\PDOException $e)
        {
			print "Error!: " . $e->getMessage();
		}
    }
    
    
}
