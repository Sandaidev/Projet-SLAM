<?php
/**
 * @param $connexionPDO : connexion à la base de données
 * @return mixed : le tableau des étudiants ou null (something went wrong...)
 */
function Entreprise_Select($connexionPDO)
{
    $requetePreparée = $connexionPDO->prepare('select * from `entreprise` order by denomination');
    $reponse = $requetePreparée->execute(); //$reponse boolean sur l'état de la requête
    $tableauReponse = $requetePreparée->fetchAll(PDO::FETCH_ASSOC);
    return $tableauReponse;
}

/** 
 * @param $connexionPDO : connexion à la base de données
 * @param $idEntreprise
 * @return mixed
 */
function Entreprise_Select_ParId($connexionPDO, $idEntreprise)
{
    $requetePreparée = $connexionPDO->prepare('select * from `entreprise` where idEntreprise = :paramId');
    $requetePreparée->bindParam('paramId', $idEntreprise);
    $reponse = $requetePreparée->execute(); //$reponse boolean sur l'état de la requête
    $etudiant = $requetePreparée->fetch(PDO::FETCH_ASSOC);
    return $etudiant;
}

/**
 * @param $connexionPDO
 * @param $denomination
 * @param $rueAdresse
 * @param $complementAdresse
 * @param $codePostal
 * @param $ville
 * @param $pays
 * @param $mailContact
 * @param $siret
 * @return mixed
 */
