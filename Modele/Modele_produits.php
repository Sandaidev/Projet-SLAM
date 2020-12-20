<?php
/**
 * @param $connexionPDO : connexion à la base de données
 * @return mixed : le tableau des produits ou null (something went wrong...)
 */
function produit_select($connexionPDO)
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
 * @return bool
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
 * @param $idProduit
 * @return bool
 */
function produit_supprimer($connexionPDO, $idProduit)
{
    $requetePreparée = $connexionPDO->prepare('delete produit.* from `produit` where idProduit = :paramId');
    $requetePreparée->bindParam('paramId', $idProduit);
    $reponse = $requetePreparée->execute(); //$reponse boolean sur l'état de la requête
    return $reponse;
}

/**
 * @param $connexionPDO
 * @param $idProduit
 * @param $idCategorie
 * @param $nomProduit
 * @param $description
 * @param $prixHT
 * @param $resume
 * @return bool
 */
function produit_modifier($connexionPDO, $idProduit, $idCategorie, $nomProduit, $description, $prixHT, $resume)
{
    $requetePreparée = $connexionPDO->prepare(
        '
		UPDATE `produit` 
		SET `idCategorie`= :paramIDCategorie,
			`nomProduit`= :paramNomProduit,
			`description`= :paramDescription,
			`prixHT`= :paramPrixHT,
			`resume`= :paramResume,
		WHERE idProduit = :paramIDProduit');

    $requetePreparée->bindParam('paramIDCategorie', $idCategorie);
    $requetePreparée->bindParam('paramNomProduit', $nomProduit);
    $requetePreparée->bindParam('paramDescription', $description);
	$requetePreparée->bindParam('paramPrixHT', $prixHT);
	$requetePreparée->bindParam('paramResume', $resume);
	$requetePreparée->bindParam('paramIDProduit', $idProduit);

    $reponse = $requetePreparée->execute();
    return $reponse;
}
