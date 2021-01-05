<?php

/**
 * Affiche la liste des entreprises
 * @param $listeEntreprise
 */
function Vue_Gestion_Entreprise_Liste($listeEntreprise)
{
    echo '
    <h1 style="color: white;">Liste des entreprises partenaires</h1>
    
    <hr class="styled">
    
    <table style="display: inline-block; border-collapse: collapse;" class="bordered">
         <tr>
            <td colspan="5" style="text-align: center">
                <button type=\'submit\' name=\'nouveau\'>Nouvelle entreprise</button>
            </td>
        </tr>
        
        <tr style="color: white; text-decoration: white underline;">
            <th>Num compte</th>
            <th>Dénomination</th>
            <th>Ville</th>
            <th colspan="2">Actions</th>
        </tr>';

    for ($i = 0; $i < count($listeEntreprise); $i++)
    {
        $iemeEntreprise = $listeEntreprise[$i];

        echo "
           
            
        <tr style='color: white;'>
            <td>$iemeEntreprise[numCompte]</td>
            <td>$iemeEntreprise[denomination]</td>
            <td>$iemeEntreprise[codePostal] - $iemeEntreprise[ville]</td>
            <td>
                <form style='display: contents'>
                        <input type='hidden' value='$iemeEntreprise[idEntreprise]' name='idEntreprise'>
                        <button type='submit' name='Modifer'> Modifier </button>
                </form>
            </td>
            <td>
                <form style='display: contents'>
                        <input type='hidden' value='$iemeEntreprise[idEntreprise]' name='idEntreprise'>
                        <button type='submit' name='Supprimer'> Supprimer </button>
                </form>
            </td>
        </tr>
        
         ";
    }


    echo "
</table>";

}

/**
 * Affiche le formulaire de création/mise à jour d'une entreprise. Les valeurs proposées seront celles données aux values des différents input.
 * @param bool $modeCreation A true si le formulaire est utiliser pour créer une entreprise, False : en mise à jour, tous les attributs doivent être paramétrés
 * @param string $idEntreprise
 * @param string $denomination
 * @param string $rueAdresse
 * @param string $complementAdresse
 * @param string $codePostal
 * @param string $ville
 * @param string $pays
 * @param string $numCompte
 * @param string $mailContact
 * @param string $siret
 */
function Vue_Gestion_Entreprise_Formulaire($modeCreation = true, $idEntreprise = "", $denomination = "", $rueAdresse = "", $complementAdresse = "", $codePostal = "", $ville = "", $pays = "France", $numCompte = "", $mailContact = "", $siret = "")
{
    // vous trouverez des explications sur les paramètres HTML5 des balises INPUT sur ce site :
    // https://darchevillepatrick.info/html/html_form.htm

    echo "<style>
        * {color: white;}
        input {
        color: black;
        }
    </style>";

    if ($modeCreation)
        echo "<H1>Création d'une nouvelle Entreprise</H1>";
    else
        echo "<H1>Edition d'une entreprise</H1>";

    echo "
<table style='display: inline-block'> 
    <form>
        <input type='hidden' name='idEntreprise' value='$idEntreprise'>
        <tr>
            <td>
                <label>Numéro de compte : </label>
            </td>
            <td>
                $numCompte
            </td>
        </tr>
        <tr>
        
            <td>
                <label>Dénomination (en lettres majuscules) : </label>
            </td>
            <td>
    
                <input type='text' required name='denomination'
                       pattern='[A-z\ ]{0,30}' placeholder='lettres et espace' autofocus value='$denomination'>
            </td>
        </tr>
        <tr>
            <td>
                <label>Rue : </label>
            </td>
            <td><input type='text' required
                       placeholder='Rue' name='rueAdresse' value='$rueAdresse'>
            </td>
        </tr>
        <tr>
            <td>
                <label>Rue (complément)  : </label>
            </td>
            <td><input type='text' optional placeholder='Complément' name='complementAdresse' value='$complementAdresse'>
        </tr>
        <tr>
            <td>
                <label>Code postal : </label>
            </td>
            <td><input type='text' required
                         placeholder='Code postal/cedex' maxlength='10' name='codePostal' value='$codePostal'>
            </td>
        </tr>
        <tr>
            <td>
                <label>Ville : </label>
            </td>
            <td>
    
                <input type='text' required
                       pattern='[A-z\ ]{2,30}' placeholder='ville' autofocus name='ville' value='$ville'>
            </td>
        </tr>
        
        <tr>
            <td>
                <label>Pays : </label>
            </td>
            <td>
    
                <input type='text' required
                       pattern='[A-z\ ]{2,30}' placeholder='pays' autofocus value='$pays' name='pays'>
            </td>
        </tr>
        
         
        
        <!--tr>
            <td>
                <label>Téléphone : </label>
            </td>
            <td><input type='tel' required
                       pattern='[0-9]{10}' placeholder='dix chiffres' maxlength='10' value=''>
            </td>
        </tr-->
        <tr>
            <td>
                <label>Couriel : </label>
            </td>
            <td><input type='email' required value='$mailContact' name='mailContact'
                       placeholder='____@___ .___'>
            </td>
        </tr>
        <tr>
            <td>
                <label>Siret (14 chiffres) </label>
            </td>
            <td><input type='text' pattern='[0-9]{14}' name='siret' value='$siret' required>
            </td>
        </tr>
        <tr>";
    if ($modeCreation) {
        echo " 
                
            <td colspan='2' style='text-align: center;'>
                <button style='color: black;' type='submit' name='buttonCreer'>Créer ce client</button>";
    } else {
        echo "<td>
                <button style='color: black;' type='submit' name='réinitialiserMDP'>Réinitialiser le mot de passe</button>
            </td>
            <td>
                <button style='color: black;' type='submit' name='mettreAJour'>Mettre à jour</button>";
    }

    echo "</td>
        </tr>

    </form>
</table>

";
}