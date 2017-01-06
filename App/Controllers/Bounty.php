<?php
namespace App\Controllers;
defined("APPPATH") OR die("Access denied");
 
use \Core\View,
    \App\Models\User,
    \App\Models\Bounty as BountyModel;
    //\Generics;
 
class Bounty extends Generics
{
    
    private $Bounty;
    
    function __construct(){
        $this->Bounty = new BountyModel();
    }

    public function index()
    {
        //$bounties = User::getAll();
        View::set("bounties", $bounties);
        View::set("title", "Panel de Administracion de Usuarios");
        //View::render("Elements/header.php");
        View::render("Admin/users", 'Home');
    }

    public function ajax_add()
    {
        
        if (strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest' AND isset($_SESSION['user_id']) AND isset($_SESSION['user'])) {
            if (isset($_POST['title']) AND !empty($_POST['title']) AND isset($_POST['description']) AND !empty($_POST['description']) AND isset($_POST['estimated']) AND !empty($_POST['estimated']) AND isset($_POST['typeBounty']) AND !empty($_POST['typeBounty'])) {
                $bounty = $this->Bounty->addBounty($_POST['title'], $_POST['description'], $_POST['estimated'], $_POST['typeBounty']);
                if (!empty($bounty)) {
                    //If isse msg, means that an error ocurred
                    if (isset($bounty['msg'])) {
                        $response['response'] = false;
                        $response['msg'] = $bounty['msg'];
                    } else {
                        $response['response'] = true;
                        $response['msg'] = 'Success';
                        $response['bounty'] = $bounty;
                    }
                    
                    
                } else {
                    $response['response'] = false;
                    $response['msg'] = 'Error';
                }

            } else {
                $response['msg'] = 'There is empty fields';
                $response['response'] = false;
            }
           

        } else {
            $response['msg'] = 'Unknow Error';
            $response['response'] = false;
        }

        echo json_encode($response);

    }
}