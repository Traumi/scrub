CREATE TABLE Client
(
mail VARCHAR(100) PRIMARY KEY,
nom VARCHAR(50) NOT NULL,
prenom VARCHAR(50) NOT NULL,
mdp VARCHAR(50) NOT NULL,
rue VARCHAR(200) NOT NULL,
complement VARCHAR(200),
ville VARCHAR(100) NOT NULL,
cp CHAR(5) NOT NULL
);

CREATE TABLE Produit
(
idProduit INT PRIMARY KEY AUTO_INCREMENT,
designation VARCHAR(100) NOT NULL,
prixht DECIMAL(4,2) NOT NULL,
tva DECIMAL(2,1) NOT NULL,
description VARCHAR(2000)
);

CREATE TABLE Image
(
idImage INT PRIMARY KEY AUTO_INCREMENT,
idProduit INT NOT NULL,
url VARCHAR(100) NOT NULL
);

ALTER TABLE Image
ADD CONSTRAINT FK_ImageProduit 
FOREIGN KEY(idProduit) REFERENCES Produit(idProduit);

CREATE TABLE commande 
(
idCommande INT AUTO_INCREMENT PRIMARY KEY,
mailClient VARCHAR(100) NOT NULL,
rue_fact VARCHAR(200) NOT NULL,
complement_fact	VARCHAR(200) NOT NULL,
ville_fact VARCHAR(100) NOT NULL,
cp_fact	CHAR(5) NOT NULL,
rue_livraison VARCHAR(200) NOT NULL,
complement_livraison VARCHAR(200) NOT NULL,
ville_livraison VARCHAR(100) NOT NULL,
cp_livraison CHAR(5) NOT NULL,
prixTotal DECIMAL(5,2) NOT NULL
);

ALTER TABLE commande
ADD CONSTRAINT FK_CommandeClient
FOREIGN KEY (mailClient) REFERENCES client(mail);

CREATE TABLE produitCommande
(
idProduit INT,
idCommande INT
);

ALTER TABLE produitCommande
ADD CONSTRAINT PK_ProduitCommande PRIMARY KEY (idProduit, idCommande);