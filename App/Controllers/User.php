<?php
namespace App\Controllers;
defined("APPPATH") OR die("Access denied");
 
use \Core\View,
    \App\Models\User as UserModel,
    \App\Models\Admin\User as UserAdmin,
    \App\Controllers\Generics;
 
class User extends Generics
{
    private $User;
    function __construct(){
        $this->User = new UserModel();
    }
    public function index()
    {
        $uid = $this->getCurrent();
        if (is_numeric($uid)) {
            $msg = 'Se renderiza todo bn xq hay un usuario definido';
        } else {
            $msg = 'no hay un usuario con una sesion iniciada';
        }
        View::set('msg', $msg);
        View::set('title', $this->User->sayHi());
        View::render("/Home/index", 'Home');
    }

    public function ajax_login()
    {
        if (strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest' AND !isset($_SESSION['user_id']) AND !isset($_SESSION['user'])) {
            if (isset($_POST['email']) AND !empty($_POST['email']) AND isset($_POST['password']) AND !empty($_POST['password'])) {
                $user = $this->User->getlogin($_POST['email'], $_POST['password']);
                if (!empty($user)) {
                    //If isse msg, means that an error ocurred
                    if (isset($user['msg'])) {
                        $response['response'] = false;
                        $response['msg'] = $user['msg'];
                    } else {
                        $response['User'] = $user;
                        $response['response'] = true;
                        $response['msg'] = 'Sweet, you are an register user';
                        $this->initSession($user[0]['email'], $user[0]['id_user']);
                    }
                    
                    
                } else {
                    $response['response'] = false;
                    $response['msg'] = 'To bad, incorrect data';
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

    public function ajax_signup()
    {
       if (strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest' AND !isset($_SESSION['user_id']) AND !isset($_SESSION['user'])) {
            if (isset($_POST['email']) AND !empty($_POST['email']) AND isset($_POST['password']) AND !empty($_POST['password']) AND isset($_POST['fname']) AND !empty($_POST['fname']) AND isset($_POST['lname']) AND !empty($_POST['lname'])) {
                $response = $this->User->addUser($_POST['fname'], $_POST['lname'], $_POST['email'], $_POST['password']);
                if (!empty($response)) {
                    //If isse msg, means that an error ocurred
                    if (isset($response['msg'])) {
                        $response['response'] = false;
                        $response['msg'] = $response['msg'];
                    } else {
                        $response['response'] = true;
                        $response['msg'] = 'Success';
                        $response['rsp'] = $response;
                        $this->initSession($response['email'], $response['id']);
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

    //Function to encrypt password
    



    public function saludo($nombre)
    {
        View::set("name", $nombre);
        View::set("title", "Custom MVC");
        View::render("home", 'Home');
    }
 
    public function users()
    {
        $users = UserAdmin::getAll();
        View::set("users", $users);
        View::set("title", "Custom MVC");
        View::render("users", 'Home');
    }
}