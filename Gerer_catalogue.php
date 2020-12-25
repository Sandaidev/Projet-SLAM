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

	if (isset($_REQUEST["confirmation_modifier_produit"]))
	{
		// Cas : CONFIRMATION de modification d'un produit

		print_debug($_REQUEST);

		produit_modifier(
			$connexion,
			$_REQUEST["id_produit"],
			$_REQUEST["id_categorie"],
			$_REQUEST["nom_produit"],
			$_REQUEST["description"],
			$_REQUEST["prix_ht"],
			$_REQUEST["resume"]);

		$liste_produits = produit_select($connexion);
		Vue_afficher_liste_produits($liste_produits);
	}

	elseif (isset($_REQUEST["supprimer_produit"]))
	{
		// Cas : Suppression d'un produit
		// TODO
	}

	elseif (isset($_REQUEST["creer_produit"]))
	{
		// Cas : Création d'un produit (affichage du formulaire)
		// TODO
	}

	elseif (isset($_REQUEST["confirmation_creer_produit"]))
	{
		// Cas : CONFIRMATION de création d'un produit
		// TODO
	}

	elseif (isset($_REQUEST["ajouter_categorie"]))
	{
		// Cas : Création d'un catégorie (affichage du formulaire)
		// TODO
	}

	elseif (isset($_REQUEST["idProduit"]))
	{
		// Cas : Un produit a été sélectionné,
		// 		 NB : ça risque de pas fonctionner correctement; Caveat Emptor.

		$infos_produit = produit_selectParID($connexion, $_REQUEST["idProduit"]);
		$liste_categories = Categorie_select($connexion);
		Vue_formulaire_modification_produit($liste_categories, $infos_produit);
	}

	elseif (!isset($_REQUEST["idCategorie"]) or $_REQUEST["idCategorie"] == -1)
	{
		// Cas : L'admin a choisi d'afficher toutes les catégories
		//		 OU c'est sa première visite sur le site

		$_REQUEST["idCategorie"] = -1;
		$liste_produits = produit_select($connexion);
		Vue_afficher_liste_produits($liste_produits);
	}


}

else
{
	// Cas : Infos de connexion invalides
	Vue_Connexion_Formulaire_connexion_administration();
}

Vue_Structure_BasDePage();
