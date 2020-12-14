<?php
include("autoload.php");

/**
 * Ce contrôleur est dédié à la gestion des utilisateurs administratifs.
 * Toutes les pages de cette user story renvoie sur ce contrôleur.
 * Le tri entre les actions est fait sur l'existence des boutons submit.
 */

// TODO : Refactor this

Vue_Structure_Entete();

if(isset($_SESSION["idUtilisateur"]))
{
    // Si l'utilisateur est connecté
    // -> On affiche la navbar
    Vue_Administration_Menu();

    // Connexion à la BDD
    $connexion = Creer_Connexion();

    // On récupère le niveau de permission de l'utilisateur sur la page.
    $niveau_autorisation = Utilisateur_Select_ParId($connexion, $_SESSION["idUtilisateur"])["niveauAutorisation"];

    if ($niveau_autorisation == 1)
    {
        // Si l'utilisateur est niveau 1
        // -> On accepte les requêtes de modification

        if (isset($_REQUEST["Modifier"]))
        {
            // Cas : Modification des infos d'un utilisateur

            $utilisateur_admin = Utilisateur_Select_ParId($connexion, $_REQUEST["idUtilisateurAdmin"]);

            /*
             * Paramètres de la vue de modification d'utilisateur:
             *  - Mode création (false = modification)
             *  - ID utilisateur
             *  - Nom de l'utilisateur
             *  - Niveau d'autorisation
             */
            Vue_Gestion_Utilisateur_Administratif_Formulaire(   false,
                                                                $utilisateur_admin["idUtilisateur"],
                                                                $utilisateur_admin["login"],
                                                                $utilisateur_admin["niveauAutorisation"]);
        }

        elseif (isset($_REQUEST["mettreAJour"]))
        {
            // Cas : CONFIRMATION de modification d'un uitilisateur

            $new_id_utilisateur = $_REQUEST["id_utilisateur_edit"];
            $new_login          = $_REQUEST["nouveau_login"];
            $new_autorisation   = $_REQUEST["niveauAutorisation"];

            Utilisateur_Modifier(   $connexion,
                                    $new_id_utilisateur,
                                    $new_login,
                                    $new_autorisation);
            
            $liste_utilisateurs_administratifs = Utilisateur_Select($connexion);
            Vue_Gestion_Utilisateurs_Admin_Liste($liste_utilisateurs_administratifs);
        }

        elseif (isset($_REQUEST["Supprimer"])) {
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
