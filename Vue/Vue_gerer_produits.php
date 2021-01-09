<?php

function Vue_afficher_liste_gestion_produits($liste_produits, $liste_categories)
{
    echo "<h1 style='color: white;'>Gestion des produits</h1>";
    echo "<hr class='styled'>";

    echo "
    <table style='display: inline-block;'>
        <tr>
            <td colspan='5' style='text-align: center;'>
                <form style='display: contents'>
                    <button type='submit' name='creer_produit' style='width: 60%;'>+ Créer un produit</button>
                </form>
                <hr class='styled' style='width: 80%'>
            </td>
        </tr>
    
    <form>
        <tr>
            <td colspan='5'>
                <button type='submit' name='supprimer_liste_produits'>Supprimer les produits sélectionnés</button>
                <button type='submit' name='desactiver_liste_produits'>Désactiver les produits sélectionnés</button>
                <button type='submit' name='activer_liste_produits'>Activer les produits sélectionnés</button>
            </td>
        </tr>
        <tr style='color: white; text-decoration: white underline;'>
            <th>ID Produit</th>
            <th>Catégorie</th>
            <th>Libellé</th>
            <th>Prix HT</th>
            <th>Taux TVA</th>
        </tr>
        ";


    foreach ($liste_produits as $produit)
    {
        echo "
        <tr>
            <td>
                <input type='checkbox' name='liste_produit' value='$produit[idProduit]'>
            </td>
        ";
    }



    echo "
    </form>
    </table>";
}