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

    // On récupère le niveau de permission de l'utilisateur sur la page.
    $niveau_autorisation = Utilisateur_Select_ParId($connexion, $_SESSION["idUtilisateur"])["niveauAutorisation"];

    if ($niveau_autorisation == 1) {
        // Dans le cas ou l'utilisateur connexté aurait le niveau d'autorisation no.1
        // on lui donne les outils d'administration des utilisateurs.

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
        } elseif (isset($_REQUEST["Supprimer"])) {
            Utilisateur_Supprimer($connexion, $_REQUEST["idUtilisateurAdmin"]);

            $liste_utilisateurs_administratifs = Utilisateur_Select($connexion);
            Vue_Gestion_Utilisateurs_Admin_Liste($liste_utilisateurs_administratifs);
        } elseif (isset($_REQUEST["Nouveau"])) {
            Vue_Gestion_Utilisateur_Administratif_Formulaire(true);
        } elseif (isset($_REQUEST["buttonCreer"])) {
            // L'administrateur a confirmé la création d'un utilisateur
            // Il nous faut son mot de passe, son login, son niveau.

            $login = $_REQUEST["nouveau_login"];
            $niveau_autorisation = $_REQUEST["niveauAutorisation"];

            // On crée l'utilisateur dans la BDD
            $id_utilisateur_cree = Utilisateur_Creer($connexion, $login, $niveau_autorisation, "1");
            Utilisateur_Modifier_motDePasse($connexion, $id_utilisateur_cree, "secret");

            // Tout est OK! on peut afficher la liste
            $liste_utilisateurs_administratifs = Utilisateur_Select($connexion);
            Vue_Gestion_Utilisateurs_Admin_Liste($liste_utilisateurs_administratifs);
        } elseif (isset($_REQUEST["Desactiver"])) {
            // L'administrateur a choisi de désactiver l'utilisateur sélectionné,
            // On a besoin de son ID

            $id_utilisateur = $_REQUEST["idUtilisateurAdmin"];
            Utilisateur_SetStatus($connexion, $id_utilisateur, 0);

            $liste_utilisateurs_administratifs = Utilisateur_Select($connexion);
            Vue_Gestion_Utilisateurs_Admin_Liste($liste_utilisateurs_administratifs);
        } elseif (isset($_REQUEST["Activer"])) {
            // L'administrateur a choisi d'activer l'utilisateur sélectionné,
            // On a besoin de son ID

            $id_utilisateur = $_REQUEST["idUtilisateurAdmin"];
            Utilisateur_SetStatus($connexion, $id_utilisateur, 1);

            $liste_utilisateurs_administratifs = Utilisateur_Select($connexion);
            Vue_Gestion_Utilisateurs_Admin_Liste($liste_utilisateurs_administratifs);
        } else {
            // Situation par défaut, on affiche la liste des utilisateurs administratifs
            $liste_utilisateurs_administratifs = Utilisateur_Select($connexion);
            Vue_Gestion_Utilisateurs_Admin_Liste($liste_utilisateurs_administratifs);

        }
    } else {
        // On a un autre niveau d'autorisation
        // On affiche juste le menu (avec le niveau d'autorisation)
        $liste_utilisateurs_administratifs = Utilisateur_Select($connexion);
        Vue_Gestion_Utilisateurs_Admin_Liste($liste_utilisateurs_administratifs, false);
    }

} else {
    // My bad
    // On redirige l'utilisateur vers la page de connexion
    Vue_Connexion_Formulaire_connexion_administration();
}

Vue_Structure_BasDePage();
