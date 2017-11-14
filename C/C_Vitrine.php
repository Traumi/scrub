<?php

function afficher(){
  if(isset($_SESSION['profil'])){
    require("M/M_Produit.php");
    $produits = getProduits();
    require("V/header.html");
    require("V/vitrine.html");
    require("V/footer.html");
  }
}

?>
