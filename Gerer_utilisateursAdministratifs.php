<?php
include("autoload.php");

/**
 * Ce contrôleur est dédié à la gestion des utilisateurs administratifs.
 * Toutes les pages de cette user story renvoie sur ce contrôleur.
 * Le tri entre les actions est fait sur l'existence des boutons submit.
 */

Vue_Structure_Entete();

if(isset($_SESSION["idUtilisateur"])) {
    Vue_Administration_Menu();
    $connexion = Creer_Connexion();

    if (isset($_REQUEST["Modifier"])) {
        // Mettre à jour les infos d'un utilisateur administratif
        $utilisateur_admin = Utilisateur_Select_ParId($connexion, $_REQUEST["idUtilisateurAdmin"]);
        Vue_Gestion_Utilisateur_Formulaire($utilisateur_admin);
//    } elseif (isset($_REQUEST[""]))

    } else {
        // Situation par défaut, on affiche la liste des utilisateurs administratifs
        $liste_utilisateurs_administratifs = Utilisateur_Select($connexion);
        Vue_Gestion_Utilisateurs_Admin_Liste($liste_utilisateurs_administratifs);
    }
} else {
    // Si on arrive là alors my bad, j'ai foiré!
    // On redirige l'utilisateur vers la page de connexion
    Vue_Connexion_Formulaire_connexion_administration();
}

Vue_Structure_BasDePage();
