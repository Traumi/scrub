<?php

function afficher(){
  if(isset($_SESSION['profil'])){
    require("M_Produit.php");
    require("V/header.html");
    require("V/vitrine.html");
    require("V/footer.html");
  }
}

?>
