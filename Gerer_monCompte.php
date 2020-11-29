<?php
include("autoload.php");


if(isset($_SESSION["idUtilisateur"])) {
    //Si l'utilisateur est connecté

    if(isset($_REQUEST["changerMDP"]))
    {
        //Il a cliqué sur changer Mot de passe. Cas pas fini
        Vue_Structure_Entete();
        Vue_Administration_Menu();
    }
    elseif(isset($_REQUEST["SeDeconnecter"]))
    {
        //L'utilisateur a cliqué sur "se déconnecter"
        session_destroy( );
        unset($_SESSION["idUtilisateur"]);
        Vue_Structure_Entete();
        Vue_Connexion_Formulaire_connexion_administration();
    }
    else {
        //Cas par défaut: affichage du menu des actions.
        Vue_Structure_Entete();
        Vue_Administration_Menu();
        Vue_Administration_Gerer_Compte();
    }
}
else
{
    //On renvoie l'utilisateur à la page de connexion. Il n'aurait jamais du arriver ici !
    Vue_Structure_Entete();
    Vue_Connexion_Formulaire_connexion_administration();
}
Vue_Structure_BasDePage();