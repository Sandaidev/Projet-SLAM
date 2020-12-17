<?php
include_once("autoload.php");
/**
 * Contrôleur gérant la connexion au catalogue
 * En cas de succès, il affiche uniquement le catalogue
 */

if (isset($_REQUEST["compte"]) and isset($_REQUEST["password"])) {//Si tous les paramètres du formulaire sont bons
    $connexion = Creer_Connexion();
    //Vérification du mot de passe
    $entreprise = Entreprise_Select_ParCompte($connexion, $_REQUEST["compte"]);
    if ($entreprise != null) {
        if (password_verify($_REQUEST["password"], $entreprise["motDePasse"])) {//le mot de passe est associable à ce Hash

            //redirection sur la première page du catalogue
            //Construction du lien vers lequel rediriger
            //Dans la vraie vie, se serait plus court, mais comme je ne connais les url sur vos postes, j'ai créé un lien qui
            //devrait marcher tout le temps (ou presque)
            /*if (isset($_SERVER['HTTPS']) &&
                $_SERVER['HTTPS'] === 'on')
                $link = "https";
            else
                $link = "http";

            $link .= "://";

            $link .= $_SERVER['HTTP_HOST'];

            $link .= str_replace("connexion.php", "", $_SERVER['SCRIPT_NAME']);
            $link .= "public/Catalogue/Cafe-Capsule.html";*/

            $_SESSION["idEntreprise"] = $entreprise["idEntreprise"];

            $relative_link = "catalogue.php";

            header("Location: $relative_link"); //Redirection HTTP, ordre 300, (vérifier 7.2)
            exit(); //La page s'arrête là, pour envoyer l'ordre de redirection au navigateur.
        } else {//mot de passe pas bon
            $msgError = "Mot de passe erroné";
            Vue_Structure_Entete();
            Vue_Connexion_Formulaire_connexion_entreprise($msgError);
        }
    } else {
        $msgError = "Entreprise non trouvée";
        Vue_Structure_Entete();
        Vue_Connexion_Formulaire_connexion_entreprise($msgError);
    }
} else {   //Il y a un raté quelque part !
    if (isset($_REQUEST["compte"]) or isset($_REQUEST["password"]))
        $msgError = "Vous devez saisir toutes les informations";
    else
        $msgError = "";
    Vue_Structure_Entete();
    Vue_Connexion_Formulaire_connexion_entreprise($msgError);
}

Vue_Structure_BasDePage();