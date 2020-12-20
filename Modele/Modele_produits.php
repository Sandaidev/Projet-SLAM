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
 * @param $login
 * @param $niveauAutorisation
 * @return mixed
 */
function Utilisateur_Creer($connexionPDO, $login, $niveauAutorisation, $statusUtilisateur="1")
{

    $requetePreparée = $connexionPDO->prepare(
        'INSERT INTO `utilisateur` (`idUtilisateur`, `login`, `niveauAutorisation`, `motDePasse`, `statusUtilisateur`) 
         VALUES (NULL, :paramlogin, :paramniveauAutorisation, "", :paramStatus);');

    $requetePreparée->bindParam('paramlogin', $login);
    $requetePreparée->bindParam('paramniveauAutorisation', $niveauAutorisation);
    $requetePreparée->bindParam('paramStatus', $statusUtilisateur);

    $reponse = $requetePreparée->execute(); //$reponse boolean sur l'état de la requête
    $idUtilisateur = $connexionPDO->lastInsertId();

    return $idUtilisateur;
}

function Utilisateur_SetStatus($connexionPDO, $idUtilisateur, $status) {
    $requetePreparee = $connexionPDO->prepare(
        'UPDATE `utilisateur` SET `statusUtilisateur` = :paramStatus
         WHERE `utilisateur`.`idUtilisateur` = :paramIDUtilisateur '
    );

    $requetePreparee->bindParam('paramStatus', $status);
    $requetePreparee->bindParam('paramIDUtilisateur', $idUtilisateur);

    $reponse = $requetePreparee->execute();
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


/**
 * @param $connexionPDO
 * @param $idUtilisateur
 * @param $motDePasseClair
 * @return mixed
 */
function Utilisateur_Modifier_motDePasse($connexionPDO, $idUtilisateur, $motDePasseClair)

{
    $parammotDePasseHache = password_hash($motDePasseClair, PASSWORD_DEFAULT);

    $requetePreparée = $connexionPDO->prepare(
        'UPDATE `utilisateur` 
SET motDePasse = :parammotDePasseHache
WHERE idUtilisateur = :paramidUtilisateur');
    $requetePreparée->bindParam('parammotDePasseHache', $parammotDePasseHache);
    $requetePreparée->bindParam('paramidUtilisateur', $idUtilisateur);
    $reponse = $requetePreparée->execute(); //$reponse boolean sur l'état de la requête
    return $reponse;
}

