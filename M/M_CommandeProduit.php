<?php

function getProduitsByCommande($idCommande) {
     $bd = spdo::getDB();
     $req = "SELECT * FROM produit p "
             . "JOIN produitcommande pc ON pc.idProduit = p.idProduit "
             . "WHERE pc.idCommande = $idcommande";
     return $bd->query($req);
}

?>