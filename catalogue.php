<?php

include_once("autoload.php");
Vue_Structure_Entete();

if (isset($_SESSION["idEntreprise"]))
{
    $connexion = Creer_Connexion();

    // Affichage de la navbar + catégories dynamiques
    $liste_categories = Categorie_select($connexion);
    Vue_Catalogue_menu($liste_categories);

    if (!isset($_REQUEST["idCategorie"]) or $_REQUEST["idCategorie"] == -1)
    {
        // Cas : Aucune catégorie n'est sélectionnée
        //       ou la catégorie "Afficher tout" est sélectionnée

		$liste_produits = produit_select($connexion);
		Vue_afficher_liste_produits($liste_produits);


    }
}

else
{
    // Si l'utilisateur n'est pas connecté
    // -> on le redirige vers la page de connexion

    Vue_Connexion_Formulaire_connexion_entreprise("Veuillez vous connecter.");
}

Vue_Structure_BasDePage();