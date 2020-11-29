<?php
include_once("autoload.php");

/**
 * Contrôleur gérant la connexion à la page administration.
 * En cas de succès, il affiche uniquement le menu d'administration.
 */



if (isset($_REQUEST["login"]) and isset($_REQUEST["password"])) {//Si tous les paramètres du formulaire sont bons
    $connexion = Creer_Connexion();
    //Vérification du mot de passe
    $utilisateur = Utilisateur_Select_ParLogin($connexion, $_REQUEST["login"]);
    if ($utilisateur != null) {
        if (password_verify($_REQUEST["password"], $utilisateur["motDePasse"])) {//le mot de passe est associable à ce Hash

            $_SESSION["idUtilisateur"] = $utilisateur["idUtilisateur"];
            Vue_Structure_Entete();
            Vue_Administration_Menu();
        } else {//mot de passe pas bon
            $msgError = "Mot de passe erroné";
            Vue_Structure_Entete();
            Vue_Connexion_Formulaire_connexion_administration($msgError);
        }
    } else {
        $msgError = "Login non trouvé";
        Vue_Structure_Entete();
        Vue_Connexion_Formulaire_connexion_administration($msgError);
    }
} else {   //Il y a un raté quelque part !
    if (isset($_REQUEST["login"]) or isset($_REQUEST["password"]))
        $msgError = "Vous devez saisir toutes les informations";
    else
        $msgError = "";
    Vue_Structure_Entete();
    Vue_Connexion_Formulaire_connexion_administration($msgError);
}

Vue_Structure_BasDePage();