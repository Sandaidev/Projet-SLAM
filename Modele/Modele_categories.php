<?php
/**
 * @param $connexionPDO : connexion à la base de données
 * @return mixed : le tableau des catégories ou null (something went wrong...)
 */
function Categorie_select($connexionPDO)
{
    $requetePreparée = $connexionPDO->prepare('select * from `categorie` order by idCategorie');
    $reponse = $requetePreparée->execute(); //$reponse boolean sur l'état de la requête
    $tableauReponse = $requetePreparée->fetchAll(PDO::FETCH_ASSOC);
    return $tableauReponse;
}

/**
 * @param $connexionPDO : connexion à la base de données
 * @param $idCategorie
 * @return mixed
 */
function categorie_selectParID($connexionPDO, $idCategorie)
{
    $requetePreparée = $connexionPDO->prepare('select * from `categorie` where idCategorie = :paramId');
    $requetePreparée->bindParam('paramId', $idCategorie);
    $reponse = $requetePreparée->execute(); //$reponse boolean sur l'état de la requête
    $categorie = $requetePreparée->fetch(PDO::FETCH_ASSOC);
    return $categorie;
}

/**
 * @param $connexionPDO
 * @param $nomCategorie
 * @return int
 */
function Categorie_Creer($connexionPDO, $nomCategorie)
{

    $requetePreparée = $connexionPDO->prepare(
        'INSERT INTO `categorie` (`idCategorie`, `nomCategorie`) 
         VALUES (NULL, :paramNomCategorie);');

    $requetePreparée->bindParam('paramNomCategorie', $nomCategorie);

    $reponse = $requetePreparée->execute(); // $reponse boolean sur l'état de la requête
    $idCategorie = $connexionPDO->lastInsertId();

    return $idCategorie;
}

/**
 * @param $connexionPDO
 * @param $idCategorie
 * @return bool
 */
function Categorie_Supprimer($connexionPDO, $idCategorie)
{

    $requetePreparée = $connexionPDO->prepare('delete categorie.* from `categorie` where idCategorie = :paramId');
    $requetePreparée->bindParam('paramId', $idCategorie);
    $reponse = $requetePreparée->execute(); // $reponse boolean sur l'état de la requête
    return $reponse;
}

/**
 * @param $connexionPDO
 * @param $idCategorie
 * @param $nomCategorie
 * @return bool
 */
function Categorie_Modifier($connexionPDO, $idCategorie, $nomCategorie)
{
    $requetePreparée = $connexionPDO->prepare(
        'UPDATE `categorie` 
         SET `nomCategorie`= :paramNom    
         WHERE idCategorie = :paramID');

    $requetePreparée->bindParam('paramNom', $nomCategorie);
    $requetePreparée->bindParam('paramID', $idCategorie);
    $reponse = $requetePreparée->execute(); //$reponse boolean sur l'état de la requête

    return $reponse;
}
