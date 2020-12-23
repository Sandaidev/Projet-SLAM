<?php
include("autoload.php");

/**
 * Ce contrôleur est dédié à la gestion des produis et catégories
 */

// TODO Gérer l'affichage des produits!!

Vue_Structure_Entete();

if(isset($_SESSION["idUtilisateur"]))
{
	// Cas : L'utilisateur est connecté
	// -> On affiche la navbar
	Vue_Administration_Menu();

	// Connexion à la BDD
	$connexion = Creer_Connexion();

	// Affichage des catégories dans la navbar + bouton "créer catégorie"
	$liste_categories = Categorie_select($connexion);
	Vue_Catalogue_menu($liste_categories, true);

	if (isset($_REQUEST["modifier_produit"]))
	{
		// Cas : Modification d'un produit
		// FIXME
	}

	elseif (isset($_REQUEST["confirmation_modifier_produit"]))
	{
		// Cas : CONFIRMATION de modification d'un produit
		// FIXME
	}

	elseif (isset($_REQUEST["supprimer_produit"]))
	{
		// Cas : Suppression d'un produit
		// FIXME
	}

	elseif (isset($_REQUEST["creer_produit"]))
	{
		// Cas : Création d'un produit (affichage du formulaire)
		// FIXME
	}

	elseif (isset($_REQUEST["confirmation_creer_produit"]))
	{
		// Cas : CONFIRMATION de création d'un produit
		// FIXME
	}

	elseif (isset($_REQUEST["ajouter_categorie"]))
	{
		// Cas : Création d'un catégorie (affichage du formulaire)
		// FIXME
	}
}

else
{
	// Cas : Infos de connexion invalides
	Vue_Connexion_Formulaire_connexion_administration();
}

Vue_Structure_BasDePage();
