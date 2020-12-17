<?php

/*
 * Affiche une liste avec les catégories
 */
function Vue_liste_afficher_categories($liste_categories)
{
    echo "<ul>";

    foreach ($liste_categories as $categorie)
    {
        echo "
        <li>
            <form>
                <input type='hidden' name='idCategorie' value='". $categorie["idCategorie"] ."'>
                <input type='submit' name='nomCategorie' value='". $categorie["nomCategorie"] ."'>
            </form>
        </li>
        ";
    }

    // Bonton hardcoded : Afficher toutes les catégories (idCategorie == -1)
    echo "
    <li>
        <form>
            <input type='hidden' name='idCategorie' value='-1'>
            <input type='submit' name='nomCategorie' value='Afficher tout'>
        </form>
    </li>  
    ";

    echo "</ul>";
}