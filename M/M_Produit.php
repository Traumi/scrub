<?php
/* Fonctions :
 * getProduitById($idProduit) , getProduitByDesignation($designation), getListeProduits()
 * ajouterProduit, modifierProduit
 */
/*
 * Insertion d'un produit entièrement défini.
 * Retourne true si OK et false en cas d'erreur
 */
function ajouterProduit($designation, $prixHt, $tva, $description){
	$cnx  = spdo::getDB();
	$rqt  = "INSERT INTO produit(designation, prixht, tva, description) ";
	$rqt .= "VALUES(:designation, :prixHt, :tva, :description)";
	$stmt = $cnx->prepare($rqt);
	$stmt->bindValue(":designation", $designation);
	$stmt->bindValue(":prixHt", $prixHt);
	$stmt->bindValue(":tva", $tva);
	$stmt->bindValue(":description", $description);

	if($stmt->execute())
		return true;
	return false;
}
/*
 * Modification des attributs suivant l'idProduit
 */
function setDesignation($idProduit, $designation){
	$cnx = spdo::getDB();
	$rqt = "UPDATE produit SET designation = :designation WHERE idProduit = :idProduit";
	$stmt = $cnx->prepare($rqt);
	$stmt->bindValue(":idProduit", $idProduit);
	$stmt->bindValue(":designation", $designation);
	if($stmt->execute())
		return true;
	return false;
}
function setPrixHt($idProduit, $newPrix){
	$cnx = spdo::getDB();
	$rqt = "UPDATE produit SET prixht = :prixHt WHERE idProduit = :idProduit";
	$stmt = $cnx->prepare($rqt);
	$stmt->bindValue(":idProduit", $idProduit);
	$stmt->bindValue(":prixHt", $newPrix);
	if($stmt->execute())
		return true;
	return false;
}
function setTva($idProduit, $tva){
	$cnx = spdo::getDB();
	$rqt = "UPDATE produit SET tva = :tva WHERE idProduit = :idProduit";
	$stmt = $cnx->prepare($rqt);
	$stmt->bindValue(":idProduit", $idProduit);
	$stmt->bindValue(":tva", $tva);
	if($stmt->execute())
		return true;
	return false;
}
function setDescription($idProduit, $description){
	$cnx = spdo::getDB();
	$rqt = "UPDATE produit SET description = :description WHERE idProduit = :idProduit";
	$stmt = $cnx->prepare($rqt);
	$stmt->bindValue(":idProduit", $idProduit);
	$stmt->bindValue(":description", $description);
	if($stmt->execute())
		return true;
	return false;
}

/*
 * Recherche d'un produit par ID
 * Retourne le produit ou false si n'existe pas
 */
function getProduitById($idProduit){
	$cnx = spdo::getDB();
	$rqt = "SELECT * FROM produit WHERE idProduit = $idProduit";
	return $cnx->query($rqt);
}
/*
 * Recherche de produit selon leur désignation
 */
function getProduitByDesignation($designation){
	$cnx = spdo::getDB();
	$rqt = "SELECT * FROM produit WHERE designation LIKE '%$designation%'";
	return $cnx->query($rqt);
}
/*
 * Retourne tous les produits
 */
function getProduits(){
	$cnx = spdo::getDB();
	$rqt = "SELECT * FROM produit";
	return $cnx->query($rqt);
}

function getLastProduits(){
	$cnx = spdo::getDB();
	$rqt = "SELECT * FROM produit ORDER BY idProduit DESC LIMIT 4";
	return $cnx->query($rqt);
}
?>
