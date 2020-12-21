<?php

include_once("autoload.php");
Vue_Structure_Entete();

if (isset($_SESSION["idEntreprise"]))
{
    $connexion = Creer_Connexion();

    // Affichage de la navbar + catégories dynamiques
    $liste_categories = Categorie_select($connexion);
    Vue_Catalogue_menu($liste_categories);

    if (isset($_REQUEST["idProduit"]))
	{
		// Cas : L'utilisateur a choisi de consulter un produit spécifique
		$produit = produit_selectParID($connexion, $_REQUEST["idProduit"]);
		Vue_afficher_produit_detail($produit);
	}

    elseif (!isset($_REQUEST["idCategorie"]) or $_REQUEST["idCategorie"] == -1)
    {
        // Cas : Aucune catégorie n'est sélectionnée
        //       ou la catégorie "Afficher tout" est sélectionnée

		$_REQUEST["idCategorie"] = "-1";
		$liste_produits = produit_select($connexion);
		Vue_afficher_liste_produits($liste_produits);
    }

    else
	{
		// Cas : une catégorie est sélectionnée
		$liste_produits = produit_selectParCategorie($connexion, $_REQUEST["idCategorie"]);
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