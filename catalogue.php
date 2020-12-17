<?php

include_once("autoload.php");
Vue_Structure_Entete();

if (isset($_SESSION["idEntreprise"]))
{
    $connexion = Creer_Connexion();

    $liste_categories = Categorie_select($connexion);
    Vue_liste_afficher_categories($liste_categories);
}

else
{
    // Si l'utilisateur n'est pas connecté
    // -> on le redirige vers la page de connexion

    Vue_Connexion_Formulaire_connexion_entreprise("Veuillez vous connecter.");
}

Vue_Structure_BasDePage();