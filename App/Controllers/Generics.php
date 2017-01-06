<?php 
namespace App\Controllers;
defined("APPPATH") OR die("Access denied");

class Generics
{
	public function sayHi(){
		return 'hello';
	}

	public function getCurrent()
    {
    	if (isset($_SESSION['user']) AND isset($_SESSION['user_id']) ) {
    		return $_SESSION['user_id'];
    	} else {
    		return false;
    	}
    }

    public function initSession($email = null, $id = null) 
    {
        ini_set('session.cookie_lifetime', time() + (60*60*24*7));
        $_SESSION['user_id'] = $id;
        $_SESSION['user']    = $email;
        /*$_SESSION['admin'] = true;*/


    }

    public function logout()
    {
        session_destroy();
        header('Location: ' . ROOT . '/Public/Home');
    }



	
}
