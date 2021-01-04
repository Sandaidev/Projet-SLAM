<?php
include("autoload.php");


if (isset($_SESSION["idUtilisateur"])) {
    // Si l'utilisateur est connecté

    $connexion = Creer_Connexion();

    if(isset($_REQUEST["changerMDP"]))
    {
        // Il a cliqué sur changer Mot de passe.
        Vue_Structure_Entete();
        Vue_Administration_Menu();
        Vue_ModifierMDP_SuperAdmin();
    }

    elseif(isset($_REQUEST["SeDeconnecter"]))
    {
        // L'utilisateur a cliqué sur "se déconnecter"
        session_destroy();
        unset($_SESSION["idUtilisateur"]);
        Vue_Structure_Entete();
        Vue_Connexion_Formulaire_connexion_administration();
    }

    elseif (isset($_REQUEST["changerMDP_confirmation"]))
    {
        // L'utilisateur a confirmé le changement de son mot de passe

        Vue_Structure_Entete();
        Vue_Administration_Menu();

        // Récupération des informations de l'utilisateur actuel avant modification
        $utilisateur_selectionne = Utilisateur_Select_ParId($connexion, $_SESSION["idUtilisateur"]);

        // Vérifications : L'ancien mot de passe doit être correct et les nouveaux doivent êtres corrects
        if (password_verify($_REQUEST["old_pass"], $utilisateur_selectionne["motDePasse"])
            and $_REQUEST["new_pass"] == $_REQUEST["new_pass_confirm"])
        {
            // Le mot de passe est OK, on le modifie dans la BDD!
            Utilisateur_Modifier_motDePasse($connexion, $_SESSION["idUtilisateur"], $_REQUEST["new_pass"]);
            echo "<p style='margin: auto; color: white; font-size: 30px;'>Votre mot de passe a été modifié!</p>";
        }

        else
        {
            // L'utilisateur a rentré un mauvais mot de passe (ancien ou nouveau)
            // On affiche un message d'erreur
            Vue_ModifierMDP_SuperAdmin("L'ancien mot de passe est invalide ou les nouveaux mot de passe ne coïncident pas.");
        }
    }

    else
    {
        // Cas par défaut: affichage du menu des actions.
        Vue_Structure_Entete();
        Vue_Administration_Menu();

        // On lui donne le paramètre idUtilisateur de session pour préciser
        // sur quel compte nous commes actuellement connecté
        $nom_utilisateur = Utilisateur_Select_ParId($connexion, $_SESSION["idUtilisateur"])["login"];
        Vue_Administration_Gerer_Compte($nom_utilisateur);
    }
}

else
{
    // On renvoie l'utilisateur à la page de connexion. Il n'aurait jamais du arriver ici !
    Vue_Structure_Entete();
    Vue_Connexion_Formulaire_connexion_administration();
}

Vue_Structure_BasDePage();