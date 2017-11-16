<?php
function getProduitsByCommande($idCommande) {
     $bd = spdo::getDB();
     $req = "SELECT * FROM produit p "
             . "JOIN produitcommande pc ON pc.idProduit = p.idProduit "
             . "WHERE pc.idCommande = $idcommande";
     return $bd->query($req);
}

function insertProduitCommande($idProduit,$idCommande,$q) {
     $bd = spdo::getDB();
     $req = "INSERT INTO produitcommande (idProduit,idCommande,Quantite) VALUES ($idProduit,$idCommande,$q)";
     return $bd->query($req);
}
?>
