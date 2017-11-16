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
        if($_SESSION['panier'][$i]['id']=$_POST['id']){
          $_SESSION['panier'][$i]['quantity']+=$_POST['quantity'];
          //var_dump($_SESSION);
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
  require_once("V/Vitrine.html");
  require_once("V/footer.html");
}

function panier(){
  require_once("M/M_Produit.php");
  require_once("M/M_Image.php");
  require_once("V/header.html");
  require_once("V/Panier.html");
  require_once("V/footer.html");
}

?>
