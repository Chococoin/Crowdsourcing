<?php
namespace App\Controllers;
defined("APPPATH") OR die("Access denied");
 
use \Core\View,
    \App\Models\User;
    //\Generics;
 
class Admin extends Generics
{
    
    public function index()
    {
        $users = User::getAll();
        View::set("users", $users);
        View::set("title", "Panel de Administracion de Usuarios");
        //View::render("Elements/header.php");
        View::render("Admin/users", 'Home');
    }

    public function prueba()
    {
        echo json_encode($prueba['prueba']=$_POST['var']*2);

    }
}