function Entreprise_Creer($connexionPDO, $denomination, $rueAdresse, $complementAdresse, $codePostal, $ville, $pays, $mailContact, $siret)
{

    $requetePreparée = $connexionPDO->prepare(
        'INSERT INTO `entreprise` (`idEntreprise`, `denomination`, `rueAdresse`, `complementAdresse`, `codePostal`, `ville`, `pays`, `mailContact`, `siret`) 
VALUES (NULL, :paramdenomination, :paramrueAdresse, :paramcomplementAdresse, :paramcodePostal, :paramville, :parampays, :parammailContact, :paramsiret);;');

    $requetePreparée->bindParam('paramdenomination', $denomination);
    $requetePreparée->bindParam('paramrueAdresse', $rueAdresse);
    $requetePreparée->bindParam('paramcomplementAdresse', $complementAdresse);
    $requetePreparée->bindParam('paramcodePostal', $codePostal);
    $requetePreparée->bindParam('paramville', $ville);
    $requetePreparée->bindParam('parampays', $pays);
//$requetePreparée->bindParam('paramnumCompte',$numCompte);
    $requetePreparée->bindParam('parammailContact', $mailContact);
    $requetePreparée->bindParam('paramsiret', $siret);
    $reponse = $requetePreparée->execute(); //$reponse boolean sur l'état de la requête
    $idEntreprise = $connexionPDO->lastInsertId();

    $numCompte = substr($denomination, 0, 8) . "_" . $idEntreprise;
    Entreprise_Modifier_numCompte($connexionPDO, $idEntreprise, $numCompte);
    Entreprise_Modifier_motDePasse($connexionPDO, $idEntreprise, $numCompte);
    return $idEntreprise;
}

/**
 * @param $connexionPDO
 * @param $idEntreprise
 * @return mixed
 */
function Entreprise_Supprimer($connexionPDO, $idEntreprise)
{

    $requetePreparée = $connexionPDO->prepare('delete entreprise.* from `entreprise` where idEntreprise = :paramId');
    $requetePreparée->bindParam('paramId', $idEntreprise);
    $reponse = $requetePreparée->execute(); //$reponse boolean sur l'état de la requête
    return $reponse;
}

/**
 * @param $connexionPDO
 * @param $idEntreprise
 * @param $denomination
 * @param $rueAdresse
 * @param $complementAdresse
 * @param $codePostal
 * @param $ville
 * @param $pays
 * @param $mailContact
 * @param $siret
 * @return mixed
 */
function Entreprise_Modifier($connexionPDO, $idEntreprise, $denomination, $rueAdresse, $complementAdresse, $codePostal, $ville, $pays, $mailContact, $siret)

{

    $requetePreparée = $connexionPDO->prepare(
        'UPDATE `entreprise` 
	SET `denomination`= :paramdenomination,
	`rueAdresse`= :paramrueAdresse,
	`complementAdresse`= :paramcomplementAdresse,
	`codePostal`= :paramcodePostal ,
	`ville`= :paramville,
	`pays`= :parampays, 
	`mailContact`= :parammailContact,
	`siret`= :paramsiret
	WHERE idEntreprise = :paramidEntreprise');

    $requetePreparée->bindParam('paramdenomination', $denomination);
    $requetePreparée->bindParam('paramrueAdresse', $rueAdresse);
    $requetePreparée->bindParam('paramcomplementAdresse', $complementAdresse);
    $requetePreparée->bindParam('paramcodePostal', $codePostal);
    $requetePreparée->bindParam('paramville', $ville);
    $requetePreparée->bindParam('parampays', $pays);
    $requetePreparée->bindParam('parammailContact', $mailContact);
    $requetePreparée->bindParam('paramsiret', $siret);
    $requetePreparée->bindParam('paramidEntreprise', $idEntreprise);
    $reponse = $requetePreparée->execute(); //$reponse boolean sur l'état de la requête
    return $reponse;
}


/**
 * @param $connexionPDO
 * @param $idEntreprise
 * @param $numCompte
 * @return mixed
 */
function Entreprise_Modifier_numCompte($connexionPDO, $idEntreprise, $numCompte)

{

    $requetePreparée = $connexionPDO->prepare(
        'UPDATE `entreprise` 
SET `numCompte`= :paramnumCompte 
WHERE idEntreprise = :paramidEntreprise');
    $requetePreparée->bindParam('paramnumCompte', $numCompte);
    $requetePreparée->bindParam('paramidEntreprise', $idEntreprise);
    $reponse = $requetePreparée->execute(); //$reponse boolean sur l'état de la requête
    return $reponse;
}

/**
 * @param $connexionPDO
 * @param $idEntreprise
 * @param $siret
 * @return mixed
 */
function Entreprise_Modifier_numSiret($connexionPDO, $idEntreprise, $siret)

{

    $requetePreparée = $connexionPDO->prepare(
        'UPDATE `entreprise` 
SET siret = :paramsiret
WHERE idEntreprise = :paramidEntreprise');
    $requetePreparée->bindParam('paramsiret', $siret);
    $requetePreparée->bindParam('paramidEntreprise', $idEntreprise);
    $reponse = $requetePreparée->execute(); //$reponse boolean sur l'état de la requête
    return $reponse;
}

/**
 * @param $connexionPDO
 * @param $idEntreprise
 * @param $mail
 * @return mixed
 */
function Entreprise_Modifier_mail($connexionPDO, $idEntreprise, $mail)

{

    $requetePreparée = $connexionPDO->prepare(
        'UPDATE `entreprise` 
SET mailContact = :parammailContact
WHERE idEntreprise = :paramidEntreprise');
    $requetePreparée->bindParam('parammailContact', $mail);
    $requetePreparée->bindParam('paramidEntreprise', $idEntreprise);
    $reponse = $requetePreparée->execute(); //$reponse boolean sur l'état de la requête
    return $reponse;
}

/**
 * @param $connexionPDO
 * @param $idEntreprise
 * @param $motDePasseClair
 * @return mixed
 */
function Entreprise_Modifier_motDePasse($connexionPDO, $idEntreprise, $motDePasseClair)

{
    $parammotDePasseHache = password_hash($motDePasseClair, PASSWORD_DEFAULT);

    $requetePreparée = $connexionPDO->prepare(
        'UPDATE `entreprise` 
SET motDePasse = :parammotDePasseHache
WHERE idEntreprise = :paramidEntreprise');
    $requetePreparée->bindParam('parammotDePasseHache', $parammotDePasseHache);
    $requetePreparée->bindParam('paramidEntreprise', $idEntreprise);
    $reponse = $requetePreparée->execute(); //$reponse boolean sur l'état de la requête
    return $reponse;
}

/**
 * @param $connexionPDO
 * @param $numCompte
 * @return mixed
 */
function Entreprise_Select_ParCompte($connexionPDO, $numCompte)
{
    $requetePreparée = $connexionPDO->prepare('select * from `entreprise` where numCompte = :paramnumCompte');
    $requetePreparée->bindParam('paramnumCompte', $numCompte);
    $reponse = $requetePreparée->execute(); //$reponse boolean sur l'état de la requête
    $entreprise = $requetePreparée->fetch(PDO::FETCH_ASSOC);
    return $entreprise;
}
