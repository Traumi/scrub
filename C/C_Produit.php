<?php

function voirdetail(){
  isset($_GET['id'])?$id=$_GET['id']:$id=-1;
  if($id==-1){
    require_once("V/error404.html");
  }else{
    require("M/M_Produit.php");
    $tmp = getProduitById($id);
    $produit = array();
    $i = 0;
    foreach($tmp as $row){
      //$produit[$i++] = $row;
      $tmp = $row;
    }
    $produit['idProduit'] = $tmp['idProduit'];
    $produit['designation'] = $tmp['designation'];
    $produit['prix'] = $tmp['prixht']+$tmp['prixht']*($tmp['tva']/100);
    $produit['description'] = $tmp['description'];
    require("V/header.html");
    require("V/detailProd.html");
    require("V/footer.html");
  }
}

?>