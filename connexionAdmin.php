<?php
include_once("autoload.php");

/**
 * Contrôleur gérant la connexion à la page administration.
 * En cas de succès, il affiche uniquement le menu d'administration.
 * -----------------------------------------------------------------
 * La connexion se fait UNIQUEMENT si l'utilisateur est activé dans la BDD
 */


if (    isset($_REQUEST["login"])
     && isset($_REQUEST["password"])
) {
    // Si tous les paramètres du formulaire sont OK
    // Alors on vérifie le mot de passe

    $connexion = Creer_Connexion();
    $utilisateur = Utilisateur_Select_ParLogin($connexion, $_REQUEST["login"]);

    if ($utilisateur != null)
    {
        if (password_verify($_REQUEST["password"], $utilisateur["motDePasse"]))
        {
            // Cas : Mot de passe OK
            Vue_Structure_Entete();

            if ($utilisateur["statusUtilisateur"] == "1")
            {
                $_SESSION["idUtilisateur"] = $utilisateur["idUtilisateur"];
                Vue_Administration_Menu();
            }

            else
            {
                $msgError = "Votre compte a été désactivé par un administrateur.";
            }
        }

        else
        {
            // Cas : Mot de passe erroné
            $msgError = "Mot de passe erroné";
            Vue_Structure_Entete();
            Vue_Connexion_Formulaire_connexion_administration($msgError);
        }
    }

    else
    {
        $msgError = "Login non trouvé";
        Vue_Structure_Entete();
        Vue_Connexion_Formulaire_connexion_administration($msgError);
    }
}

else
{
    // Cas : Login/mot de passe pas définis
    if ($_REQUEST["login"] == "")
    {
        $msgError = "";
    }

    else
    {
        $msgError = "Vous devez saisir toutes les informations";
    }

    Vue_Structure_Entete();
    Vue_Connexion_Formulaire_connexion_administration($msgError);
}

Vue_Structure_BasDePage();