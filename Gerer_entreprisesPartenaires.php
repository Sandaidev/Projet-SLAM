<?php
include("autoload.php");

/**
 * Ce contrôleur est dédié à la gestion des entreprises partenaires.
 * Toutes les pages de cette user story renvoie sur ce contrôleur.
 * Le tri entre les actions est fait sur l'existence des boutons submit. Deux boutons ne doivent pas avoir le même nom ! ;)
 */
Vue_Structure_Entete();

if(isset($_SESSION["idUtilisateur"])) {
    Vue_Administration_Menu();

    $connexion = Creer_Connexion();

    if (isset($_REQUEST["Modifer"])) {
        //Modifier dans le formulaire de mise à jour
        $entreprise = Entreprise_Select_ParId($connexion, $_REQUEST["idEntreprise"]);
        Vue_Gestion_Entreprise_Formulaire(false, $entreprise["idEntreprise"], $entreprise["denomination"], $entreprise["rueAdresse"], $entreprise["complementAdresse"], $entreprise["codePostal"]
            , $entreprise["ville"], $entreprise["pays"], $entreprise["numCompte"], $entreprise["mailContact"], $entreprise["siret"]);

    } elseif (isset($_REQUEST["mettreAJour"])) {
        //Mettre à jour dans la liste des entreprises
        Entreprise_Modifier($connexion, $_REQUEST["idEntreprise"], $_REQUEST["denomination"], $_REQUEST["rueAdresse"], $_REQUEST["complementAdresse"], $_REQUEST["codePostal"]
            , $_REQUEST["ville"], $_REQUEST["pays"], $_REQUEST["mailContact"], $_REQUEST["siret"]);
        $listeEntreprise = Entreprise_Select($connexion);
        Vue_Gestion_Entreprise_Liste($listeEntreprise);

    } elseif (isset($_REQUEST["réinitialiserMDP"])) {
        //Réinitialiser MDP sur la fiche de l'entreprise
        $entreprise = Entreprise_Select_ParId($connexion, $_REQUEST["idEntreprise"]);
		Entreprise_Modifier_motDePasse($connexion, $_REQUEST["idEntreprise"], "secret");
		$listeEntreprise = Entreprise_Select($connexion);
        Vue_Gestion_Entreprise_Liste($listeEntreprise);

    } elseif (isset($_REQUEST["nouveau"])) {
        //Nouveau sur la liste des entreprises
        Vue_Gestion_Entreprise_Formulaire(true);

    } elseif (isset($_REQUEST["buttonCreer"])) {
        //Créer sur la fiche de création d'une entreprise
        Entreprise_Creer($connexion, $_REQUEST["denomination"], $_REQUEST["rueAdresse"], $_REQUEST["complementAdresse"], $_REQUEST["codePostal"]
            , $_REQUEST["ville"], $_REQUEST["pays"], $_REQUEST["mailContact"], $_REQUEST["siret"]);
		Entreprise_Modifier_motDePasse($connexion, $_REQUEST["idEntreprise"], "secret");


		$listeEntreprise = Entreprise_Select($connexion);
        Vue_Gestion_Entreprise_Liste($listeEntreprise);
    } elseif (isset($_REQUEST["Supprimer"])) {
        Entreprise_Supprimer($connexion, $_REQUEST["idEntreprise"]);
        $listeEntreprise = Entreprise_Select($connexion);
        Vue_Gestion_Entreprise_Liste($listeEntreprise);

    }

    else
    {
        //situation par défaut :
        $listeEntreprise = Entreprise_Select($connexion);
        Vue_Gestion_Entreprise_Liste($listeEntreprise);

    }
}
else
{
    //l'utilisateur n'est pas connecté, il n'aurait jamais du arriver ici !
    Vue_Connexion_Formulaire_connexion_administration();
}
Vue_Structure_BasDePage();