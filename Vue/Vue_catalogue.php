<?php

function Vue_Catalogue_menu($liste_categories)
{
    echo "
    <nav style='height: auto;'>
        <ul>
    ";

    foreach ($liste_categories as $categorie)
    {
        echo "
            <li>
                <form style='border: none; background: none; box-shadow: none;'>
                    <input type='hidden' name='idCategorie' value='". $categorie["idCategorie"] ."'>
                    <input style='padding: 6px 0px; margin: 0;' type='submit' name='nomCategorie' value='". $categorie["nomCategorie"] ."'>
                </form>
            </li>
        ";
    }

    // Bonton hardcoded : Afficher toutes les catégories (idCategorie == -1)
    echo "
        <li>
            <form style='border: none; background: none; box-shadow: none;'>
                <input type='hidden' name='idCategorie' value='-1'>
                <input style='padding: 6px 0px; margin: 0;' type='submit' name='nomCategorie' value='Afficher tout'>
            </form>
        </li>  
    ";

    echo "
        </ul>
    </nav>";
}