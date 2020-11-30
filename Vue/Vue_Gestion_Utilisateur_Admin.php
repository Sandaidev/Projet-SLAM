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
                     onmouseout=\"this.style.background='';this.style.color='';\" name='Modifier'>Modifier</button>
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

function Vue_Gestion_Utilisateur_Administratif_Formulaire($modeCreation = true, $idUtilisateur = "", $login = "", $niveauAutorisation = "")
{
    // vous trouverez des explications sur les paramètres HTML5 des balises INPUT sur ce site :
    // https://darchevillepatrick.info/html/html_form.htm
    if ($modeCreation)
        echo "<H1>Création d'un nouvel utilisateur administratif</H1>";
    else
        echo "<H1>Edition d'un utilisateur administratif</H1>";

    echo "
<table style='display: inline-block'> 
    <form>
        <input type='hidden' name='idUtilisateur' value='$idUtilisateur'>
        <tr>
            <td>
                <label>Numéro de compte : </label>
            </td>
            <td>
                <input type='text' name='login' value='$login'> 
            </td>
        </tr>
        
        <tr>
            <td>
                <label>Niveau d'autorisation : </label>
            </td>
            <td>
                <select name='niveauAutorisation' required>
                    ";

                switch ($niveauAutorisation) {
                    case "1":
                        echo "
                        <option value='1' selected>Niveau 1 - Administrateur</option>
                        <option value='2'>Niveau 2 - Commercial</option>
                        <option value='3'>Niveau 3 - Employé</option>";
                        break;
                    case "2":
                        echo "
                        <option value='1'>Niveau 1 - Administrateur</option>
                        <option value='2' selected>Niveau 2 - Commercial</option>
                        <option value='3'>Niveau 3 - Employé</option>";
                        break;
                    case "3":
                        echo "
                        <option value='1'>Niveau 1 - Administrateur</option>
                        <option value='2'>Niveau 2 - Commercial</option>
                        <option value='3' selected>Niveau 3 - Employé</option>";
                        break;
                }

    echo "     </select>
            </td>
        </tr>
        
      
        <tr>";
    if ($modeCreation) {
        echo "
            
            <td>
                <input type='password' name='password' placeholder='Mot de passe'>
            </td>

            <td colspan='2' style='text-align: center'>
                <button type='submit' name='buttonCreer'>Créer cet utilisateur</button>";


    } else {
        echo "<td>
                <button type='submit' name='réinitialiserMDP'>Réinitialiser le mot de passe</button>
            </td>
            <td>
                <button type='submit' name='mettreAJour'>Mettre à jour</button>";
    }

    echo "</td>
        </tr>

    </form>
</table>

";
}