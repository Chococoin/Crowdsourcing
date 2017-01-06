<?php
namespace App\Controllers;
defined("APPPATH") OR die("Access denied");
 
use \Core\View,
    \App\Models\User,
    \App\Models\Bounty,
    \App\Models\Pay,
    \App\Models\Share,
    \App\Models\Admin\User as UserAdmin,
    \App\Controllers\Generics;
 
class Home extends Generics
{
    private $User;
    private $Bounty;
    private $Pay;
    private $Share;
    function __construct(){
        $this->User = new User();
        $this->Bounty = new Bounty();
        $this->Pay = new Pay();
        $this->Share = new Share();
    }
    public function index()
    {
        //$uid = $this->getCurrent();
        View::set('msg', 'Aplicacion de prueba');
        View::set('bounties', $this->Bounty->getAll());
        View::set('title', 'Welcome, Here are all the Bounties');
        View::render("/Home/index", 'Home');
    }
    
    public function bounty($id = null)
    {
        $bounty = $this->Bounty->getBounty($id);
        View::set("bounty", $bounty);
        View::set('msg', 'Vista de un Bounty Especifico');
        
        View::set("title", $bounty[0]['title']);
        View::render("Home/bounty", 'Home');
    }
 
    public function takeBounty($id = null)
    {
        $bounty = $this->Bounty->addBountyToUser($id);
        if (isset($bounty['id'])) {
            $msg = 'Cool, the Bounty is yours';
        } else {
            $msg = $bounty['msg'];
        }
        View::set('msg', $msg);
        $bounty = $this->Bounty->getBounty($id);
        View::set("bounty", $bounty);
        View::set("title", $bounty[0]['title']);
        View::render("Home/bounty", 'Home');
    }

    public function completedBounty($id = null)
    {
        $bounty = $this->Bounty->finishedBounty($id);
        if (isset($bounty['id'])) {
            $msg = 'Cool, the Bounty is Finished.<br> IMPORTANTE: Se ha agregado una referencia generica REF y un procesador de pago PAYPAL, esto solo para este modelo de pruebas';
        } else {
            $msg = $bounty['msg'];
        }
        View::set('msg', $msg);
         View::set('bounties', $this->Bounty->getAll());
        View::set('title', 'Welcome, Add a Bountie');
        View::render("/Home/index", 'Home');
    }

    public function allPays()
    {
        $pays = $this->Pay->getAll();
        View::set("pays", $pays);
        View::set('msg', 'All Pays View');
        
        View::set("title", 'Pays');
        View::render("Home/pays", 'Home');
    }

    public function allShares()
    {
        $shares = $this->Share->getAll();
        View::set("shares", $shares);
        View::set('msg', 'All Shares View');
        
        View::set("title", 'Shares');
        View::render("Home/shares", 'Home');
    }
}