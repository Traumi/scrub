<?php
//retourner tous les url correspondant a l'idproduit passé en param
/*Fonction getImageByIdproduit
* Permet de selectionner une image dans la base en fonction de son produit correspondant
*/
function getImageByIdproduit($idprod){
	$cnx = spdo::getDB();
	$requete = "SELECT url FROM image WHERE idproduit = $idprod";
	return $cnx->query($requete);
}
/*Fonction ajouteImage
* Permet d'ajouter une image à un produit
*/
function ajouteImage ($idprod, $url){
	$cnx = spdo::getDB();
	$requete = "INSERT INTO image (idProduit, url) VALUES(:idprod,:url)";
	$stmt = $cnx->prepare($requete);
	$stmt->bindValue(":idprod",$idprod);
	$stmt->bindValue(":url",$url);
	if($stmt->execute()){
		return true;
	}
	return false;
}
/*Fonction supprImage
* Permet de supprimer une image d'un produit
*/
function supprImage ($idprod){
	$cnx = spdo::getDB();
	$requete = "DELETE FROM image WHERE idProduit = :idprod";
	$stmt = $cnx->prepare($requete);
	$stmt->bindValue(":idprod",$idprod);
	if($stmt->execute()){
		return true;
	}
	return false;
}
?>
