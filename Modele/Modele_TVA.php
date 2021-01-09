<?php

/**
 * @param $connexionPDO
 * @return mixed
 */
function TVA_select($connexionPDO)
{
    $requetePreparée = $connexionPDO->prepare('select * from `tva`');
    $requetePreparée->execute();
    $lignes_tva = $requetePreparée->fetchAll(PDO::FETCH_ASSOC);
    return $lignes_tva;
}

/**
 * @param $connexionPDO
 * @param $idTVA
 * @return mixed
 */
function TVA_selectParID($connexionPDO, $idTVA)
{
    $requetePreparée = $connexionPDO->prepare('SELECT * FROM `tva` WHERE `idTVA` = :paramIDTVA');
    $requetePreparée->bindParam('paramIDTVA', $idTVA);

    $requetePreparée->execute();
    $ligne_tva = $requetePreparée->fetchAll(PDO::FETCH_ASSOC);
    return $ligne_tva;
}

/**
 * @param $connexionPDO
 * @param $nomTVA
 * @param $tauxTVA
 * @return bool
 */
function TVA_creer($connexionPDO, $nomTVA, $tauxTVA)
{
    $requetePreparée = $connexionPDO->prepare(
        'INSERT INTO `tva` (`nomTVA`, `tauxTVA`) 
         VALUES (:paramNomTVA, :paramTauxTVA);');

    $requetePreparée->bindParam('paramNomTVA', $nomTVA);
    $requetePreparée->bindParam('paramTauxTVA', $tauxTVA);

    $reponse = $requetePreparée->execute(); //$reponse boolean sur l'état de la requête
    return $reponse;
}

/**
 * @param $connexionPDO
 * @param $idTVA
 * @return bool
 */
function TVA_supprimer($connexionPDO, $idTVA)
{
    $requetePreparée = $connexionPDO->prepare('delete tva.* from `tva` where idTVA = :paramID');
    $requetePreparée->bindParam('paramID', $idTVA);

    $reponse = $requetePreparée->execute(); //$reponse boolean sur l'état de la requête
    return $reponse;
}

/**
 * @param $connexionPDO
 * @param $idTVA
 * @param $nomTVA
 * @param $tauxTVA
 * @return bool
 */
function TVA_modifier($connexionPDO, $idTVA, $nomTVA, $tauxTVA)
{
    $requetePreparée = $connexionPDO->prepare(
        '
		UPDATE `tva` 
		SET `tva`.`nomTVA`= :paramNomTVA,
			`tauxTVA`= :paramTauxTVA
		WHERE `tva`.`idTVA` = :paramIDTVA');

    $requetePreparée->bindParam(':paramNomTVA', $nomTVA);
    $requetePreparée->bindParam(':paramTauxTVA', $tauxTVA);
    $requetePreparée->bindParam(':paramIDTVA', $idTVA);

    $reponse = $requetePreparée->execute();
    return $reponse;
}
