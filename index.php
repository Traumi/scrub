<?php

session_start();
require_once("M/connectBD.php");

date_default_timezone_set('Europe/Paris');
if(isset($_SESSION['profil'])){
    if(isset($_GET['c']) && isset ($_GET['a'])){
        $controle = $_GET['c'];
        $action = $_GET['a'];
        if (file_exists("./C/".$controle.".php")) {
            require ('./C/' . $controle . '.php');
            $action ();
        }
        else {
            require('./V/error404.html');
        }
    }else{
        require('./V/header.html');
        require('./V/accueil.html');
        require('./V/footer.html');
    }
} else {
    if(isset($_GET['c']) ){
        if($_GET['c'] == "C_Login"){
            $controle = $_GET['c'];
            require ('./C/' . $controle . '.php');
            $action = $_GET['a'];
            $action ();
        }else{
            require('./V/error404.html');
        }
    }
    else{
        require('./V/login.html');
    }
}

?>
