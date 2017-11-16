<?php

function modifierClient(){
  require_once("M/M_Client.php");
  isset($_POST['email'])?$mel=$_POST['email']:$mel="";
  isset($_POST['prenom'])?$prenom=$_POST['prenom']:$prenom="";
  isset($_POST['nom'])?$nom=$_POST['nom']:$nom="";
  isset($_POST['rue'])?$rue=$_POST['rue']:$rue="";
  isset($_POST['complement'])?$comp=$_POST['complement']:$comp="";
  isset($_POST['ville'])?$ville=$_POST['ville']:$ville="";
  isset($_POST['cp'])?$cp=$_POST['cp']:$cp="";
  isset($_POST['id'])?$id=$_POST['id']:$id="";
  //var_dump($_POST);
  if($mel != "" && $prenom != "" && $nom != "" && $rue != "" && $ville != "" && $cp != "" && $id != ""){
    $tmp = modifClient($nom, $prenom, $mel, $rue, $comp, $ville, $cp, $id);
    if($id == $_SESSION['profil']['mail']){
      $_SESSION['profil']['mail'] = $tmp['mail'];
      $_SESSION['profil']['nom'] = $tmp['nom'];
      $_SESSION['profil']['prenom'] = $tmp['prenom'];
      $_SESSION['profil']['rue'] = $tmp['rue'];
      $_SESSION['profil']['complement'] = $tmp['complement'];
      $_SESSION['profil']['ville'] = $tmp['ville'];
      $_SESSION['profil']['cp'] = $tmp['cp'];
    }

  }

  $clients = getClients();
  require_once("V/header.html");
  require_once("V/gestionClient.html");
  require_once("V/footer.html");
}

function supprimerClient(){
  require_once("M/M_Client.php");
  isset($_POST['id'])?$id=$_POST['id']:$id="";
  if($id != "" && $id != $_SESSION['profil']['mail']){
    supprClient($id);
  }else if($id == $_SESSION['profil']['mail']){
    $err = array();
    $err[0] = "Vous ne pouvez pas supprimer votre compte";
  }
  $clients = getClients();
  require_once("V/header.html");
  require_once("V/gestionClient.html");
  require_once("V/footer.html");
}

?>
