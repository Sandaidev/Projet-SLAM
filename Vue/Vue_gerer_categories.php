<?php

function Vue_afficher_liste_gestion_categories($liste_categories)
{
    /*
    print_debug($liste_produits);
    print_debug($liste_categories);
    print_debug($liste_tva);
    print_debug($_REQUEST);
    print_debug($_SESSION);
    */

    echo "<h1 style='color: white;'>Gestion des catégories</h1>";
    echo "<hr class='styled'>";

    echo "
    <table style='display: inline-block;'>
        <tr>
            <td colspan='7' style='text-align: center;'>
                <form style='display: contents'>
                    <button type='submit' name='creer_categorie' style='width: 40%;'>Créer une catégorie</button>
                </form>
                <hr class='styled' style='width: 60%'>
            </td>
        </tr>
    <tr>
        <td style='color: white; text-align: center; font-family: ralewaylight;' colspan='3'>
            <i><i class='fas fa-exclamation-circle'></i> <u>Attention</u> : Supprimer une catégorie va également supprimer les produits qui y sont liés!</i>
        </td>
    </tr>
    <form>
        <tr>
            <td colspan='7'>
                <button type='submit' name='supprimer_liste_categories'>Supprimer les catégories sélectionnés</button>
                <button type='submit' name='desactiver_liste_categories'>Désactiver les catégories sélectionnés</button>
                <button type='submit' name='activer_liste_categories'>Activer les catégories sélectionnés</button>
                <button type='submit' name='modifier_categorie'>Modifier la catégorie sélectionnée</button>
            </td>
        </tr>
        <tr style='color: white; text-decoration: white underline;'>
            <th style='width: 256px;'>ID catégorie</th>
            <th>Nom catégorie</th>
            <th style='width: 256px;'>Status</th>
        </tr>
        ";


    foreach ($liste_categories as $categorie)
    {

        if ($categorie["statusCategorie"] == 1)
        {
            $nom_status = "Activé";
        }

        else
        {
            $nom_status = "Désactivé";
        }

        echo "
        <tr style='color: white; font-family: ralewaymedium; text-align: center;'>
            <td>
                <input type='checkbox' name='liste_categories[]' value='$categorie[idCategorie]'>
                    $categorie[idCategorie]
                </input>
            </td>
            
            <td>
            $categorie[nomCategorie]
            </td>
            
            <td>
            $nom_status
            </td>
            
            </tr>
        ";
    }



    echo "
    </form>
    </table>";
}