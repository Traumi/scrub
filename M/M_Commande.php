<?php
/* Fonctions :
 * getCommandeById($idCommande) , getCommandeByMail($mailClient) ,
 * ajouterCommande ,
 */

/*
 * Insertion d'une commande entièrement définie.
 * Retourne true si OK et false en cas d'erreur
 */
function ajouterCommande($mailClient, $rue_facture, $complement_facture, $ville_facture,
						 $cp_facture, $rue_livraison, $complement_livraison,
						 $ville_livraison, $cp_livraison, $prixTotal){
	$cnx = spdo::getDB();
	$rqt = "INSERT INTO commande(mailClient, rue_fact, complement_fact, ville_fact,
								 cp_fact, rue_livraison, complement_livraison,
								 ville_livraison, cp_livraison, prixTotal) ";
	$rqt .= "VALUES(:mailClient, :rue_facture, :complement_facture, :ville_facture,
				   :cp_facture, :rue_livraison, :complement_livraison,
				   :ville_livraison, :cp_livraison, :prixTotal)";
	$stmt = $cnx->prepare($rqt);
	$stmt->bindValue(":mailClient", $mailClient);
	$stmt->bindValue(":rue_facture", $mailClient);
	$stmt->bindValue(":complement_facture", $complement_facture);
	$stmt->bindValue(":ville_facture", $ville_facture);
	$stmt->bindValue(":cp_facture", $cp_facture);
	$stmt->bindValue(":rue_livraison", $rue_livraison);
	$stmt->bindValue(":complement_livraison", $complement_livraison);
	$stmt->bindValue(":ville_livraison", $ville_livraison);
	$stmt->bindValue(":cp_livraison", $cp_livraison);
	$stmt->bindValue(":prixTotal", $prixTotal);

	if($stmt->execute())
		return $cnx->lastInsertId();
	return false;
}

/*
 * Recherche d'une commande par mail client
 * Retourne la commande si OK et false en cas d'erreur
 */
function getCommandeById($idCommande){
	$cnx = spdo::getDB();
	$rqt = "SELECT * FROM commande WHERE idCommande = $idCommande";
	return $cnx->query($rqt);
}

/*
 * Recherche de commande par mail client
 * Retourne la/les commandes si OK et false en cas d'erreur
 */
function getCommandeByMail($mailClient){
	$cnx = spdo::getDB();
	$rqt = "SELECT * FROM commande WHERE mailClient = '$mailClient'";
	return $cnx->query($rqt);
}
?>
