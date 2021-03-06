<?php

function produit_modifier_url_image($connexioPDO, $id_produit, $url_image)
{
    $request = $connexioPDO->prepare("UPDATE `produit` SET `imgSrc` = :paramURL WHERE `produit`.`idProduit` = :paramID;");
    $request->bindParam("paramURL", $url_image);
    $request->bindParam("paramID", $id_produit);
    $reponse = $request->execute();
    return $reponse;
}

/**
 * @param $connexionPDO : connexion à la base de données
 * @return mixed : le tableau des produits ou null (something went wrong...)
 */
function produit_select($connexionPDO)
{
    $requetePreparée = $connexionPDO->prepare('select * from `produit`');
    $reponse = $requetePreparée->execute();
    $tableauReponse = $requetePreparée->fetchAll(PDO::FETCH_ASSOC);
    return $tableauReponse;
}

function produit_desactiver($connexionPDO, $id_produit)
{
    $db_request = $connexionPDO->prepare("UPDATE `produit` SET `statusProduit` = 0 WHERE `produit`.`idProduit` = :paramIDProduit; ");
    $db_request->bindParam('paramIDProduit', $id_produit);
    $reponse = $db_request->execute();
    return $reponse;
}

function produit_activer($connexionPDO, $id_produit)
{
    $db_request = $connexionPDO->prepare("UPDATE `produit` SET `statusProduit` = 1 WHERE `produit`.`idProduit` = :paramIDProduit; ");
    $db_request->bindParam('paramIDProduit', $id_produit);
    $reponse = $db_request->execute();
    return $reponse;
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
    $requetePreparée = $connexionPDO->prepare('SELECT * FROM `produit` WHERE `idCategorie` = :paramIDCategorie');
    $requetePreparée->bindParam('paramIDCategorie', $idCategorie);
    $reponse = $requetePreparée->execute(); //$reponse boolean sur l'état de la requête
    $produits = $requetePreparée->fetchAll(PDO::FETCH_ASSOC);
    return $produits;
}

/**
 * @param $connexionPDO
 * @param $idCategorie
 * @param $nomProduit
 * @param $description
 * @param $prixHT
 * @param $status_produit
 * @param $id_tva
 * @param $resume
 * @return bool
 */
function produit_creer($connexionPDO, $idCategorie, $nomProduit, $description, $prixHT, $resume, $status_produit, $id_tva)
{
    $requetePreparée = $connexionPDO->prepare(
        'INSERT INTO `produit` (`idCategorie`, `nomProduit`, `description`, `codeReference`, `prixHT`, `resume`, `imgSrc`, `statusProduit`, `idTVA`)
         VALUES (:paramIDCategorie, :paramNomProduit, :paramDescription, NULL, :paramPrixHT, :paramResume, NULL, :paramStatusProduit, :paramIDTVA);');

    $requetePreparée->bindParam('paramIDCategorie', $idCategorie);
	$requetePreparée->bindParam('paramNomProduit', $nomProduit);
	$requetePreparée->bindParam('paramDescription', $description);
	$requetePreparée->bindParam('paramPrixHT', $prixHT);
    $requetePreparée->bindParam('paramResume', $resume);
    $requetePreparée->bindParam('paramStatusProduit', $status_produit);
    $requetePreparée->bindParam('paramIDTVA', $id_tva);
    $requetePreparée->execute();

    // Le code de référence est dynamique
	// C'est les trois premières lettres du produit suivi de son ID dans la BDD
	$codeReference_id = $connexionPDO->lastInsertId();

    $nomProduit_code = utf8_encode($nomProduit);
    $nomProduit_code = iconv('UTF-8', 'ASCII//TRANSLIT', $nomProduit_code);

	$codeReference = substr(strtoupper($nomProduit_code), 0, 3) . "_" . $codeReference_id;
	$requetePreparée = $connexionPDO->prepare(
	  'UPDATE `produit` SET `codeReference` = :paramREF WHERE `produit`.`idProduit` = :paramID;'
    );

	$id_produit = produit_selectParID($connexionPDO, $codeReference_id)["idProduit"];

    $requetePreparée->bindParam('paramREF', $codeReference);
    $requetePreparée->bindParam('paramID', $id_produit);

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
		SET `produit`.`idCategorie`= :paramIDCategorie,
			`nomProduit`= :paramNomProduit,
			`description`= :paramDescription,
			`prixHT`= :paramPrixHT,
			`resume`= :paramResume
		WHERE `produit`.`idProduit` = :paramIDProduit');

    $requetePreparée->bindParam(':paramIDCategorie', $idCategorie);
    $requetePreparée->bindParam(':paramNomProduit', $nomProduit);
    $requetePreparée->bindParam(':paramDescription', $description);
	$requetePreparée->bindParam(':paramPrixHT', $prixHT);
	$requetePreparée->bindParam(':paramResume', $resume);
	$requetePreparée->bindParam(':paramIDProduit', $idProduit);

    $reponse = $requetePreparée->execute();
    return $reponse;
}
