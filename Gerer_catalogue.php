<?php
include("autoload.php");

/**
 * Ce contrôleur est dédié à la gestion des produis et catégories
 */

Vue_Structure_Entete();

if(isset($_SESSION["idUtilisateur"])) {
    // Cas : L'utilisateur est connecté
    // -> On affiche la navbar
    Vue_Administration_Menu();

    // Connexion à la BDD
    $connexion = Creer_Connexion();

    // Affichage des catégories dans la navbar + bouton "créer catégorie"
    $liste_categories = Categorie_select($connexion);
    Vue_Catalogue_menu($liste_categories, true);
    print_debug($_FILES);
    // Si on a un upload d'image
    if (isset($_FILES['fichier']))
    {

        print_r("Dans isset fichier");
        $errors = array();
        $file_name = $_FILES['fichier']['name'];
        $file_size = $_FILES['fichier']['size'];
        $file_tmp = $_FILES['fichier']['tmp_name'];
        $file_type = $_FILES['fichier']['type'];
        $tab = explode('.', $_FILES['fichier']['name']);
        $file_ext = strtolower(end($tab));
        $expensions = array("jpeg", "jpg", "png", "mp3",
            "acc", "wav", "3gpp", "mp4", "3gp", "m4a", "amr", "avi",
            "flv", "gif"); //Peut être des extensions en trop...

        if (in_array($file_ext, $expensions) === false)
        {
            $errors[] = "extension not allowed, please choose a JPEG or PNG file.";
        }

        if ($file_size > 2097152666655)
        {
            $errors[] = 'File size must be less than 2 MB';
        }

        if (empty($errors) == true)
        {
            move_uploaded_file($file_tmp, '.\\' . $file_name);
            produit_modifier_url_image($connexion, $_REQUEST["idProduit"], $file_tmp);

            $infos_produit = produit_selectParID($connexion, $_REQUEST["idProduit"]);
            $liste_categories = Categorie_select($connexion);
            $liste_tva = TVA_select($connexion);
            Vue_formulaire_modification_produit($liste_categories, $infos_produit, false, $liste_tva);
        }

        else
        {
            //Erreur quand il y a l'upload
            print_debug($errors);
        }
    }

    if (isset($_REQUEST["confirmation_modifier_produit"]))
    {
        // Cas : CONFIRMATION de modification d'un produit

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

    elseif (isset($_REQUEST["confirmation_modifier_categorie"]))
    {
        Categorie_Modifier(
            $connexion,
            $_REQUEST["id_categorie"],
            $_REQUEST["nom_categorie"],
            $_REQUEST["status_categorie"]);

        $liste_categories = Categorie_select($connexion);
        Vue_afficher_liste_gestion_categories($liste_categories);
    }

    elseif (isset($_REQUEST["activer_liste_produits"]))
    {
        if (isset($_REQUEST["liste_produit"]))
        {
            $liste_produits = $_REQUEST["liste_produit"];

            foreach ($liste_produits as $id_produit)
            {
                produit_activer($connexion, $id_produit);
            }
        }

        $liste_produits = produit_select($connexion);
        $liste_categories = Categorie_select($connexion);
        $liste_tva = TVA_select($connexion);
        Vue_afficher_liste_gestion_produits($liste_produits, $liste_categories, $liste_tva);

    }

    elseif (isset($_REQUEST["desactiver_liste_produits"])) {
        if (isset($_REQUEST["liste_produit"]))
        {
            $liste_produits = $_REQUEST["liste_produit"];

            foreach ($liste_produits as $id_produit)
            {
                produit_desactiver($connexion, $id_produit);
            }
        }

        $liste_produits = produit_select($connexion);
        $liste_categories = Categorie_select($connexion);
        $liste_tva = TVA_select($connexion);
        Vue_afficher_liste_gestion_produits($liste_produits, $liste_categories, $liste_tva);
    }

    elseif (isset($_REQUEST["supprimer_liste_produits"]))
    {
        if (isset($_REQUEST["liste_produit"]))
        {
            $liste_produits = $_REQUEST["liste_produit"];

            foreach ($liste_produits as $id_produit)
            {
                produit_supprimer($connexion, $id_produit);
            }
        }

        $liste_produits = produit_select($connexion);
        $liste_categories = Categorie_select($connexion);
        $liste_tva = TVA_select($connexion);
        Vue_afficher_liste_gestion_produits($liste_produits, $liste_categories, $liste_tva);
    }

    elseif (isset($_REQUEST["supprimer_liste_categories"]))
    {
        if (isset($_REQUEST["liste_categories"]))
        {
            $liste_categories = $_REQUEST["liste_categories"];

            foreach ($liste_categories as $id_categorie)
            {
                // On doit supprimer également les articles dans cette catégorie.
                $liste_produits_a_supprimer = produit_selectParCategorie($connexion, $id_categorie);
                foreach ($liste_produits_a_supprimer as $produit_a_supprimer)
                {
                    produit_supprimer($connexion, $produit_a_supprimer["idProduit"]);
                }

                Categorie_Supprimer($connexion, $id_categorie);
            }
        }

        $liste_categories = Categorie_select($connexion);
        Vue_afficher_liste_gestion_categories($liste_categories);
    }

    elseif (isset($_REQUEST["desactiver_liste_categories"]))
    {
        if (isset($_REQUEST["liste_categories"]))
        {
            $liste_categories = $_REQUEST["liste_categories"];

            foreach ($liste_categories as $id_categorie)
            {
                categorie_desactiver($connexion, $id_categorie);
            }
        }

        $liste_categories = Categorie_select($connexion);
        Vue_afficher_liste_gestion_categories($liste_categories);
    }

    elseif (isset($_REQUEST["activer_liste_categories"]))
    {
        if (isset($_REQUEST["liste_categories"]))
        {
            $liste_categories = $_REQUEST["liste_categories"];

            foreach ($liste_categories as $id_categorie)
            {
                categorie_activer($connexion, $id_categorie);
            }
        }

        $liste_categories = Categorie_select($connexion);
        Vue_afficher_liste_gestion_categories($liste_categories);
    }

    elseif (isset($_REQUEST["creer_produit"]))
    {
        // Cas : Création d'un produit (affichage du formulaire)
        $liste_categories = Categorie_select($connexion);
        $liste_tva = TVA_select($connexion);
        Vue_formulaire_modification_produit($liste_categories, null, true, $liste_tva);
    }

    elseif (isset($_REQUEST["confirmation_creer_produit"]))
    {
        // Cas : CONFIRMATION de création d'un produit
        produit_creer(
            $connexion,
            $_REQUEST["id_categorie"],
            $_REQUEST["nom_produit"],
            $_REQUEST["description"],
            $_REQUEST["prix_ht"],
            $_REQUEST["resume"],
            $_REQUEST["status_produit"],
            $_REQUEST["idTVA"]
        );

        $liste_produits = produit_select($connexion);
        $liste_categories = Categorie_select($connexion);
        $liste_tva = TVA_select($connexion);
        Vue_afficher_liste_gestion_produits($liste_produits, $liste_categories, $liste_tva);

    }

    elseif (isset($_REQUEST["creer_categorie"]))
    {
        // Cas : Création d'un catégorie (affichage du formulaire)
        Vue_formulaire_modification_categorie(true);
    }

    elseif (isset($_REQUEST["confirmation_creer_categorie"]))
    {
        // Cas : Création d'un catégorie (affichage du formulaire)
        Categorie_Creer($connexion, $_REQUEST["nom_categorie"], $_REQUEST["status_categorie"]);
        $liste_categories = Categorie_select($connexion);
        Vue_afficher_liste_gestion_categories($liste_categories);
    }

    elseif (isset($_REQUEST["gerer_produits"]))
    {
        // Cas : On affiche la page de gestion des produits (format liste)
        $liste_produits = produit_select($connexion);
        $liste_categories = Categorie_select($connexion);
        $liste_tva = TVA_select($connexion);
        Vue_afficher_liste_gestion_produits($liste_produits, $liste_categories, $liste_tva);
    }

    elseif (isset($_REQUEST["gerer_categories"]))
    {
        $liste_categories = Categorie_select($connexion);
        Vue_afficher_liste_gestion_categories($liste_categories);
    }

    elseif (isset($_REQUEST["modifier_categorie"]))
    {
        $categorie = categorie_selectParID($connexion, $_REQUEST["liste_categories"][0]);
        Vue_formulaire_modification_categorie(
            false,
            $categorie["idCategorie"],
            $categorie["nomCategorie"],
            $categorie["statusCategorie"]);
    }

    elseif (isset($_REQUEST["idProduit"]))
    {
        // Cas : Un produit a été sélectionné.
        $infos_produit = produit_selectParID($connexion, $_REQUEST["idProduit"]);
        $liste_categories = Categorie_select($connexion);
        $liste_tva = TVA_select($connexion);
        Vue_formulaire_modification_produit($liste_categories, $infos_produit, false, $liste_tva);
    }

    elseif (!isset($_REQUEST["idCategorie"]) or $_REQUEST["idCategorie"] == -1)
    {
        // Cas : L'admin a choisi d'afficher toutes les catégories
        //		 OU c'est sa première visite sur le site

        $_REQUEST["idCategorie"] = -1;
        $liste_produits = produit_select($connexion);
        Vue_afficher_liste_produits($liste_produits);
    }

    else
    {
        // Cas : Une catégorie a été sélectionnée
        $liste_produits_par_categorie = produit_selectParCategorie($connexion, $_REQUEST["idCategorie"]);
        Vue_afficher_liste_produits($liste_produits_par_categorie);
    }
}

else
{
	// Cas : Infos de connexion invalides
	Vue_Connexion_Formulaire_connexion_administration();
}

Vue_Structure_BasDePage();
