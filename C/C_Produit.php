<?php

function voirdetail(){
  isset($_GET['id'])?$id=$_GET['id']:$id=-1;
  if($id==-1){
    require_once("V/error404.html");
  }else{
    require("M/M_Produit.php");
    require("M/M_Image.php");
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

function ajout(){
  require("V/header.html");
  require("V/ajoutProduit.html");
  require("V/footer.html");
}

function ajouter(){
  require("M/M_Produit.php");
  //var_dump($_POST);
  if(isset($_POST['designation']) && isset($_POST['prixht']) && isset($_POST['tva']) && isset($_POST['description'])){
    ajouterProduit($_POST['designation'], $_POST['prixht'], $_POST['tva'], $_POST['description']);
    $info = array();
    $info[0] = "Produit ajouté avec succès !";
  }
  require("V/header.html");
  require("V/ajoutProduit.html");
  require("V/footer.html");
}

function admin(){
  require_once("M/M_Produit.php");
  require_once("M/M_Image.php");
  $produits = getProduits();
  require("V/header.html");
  require("V/adminProduit.html");
  require("V/footer.html");
}

function modifier(){
  require_once("M/M_Produit.php");
  require_once("M/M_Image.php");
  if(isset($_POST["id"])){
    $id = $_POST['id'];
    if(isset($_POST["designation"])){
      setDesignation($id,$_POST["designation"]);
    }
    if(isset($_POST["prixht"])){
      if($_POST["prixht"]<0) $prix = 0;
      else $prix = $_POST["prixht"];
      setPrixHt($id,$prix);
    }
    if(isset($_POST["tva"])){
      setTva($id,$_POST["tva"]);
    }
    if(isset($_POST["description"])){
      setDescription($id,$_POST["description"]);
    }
    if(isset($_POST["url"])){
      supprImage($id);
      ajouteImage($id,$_POST["url"]);
    }
    $info = array();
    $info[0] = "Le produit #$id a bien été modifié !";
  }else{
    $err = array();
    $err[0] = "L'identifiant du produit est introuvable...";
  }
  $produits = getProduits();
  require("V/header.html");
  require("V/adminProduit.html");
  require("V/footer.html");

}

function delete(){
  require_once("M/M_Produit.php");
  require_once("M/M_Image.php");
  if(isset($_POST['id'])){
    deleteProduit($_POST['id']);
    $info = array();
    $info[0] = "Produit supprimé avec succès";
  }
  $produits = getProduits();
  require("V/header.html");
  require("V/adminProduit.html");
  require("V/footer.html");
}

?>
