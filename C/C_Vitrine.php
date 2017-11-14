<?php

function afficher(){
  if(isset($_SESSION['profil'])){
    require_once("M/M_Produit.php");
    require_once("M/M_Image.php");
    $produits = getProduits();
    require("V/header.html");
    require("V/vitrine.html");
    require("V/footer.html");
  }
}

function search(){
  if(isset($_SESSION['profil'])){
    isset($_POST['i'])?$s = $_POST['i']:$s="";
    require_once("M/M_Produit.php");
    require_once("M/M_Image.php");
    $produits = getProduitByDesignation($s);
    require("V/header.html");
    require("V/vitrine.html");
    require("V/footer.html");
  }
}

?>
