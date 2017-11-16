<?php

function acheter(){
  require_once("M/M_Produit.php");
  require_once("M/M_Image.php");
  $produits = getProduits();
  if(isset($_POST['id']) && isset($_POST['quantity'])){
    //var_dump($_SESSION);
    //echo sizeof($_SESSION['panier']);
    if(isset($_SESSION['panier'])){
      $isAdded = 0;
      $taille = sizeof($_SESSION['panier']);

      for($i = 0 ; $i < $taille ; $i++){
        if($_SESSION['panier'][$i]['id']==$_POST['id']){
          $_SESSION['panier'][$i]['quantity']+=$_POST['quantity'];
          $isAdded = 1;
        }
      }
      if($isAdded == 0){
        $_SESSION['panier'][$taille]['id'] = $_POST['id'];
        $_SESSION['panier'][$taille]['quantity'] = $_POST['quantity'];
      }
    }else{
      $_SESSION['panier'][0]['id'] = $_POST['id'];
      $_SESSION['panier'][0]['quantity'] = $_POST['quantity'];

    }

    $info = array();
    $info[0] = "Produit ajouté au panier avec succès. <a href=\"index.php?c=C_Commande&a=panier\">Voir le panier.</a>";
  }
  require_once("V/header.html");
  require_once("V/vitrine.html");
  require_once("V/footer.html");
}

function panier(){
  require_once("M/M_Produit.php");
  require_once("M/M_Image.php");
  require_once("V/header.html");
  require_once("V/panier.html");
  require_once("V/footer.html");
}

function miseajour(){
  if(isset($_POST['id']) && isset($_POST['q']) && isset($_POST['index'])){
    $id = $_POST['id'];
    $q = $_POST['q'];
    $index = $_POST['index'];
    if($q <= 0){
      $_SESSION['panier'][$index] = null;
      $info = array();
      $info[0] = "Elément supprimé !";
    }else{
      $_SESSION['panier'][$index]['quantity'] = $q;
      $info = array();
      $info[0] = "Modification réussie !";
    }
  }else{
    $err = array();
    $err[0] = "accès non autorisé !";
  }
  require_once("M/M_Produit.php");
  require_once("M/M_Image.php");
  require_once("V/header.html");
  require_once("V/panier.html");
  require_once("V/footer.html");
}

function vider(){
  $_SESSION['panier'] = null;
  $info = array();
  $info[0] = "Pannier supprimé !";
  require_once("M/M_Produit.php");
  require_once("M/M_Image.php");
  require_once("V/header.html");
  require_once("V/panier.html");
  require_once("V/footer.html");
}

function supprimer(){
  if(isset($_POST['index'])){
    $index = $_POST['index'];
    $_SESSION['panier'][$index] = null;
    $info = array();
    $info[0] = "Elément supprimé !";
  }else{
    $err = array();
    $err[0] = "accès non autorisé !";
  }
  require_once("M/M_Produit.php");
  require_once("M/M_Image.php");
  require_once("V/header.html");
  require_once("V/panier.html");
  require_once("V/footer.html");
}

function paiement(){
  require_once("M/M_Produit.php");
  require_once("M/M_Image.php");
  $prixTotal = 0;
  if(isset($_SESSION['panier'])){
    if($_SESSION['panier'] != null){
      for($i = 0 ; $i < sizeof($_SESSION['panier']) ; $i++){
        if($_SESSION['panier'][$i] != null){
          $produit = getProduitById($_SESSION['panier'][$i]['id'])->fetch();
          $price =  $produit['prixht']+($produit['prixht']*$produit['tva']/100);
          $prixTotal += $price * $_SESSION['panier'][$i]['quantity'];
        }
      }
      $_SESSION['panier']['total'] = $prixTotal;
      require_once("V/header.html");
      require_once("V/formulaireCommande.html");
      require_once("V/footer.html");
    }

  }else{

    $err = array();
    $err[0] = "Votre panier est vide !";
    require_once("V/header.html");
    require_once("V/panier.html");
    require_once("V/footer.html");
  }

}

function creerCommande(){
  require_once("M/M_Commande.php");
  require_once("M/M_CommandeProduit.php");
  //var_dump($_SESSION);
  try{
    $lastId = ajouterCommande($_SESSION['profil']['mail'], $_SESSION['profil']['rue'], $_SESSION['profil']['complement'], $_SESSION['profil']['ville'],
    						 $_SESSION['profil']['cp'], $_POST['rue'], $_POST['complement'],
    						 $_POST['ville'], $_POST['cp'], $_SESSION['panier']['total']);
    for($i = 0 ; $i < sizeof($_SESSION['panier'])-1 ; $i++){
      if($_SESSION['panier'][$i] != null)
        insertProduitCommande($_SESSION['panier'][$i]['id'],$lastId,$_SESSION['panier'][$i]['quantity']);
    }

    $_SESSION['panier'] = null;
    $info = array();
    $info[0] = "Votre commande a bien été effectuée, merci pour votre achat :)";
  }catch(Exception $e){

    $err = array();
    $err[0] = "Erreur lors de l'insertion";
  }

  require_once("V/header.html");
  require_once("V/accueil.html");
  require_once("V/footer.html");
}

?>
