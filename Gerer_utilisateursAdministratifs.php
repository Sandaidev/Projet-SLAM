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

        // On doit entrer les valeurs de l'utilisateur à modifier dans la vue.
        $id_utilisateur_admin = $utilisateur_admin["idUtilisateur"];
        $login = $utilisateur_admin["login"];
        $niveau_autorisation = $utilisateur_admin["niveauAutorisation"];

        // On affiche le formulaire de modification d'utilisateur
        Vue_Gestion_Utilisateur_Administratif_Formulaire(false, $id_utilisateur_admin, $login, $niveau_autorisation);
    } elseif (isset($_REQUEST["mettreAJour"])) {
        // L'administrateur a choisi de modifier les infos d'un utilisateur. (bouton de confirmation)
        // On a l'ancien login et le nouveau
        $id_utilisateur_edit = $_REQUEST["id_utilisateur_edit"];
        $nouveau_login = $_REQUEST["nouveau_login"];
        $nouvelle_autorisation = $_REQUEST["niveauAutorisation"];

        Utilisateur_Modifier($connexion, $id_utilisateur_edit, $nouveau_login, $nouvelle_autorisation);

        $liste_utilisateurs_administratifs = Utilisateur_Select($connexion);
        Vue_Gestion_Utilisateurs_Admin_Liste($liste_utilisateurs_administratifs);
    }

    elseif (isset($_REQUEST["Supprimer"])) {
        Utilisateur_Supprimer($connexion, $_REQUEST["idUtilisateurAdmin"]);

        $liste_utilisateurs_administratifs = Utilisateur_Select($connexion);
        Vue_Gestion_Utilisateurs_Admin_Liste($connexion);
    }

    else {
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
