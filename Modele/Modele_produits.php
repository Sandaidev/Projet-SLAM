<?php
/**
 * @param $connexionPDO : connexion à la base de données
 * @return mixed : le tableau des produits ou null (something went wrong...)
 */
function Produit_select($connexionPDO)
{
    $requetePreparée = $connexionPDO->prepare('select * from `produit`');
    $reponse = $requetePreparée->execute(); //$reponse boolean sur l'état de la requête
    $tableauReponse = $requetePreparée->fetchAll(PDO::FETCH_ASSOC);
    return $tableauReponse;
}

/**
 * @param $connexionPDO
 * @param $idProduit
 * @return mixed
 */
function produit_selectParID($connexionPDO, $idProduit)
{
    $requetePreparée = $connexionPDO->prepare('select * from `produit` where idProduit = :paramId');
    $requetePreparée->bindParam('paramId', $idProduit);
    $reponse = $requetePreparée->execute(); // $reponse boolean sur l'état de la requête
    $produit = $requetePreparée->fetch(PDO::FETCH_ASSOC);
    return $produit;
}

/**
 * @param $connexionPDO
 * @param $idCategorie
 * @return mixed
 */
function produit_selectParCategorie($connexionPDO, $idCategorie)
{
    $requetePreparée = $connexionPDO->prepare('select * from `produit` where idCategorie = :paramIDCategorie');
    $requetePreparée->bindParam('paramIDCategorie', $idCategorie);
    $reponse = $requetePreparée->execute(); //$reponse boolean sur l'état de la requête
    $produits = $requetePreparée->fetch(PDO::FETCH_ASSOC);
    return $produits;
}

/**
 * @param $connexionPDO
 * @param $idCategorie
 * @param $nomProduit
 * @param $description
 * @param $codeReference
 * @param $prixHT
 * @param $resume
 * @return mixed
 */
function produit_creer($connexionPDO, $idCategorie, $nomProduit, $description, $prixHT, $resume)
{
    $requetePreparée = $connexionPDO->prepare(
        'INSERT INTO `produit` (`idCategorie`, `nomProduit`, `description`, `codeReference`, `prixHT`, `resume`) 
         VALUES (:paramIDCategorie, :paramNomProduit, :paramDescription, :paramCodeReference, :paramPrixHT, :paramResume);');

    $requetePreparée->bindParam('paramIDCategorie', $idCategorie);
	$requetePreparée->bindParam('paramNomProduit', $nomProduit);
	$requetePreparée->bindParam('paramDescription', $description);
	$requetePreparée->bindParam('paramPrixHT', $prixHT);
    $requetePreparée->bindParam('paramResume', $resume);

    // Le code de référence est dynamique
	// C'est les trois premières lettres du produit suivi de son ID dans la BDD
	$codeReference_id = $connexionPDO->lastInsertId();
	$codeReference = substr(strtoupper($nomProduit), 0, 3) . "_" . $codeReference_id;
	$requetePreparée->bindParam('paramCodeReference', $codeReference);

	$reponse = $requetePreparée->execute(); //$reponse boolean sur l'état de la requête

    return $reponse;
}

/**
 * @param $connexionPDO
 * @param $idUtilisateur
 * @return mixed
 */
function Utilisateur_Supprimer($connexionPDO, $idUtilisateur)
{

    $requetePreparée = $connexionPDO->prepare('delete utilisateur.* from `utilisateur` where idUtilisateur = :paramId');
    $requetePreparée->bindParam('paramId', $idUtilisateur);
    $reponse = $requetePreparée->execute(); //$reponse boolean sur l'état de la requête
    return $reponse;
}

/**
 * @param $connexionPDO
 * @param $idUtilisateur
 * @param $login
 * @param $niveauAutorisation
 * @return mixed
 */
function Utilisateur_Modifier($connexionPDO, $idUtilisateur, $login, $niveauAutorisation)

{

    $requetePreparée = $connexionPDO->prepare(
        'UPDATE `utilisateur` 
SET `login`= :paramlogin,
`niveauAutorisation`= :paramniveauAutorisation
WHERE idUtilisateur = :paramidUtilisateur');
    $requetePreparée->bindParam('paramlogin', $login);
    $requetePreparée->bindParam('paramniveauAutorisation', $niveauAutorisation);
    $requetePreparée->bindParam('paramidUtilisateur', $idUtilisateur);
    $reponse = $requetePreparée->execute(); //$reponse boolean sur l'état de la requête
    return $reponse;
}
