<?php
include("autoload.php");

/**
 * Ce contrôleur est dédié à la gestion des utilisateurs administratifs.
 * Toutes les pages de cette user story renvoie sur ce contrôleur.
 * Le tri entre les actions est fait sur l'existence des boutons submit.
 */

Vue_Structure_Entete();

if(isset($_SESSION["idUtilisateur"]))
{
    // Cas : L'utilisateur est connecté
    // -> On affiche la navbar
    Vue_Administration_Menu();

    // Connexion à la BDD
    $connexion = Creer_Connexion();

    // On récupère le niveau de permission de l'utilisateur sur la page
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
        }

        elseif (isset($_REQUEST["Supprimer"]))
        {
            // Cas : Suppression d'un utilisateur
            Utilisateur_Supprimer($connexion, $_REQUEST["idUtilisateurAdmin"]);
        }

        elseif (isset($_REQUEST["Nouveau"]))
        {
            // Cas : Création d'un nouvel utilisateur (étape 1/2)
            Vue_Gestion_Utilisateur_Administratif_Formulaire(true);
        }

        elseif (isset($_REQUEST["buttonCreer"]))
        {
            // Cas : CONFIRMATION de création d'un nouvel utilisateur (étape 2/2)
            $new_username = $_REQUEST["nouveau_login"];
            $new_authorization = $_REQUEST["niveauAutorisation"];

            $id_new_user = Utilisateur_Creer($connexion, $new_username, $new_authorization);
            Utilisateur_Modifier_motDePasse($connexion, $id_new_user, "secret");
        }

        elseif (isset($_REQUEST["Desactiver"]))
        {
            // Cas : Désactivation d'un utilisateur
            $id_utilisateur = $_REQUEST["idUtilisateurAdmin"];
            Utilisateur_SetStatus($connexion, $id_utilisateur, 0);
        }

        elseif (isset($_REQUEST["Activer"]))
        {
            // Cas : Activation d'un utilisateur
            $id_utilisateur = $_REQUEST["idUtilisateurAdmin"];
            Utilisateur_SetStatus($connexion, $id_utilisateur, 1);
        }

        $liste_utilisateurs_administratifs = Utilisateur_Select($connexion);
        Vue_Gestion_Utilisateurs_Admin_Liste($liste_utilisateurs_administratifs);
    }

    else
    {
        // On a un autre niveau d'autorisation
        // On affiche juste le menu (avec le niveau d'autorisation)
        $liste_utilisateurs_administratifs = Utilisateur_Select($connexion);
        Vue_Gestion_Utilisateurs_Admin_Liste($liste_utilisateurs_administratifs, false);
    }
}

else
{
    // Cas : Infos de connexion invalides
    Vue_Connexion_Formulaire_connexion_administration();
}

Vue_Structure_BasDePage();
