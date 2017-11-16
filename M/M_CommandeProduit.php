<?php

function getProduitsParCommande($idCommande) {
     $bd = spdo::getDB();
     $req = "SELECT * FROM produit p"
             . "JOIN produitcommande pc ON pc.idProduit = p.idProduit "
             . "WHERE pc.idCommande = ?";
     $res = $bd->prepare($req);
     return $bd->execute(array($idCommande));      
}