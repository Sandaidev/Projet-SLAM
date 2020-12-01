<?php
/**
 * @param $connexionPDO : connexion à la base de données
 * @return mixed : le tableau des étudiants ou null (something went wrong...)
 */
function Utilisateur_Select($connexionPDO)
{
    $requetePreparée = $connexionPDO->prepare('select * from `utilisateur` order by login');
    $reponse = $requetePreparée->execute(); //$reponse boolean sur l'état de la requête
    $tableauReponse = $requetePreparée->fetchAll(PDO::FETCH_ASSOC);
    return $tableauReponse;
}

/**
 * @param $connexionPDO
 * @param $idUtilisateur
 * @return mixed
 */
function Utilisateur_Select_ParId($connexionPDO, $idUtilisateur)
{
    $requetePreparée = $connexionPDO->prepare('select * from `utilisateur` where idUtilisateur = :paramId');
    $requetePreparée->bindParam('paramId', $idUtilisateur);
    $reponse = $requetePreparée->execute(); //$reponse boolean sur l'état de la requête
    $etudiant = $requetePreparée->fetch(PDO::FETCH_ASSOC);
    return $etudiant;
}

/**
 * @param $connexionPDO
 * @param $idUtilisateur
 * @return mixed
 */
function Utilisateur_Select_ParLogin($connexionPDO, $login)
{
    $requetePreparée = $connexionPDO->prepare('select * from `utilisateur` where login = :paramLogin');
    $requetePreparée->bindParam('paramLogin', $login);
    $reponse = $requetePreparée->execute(); //$reponse boolean sur l'état de la requête
    $etudiant = $requetePreparée->fetch(PDO::FETCH_ASSOC);
    return $etudiant;
}

/**
 * @param $connexionPDO
 * @param $login
 * @param $niveauAutorisation
 * @return mixed
 */
function Utilisateur_Creer($connexionPDO, $login, $niveauAutorisation)
{

    $requetePreparée = $connexionPDO->prepare(
        'INSERT INTO `utilisateur` (`idUtilisateur`, `login`, `niveauAutorisation`, `motDePasse`) 
         VALUES (NULL, :paramlogin, :paramniveauAutorisation, "");');

    $requetePreparée->bindParam('paramlogin', $login);
    $requetePreparée->bindParam('paramniveauAutorisation', $niveauAutorisation);
    $reponse = $requetePreparée->execute(); //$reponse boolean sur l'état de la requête
    $idUtilisateur = $connexionPDO->lastInsertId();

    return $idUtilisateur;
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

