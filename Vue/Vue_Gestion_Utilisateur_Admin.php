<?php

/*
 * Affiche la liste des utilisateurs administratifs
 * @param $listeUtilisateursAdministratifs
 */
function Vue_Gestion_Utilisateurs_Admin_Liste($listeUtilisateursAdministratifs) {
    echo '
    <h1>Liste des utilisateurs administratifs</h1>
    
    <table style="display: inline-block" border>
        <tr>
            <td colspan="4" style="text-align: center">
                <form style="display: contents">
                    <button type="submit" onmouseover="this.style.background=\'FFFF99\';this.style.color=\'#FF0000\';"
                    onmouseout="this.style.background=\'\'; this.style.color=\'\';" name="nouveau">Nouvel utilisateur administratif ?</button>
                </form>
            </td>
        </tr>
        
        <tr>
            <th>Num compte</th>
            <th>Niveau d\'autorisation</th>
            <th colspan="2">Actions</th>
        </tr>';

        for ($i = 0; $i < count($listeUtilisateursAdministratifs); $i++) {
            /*
             * Itération sur tous les utilisateurs administratifs stockés dans la BDD
             */

            $iemeUtilisateurAdministratif = $listeUtilisateursAdministratifs[$i];

            echo "
            <tr>
                <td>$iemeUtilisateurAdministratif[login]</td>
                <td>$iemeUtilisateurAdministratif[niveauAutorisation]</td>
            
            <td>
                <form style='display: contents'>
                        <input type='hidden' value='$iemeUtilisateurAdministratif[idUtilisateur]' name='idUtilisateurAdmin'>
                        <button type='submit' onmouseover=\"this.style.background='#FFFF99';this.style.color='#FF0000';\"
                     onmouseout=\"this.style.background='';this.style.color='';\" name='Modifer'>Modifier</button>
                </form>
            </td>
            <td>
                <form style='display: contents'>
                        <input type='hidden' value='$iemeUtilisateurAdministratif[idUtilisateur]' name='idUtilisateurAdmin'>
                        <button type='submit' onmouseover=\"this.style.background='#FFFF99';this.style.color='#FF0000';\"
                     onmouseout=\"this.style.background='';this.style.color='';\" name='Supprimer'> Supprimer </button>
                </form>
            </td>
            </tr>
            ";

        }

    echo "</table>";
}

/*
 *
 */