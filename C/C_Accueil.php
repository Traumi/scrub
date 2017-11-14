<?php

function profil(){
  require_once("M/M_Commande.php");
  $commandes = getCommandeByMail($_SESSION['profil']['mail']);
  require_once("V/header.html");
  require_once("V/profil.html");
  require_once("V/footer.html");
}

function gest(){
  require_once("M/M_Client.php");
  $clients = getClients();
  require_once("V/header.html");
  require_once("V/gestionClient.html");
  require_once("V/footer.html");
}

?>
