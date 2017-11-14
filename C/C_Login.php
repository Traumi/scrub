<?php

function connecter(){
  require_once("M/M_Client.php");
  isset($_POST['mail'])?$mel=$_POST['mail']:$mel="";
  isset($_POST['pass'])?$pass=$_POST['pass']:$pass="";

  if($mel != "" && $pass != ""){
    if(authClient($mel, $pass)){
      $tmp = getClient($mel);
      $_SESSION['profil']['mail'] = $tmp['mail'];
      $_SESSION['profil']['nom'] = $tmp['nom'];
      $_SESSION['profil']['prenom'] = $tmp['prenom'];
      $_SESSION['profil']['rue'] = $tmp['rue'];
      $_SESSION['profil']['complement'] = $tmp['complement'];
      $_SESSION['profil']['ville'] = $tmp['ville'];
      $_SESSION['profil']['cp'] = $tmp['cp'];
      require("V/header.html");
      require("V/accueil.html");
      require("V/footer.html");

    }
    else{
      $err = array();
      $err[0] = "Mot de passe incorrect.";
      require("V/login.html");
    }
  }else{
    $err = array();
    $err[0] = "Vous devez remplir tous les champs.";
    require("V/login.html");
  }
}

function deco(){
  session_destroy();
  require("V/login.html");
}

function inscrire(){
  require_once("M/M_Client.php");
  isset($_POST['mail'])?$mel=$_POST['mail']:$mel="";
  isset($_POST['pass'])?$pass=$_POST['pass']:$pass="";
  isset($_POST['pass2'])?$pass2=$_POST['pass2']:$pass2="";
  isset($_POST['prenom'])?$prenom=$_POST['prenom']:$prenom="";
  isset($_POST['nom'])?$nom=$_POST['nom']:$nom="";
  isset($_POST['rue'])?$rue=$_POST['rue']:$rue="";
  isset($_POST['complement'])?$comp=$_POST['complement']:$comp="";
  isset($_POST['ville'])?$ville=$_POST['ville']:$ville="";
  isset($_POST['cp'])?$cp=$_POST['cp']:$cp="";

  if($mel != "" && $pass != "" && $pass2 != "" && $prenom != "" && $nom != "" && $rue != "" && $ville != "" && $cp != ""){
    if($pass != $pass2){
      $err = array();
      $err[0] = "Les mots de passe doivent être identique.";
      require("V/login.html");
    }else{
      if(existClient($mel)){
        $err = array();
        $err[0] = "Ce client existe déjà.";
        require("V/login.html");
      }else{
        if(!ajouterClient($nom, $prenom, $mel, $pass, $rue, $comp, $ville, $cp)){
          $err = array();
          $err[0] = "Erreur lors de l'ajout du client.";
          require("V/login.html");
        }else{
          require("V/header.html");
          require("V/accueil.html");
          require("V/footer.html");
        }
      }
    }

  }else{
    $err = array();
    $err[0] = "Vous devez remplir tous les champs.";
    require("V/login.html");
  }
}

?>
