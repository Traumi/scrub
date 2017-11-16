<?php
//FAUT FAIRE AJOUT CLIENT, MODIF CLIENT, CONNEXION CLIENT

function existClient($mail){
	$cnx = spdo::getDB();
	$requete = "SELECT * FROM client WHERE mail = '$mail'";
	return $cnx->query($requete)->fetch();
}

function getClient ($mail){
	$cnx = spdo::getDB();
	$requete = "SELECT nom, prenom, mail, rue, complement, ville, cp FROM client WHERE mail = '$mail'";
	return $cnx->query($requete)->fetch();
}

function getClients (){
	$cnx = spdo::getDB();
	$requete = "SELECT nom, prenom, mail, rue, complement, ville, cp FROM client";
	return $cnx->query($requete);
}

function ajouterClient ($nom, $prenom, $mail, $mdp, $rue, $complement, $ville, $cp){
	$cnx = spdo::getDB();
	$requete = "INSERT INTO client (nom,prenom,mail,mdp,rue,complement,ville,cp) VALUES (:nom,:prenom,:mail,:mdp,:rue,:complement,:ville,:cp)";
	$stmt = $cnx->prepare($requete);
	$stmt->bindValue(":nom",$nom);
	$stmt->bindValue(":prenom",$prenom);
	$stmt->bindValue(":mail",$mail);
	$stmt->bindValue(":mdp",$mdp);
	$stmt->bindValue(":rue",$rue);
	$stmt->bindValue(":complement",$complement);
	$stmt->bindValue(":ville",$ville);
	$stmt->bindValue(":cp",$cp);
	if($stmt->execute()){
		return true;
	}
	return false;
}

function authClient($mail,$mdp){
	$cnx = spdo::getDB();
	$requete = "SELECT * FROM client WHERE mail = '$mail' AND mdp = '$mdp'";
	return $cnx->query($requete)->fetch()['mail'];
}

function modifClient($nom, $prenom, $mail, $mdp, $rue, $complement, $ville, $cp, $currentMail){
	$cnx = spdo::getDB();
	$requete = "UPDATE client";
	$requete .= "nom = ':nom'";
	$requete .= "prenom = ':prenom'";
	$requete .= "mail = ':mail'";
	$requete .= "mdp = ':mdp'";
	$requete .= "rue = ':rue'";
	$requete .= "complement = ':complement'";
	$requete .= "ville = ':ville'";
	$requete .= "cp = ':cp'";
	$requete .= "WHERE mail = :currentMail";
	$stmt = $cnx->prepare($requete);
	$stmt->bindValue(":nom",$nom);
	$stmt->bindValue(":prenom",$prenom);
	$stmt->bindValue(":mail",$mail);
	$stmt->bindValue(":mdp",$mdp);
	$stmt->bindValue(":rue",$rue);
	$stmt->bindValue(":complement",$complement);
	$stmt->bindValue(":ville",$ville);
	$stmt->bindValue(":cp",$cp);
	$stmt->bindValue(":currentMail",$currentMail);
	$client = $stmt->execute();
	return getClient($cnx->lastInsertId());
}
