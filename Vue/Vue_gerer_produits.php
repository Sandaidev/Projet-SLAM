<?php

function Vue_afficher_liste_gestion_produits($liste_produits, $liste_categories, $liste_tva)
{
    /*
    print_debug($liste_produits);
    print_debug($liste_categories);
    print_debug($liste_tva);
    print_debug($_REQUEST);
    print_debug($_SESSION);
    */

    echo "<h1 style='color: white;'>Gestion des produits</h1>";
    echo "<hr class='styled'>";

    echo "
    <table style='display: inline-block;'>
        <tr>
            <td colspan='7' style='text-align: center;'>
                <form style='display: contents'>
                    <button type='submit' name='creer_produit' style='width: 60%;'>Créer un produit</button>
                </form>
                <hr class='styled' style='width: 80%'>
            </td>
        </tr>
    
    <form>
        <tr>
            <td colspan='7'>
                <button type='submit' name='supprimer_liste_produits'>Supprimer les produits sélectionnés</button>
                <button type='submit' name='desactiver_liste_produits'>Désactiver les produits sélectionnés</button>
                <button type='submit' name='activer_liste_produits'>Activer les produits sélectionnés</button>
            </td>
        </tr>
        <tr style='color: white; text-decoration: white underline;'>
            <th>ID Produit</th>
            <th>Code</th>
            <th>Catégorie</th>
            <th>Nom du produit</th>
            <th>Prix HT</th>
            <th>Taux TVA</th>
            <th>Status</th>
        </tr>
        ";


    foreach ($liste_produits as $produit)
    {
        $categorie_key = array_search($produit["idCategorie"], array_column($liste_categories, "idCategorie"));
        $nom_categorie = $liste_categories[$categorie_key]["nomCategorie"];

        $tva_key = array_search($produit["idTVA"], array_column($liste_tva, "idTVA"));
        $nom_tva = $liste_tva[$tva_key]["nomTVA"];

        if ($produit["statusProduit"] == 1)
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
                <input type='checkbox' name='liste_produit[]' value='$produit[idProduit]'>
                    $produit[idProduit]
                </input>
            </td>
            
            <td>
            $produit[codeReference]
            </td>
            
            <td>
            $nom_categorie
            </td>
            
            <td>
            $produit[nomProduit]
            </td>
            
            <td>
            $produit[prixHT] €
            </td>
            
            <td>
            $nom_tva
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