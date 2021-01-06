<?php

/*
 * Affiche la liste des utilisateurs administratifs
 * @param $listeUtilisateursAdministratifs
 */
function Vue_Gestion_Utilisateurs_Admin_Liste($listeUtilisateursAdministratifs, $autoriserEdit=true) {
    echo '
    <h1 style="color: white;">Liste des utilisateurs administratifs</h1>
    
    <hr class="styled">
    
    <table style="display: inline-block;">';

    if ($autoriserEdit)
    {
        echo '<tr>
            <td colspan="6" style="text-align: center">
                <form style="display: contents">
                    <button style="width: 60%;" type="submit" name="Nouveau"><b>Nouvel utilisateur administratif</b></button>
                    <hr class="styled" style="width:80%">
                </form>
            </td>
        </tr>';
    }

    echo '  
            <tr style="text-decoration: white underline;">
            <th style="color: white;">Num compte</th>
            <th style="color: white;">Niveau d\'autorisation</th>';

    if ($autoriserEdit == true) {
        echo '<th colspan="3" style="color: white;">Actions</th>';
    }

    echo "</tr>";

    for ($i = 0; $i < count($listeUtilisateursAdministratifs); $i++) {
            /*
             * Itération sur tous les utilisateurs administratifs stockés dans la BDD
             */

            $iemeUtilisateurAdministratif = $listeUtilisateursAdministratifs[$i];

            if ($iemeUtilisateurAdministratif["login"] == "root")
            {
                $disabled_tag = "disabled";
            }

            else
            {
                $disabled_tag = "";
            }

            echo "
                <tr style='color: white;'>
                    <td>$iemeUtilisateurAdministratif[login]</td>
                    <td>$iemeUtilisateurAdministratif[niveauAutorisation]</td>
                ";

                if ($autoriserEdit == true) {

                    echo "
                <td>
                    <form style='display: contents'>
                            <input type='hidden' value='$iemeUtilisateurAdministratif[idUtilisateur]' name='idUtilisateurAdmin'>
                            <button type='submit' name='Modifier' $disabled_tag>Modifier</button>
                    </form>
                </td>
                <td>
                    <form style='display: contents'>
                            <input type='hidden' value='$iemeUtilisateurAdministratif[idUtilisateur]' name='idUtilisateurAdmin'>
                            <button type='submit' name='Supprimer' $disabled_tag>Supprimer</button>
                    </form>
                </td>
                <td>";

                    switch ($iemeUtilisateurAdministratif["statusUtilisateur"]) {
                        // Si l'utilisateur est activé, on affiche le bouton "désactiver" et vice versa

                        case 1:
                            // L'utilisateur est activé, on affiche le bouton désactiver
                            echo "
                        <form style='display: contents'>
                            <input type='hidden' value='$iemeUtilisateurAdministratif[idUtilisateur]' name='idUtilisateurAdmin'>
                            <button style='width: 100%;' type='submit' name='Desactiver' $disabled_tag>Désactiver</button>
                        </form>";
                            break;

                        case 0:
                            // L'utilisateur est activé, on affiche le bouton désactiver
                            echo "
                        <form style='display: contents'>
                            <input type='hidden' value='$iemeUtilisateurAdministratif[idUtilisateur]' name='idUtilisateurAdmin'>
                            <button style='width: 100%;' type='submit' name='Activer' $disabled_tag>Activer</button>
                        </form>";
                        break;
                }
            }
            echo "
                
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

    echo "<style>* {color: white;}</style>";

    if ($modeCreation)
        echo "<H1>Création d'un nouvel utilisateur administratif</H1>";
    else
        echo "<H1>Edition d'un utilisateur administratif</H1>";
    echo "
    <table style='display: inline-block'> 
    <form>
        <input type='hidden' name='id_utilisateur_edit' value='$idUtilisateur'>
        <tr>
            <td>
                <label>Nom de compte : </label>
            </td>
            <td>
                <input style='color: black;' type='text' name='nouveau_login' value='$login'> 
            </td>
        </tr>
        
        <tr>
            <td>
                <label>Niveau d'autorisation : </label>
            </td>
            <td>";


    if ($_SESSION["idUtilisateur"] == $idUtilisateur)
    {
        // Si l'utilisateur qu'on modifie est celui connecté, on désactive le choix du niveau d'autorisation
        echo "<select style='color: black;' name='niveauAutorisation' required disabled>";
    }

    else
    {
        echo "<select style='color: black;' name='niveauAutorisation' required>";
    }

                switch ($niveauAutorisation) {
                    case "2":
                        echo "
                        <option value='1'>Niveau 1 - Administrateur</option>
                        <option value='2' selected>Niveau 2 - Commercial</option>";
                        break;
                    default:
                        echo "
                        <option value='1' selected>Niveau 1 - Administrateur</option>
                        <option value='2'>Niveau 2 - Commercial</option>";
                        break;
                }

    echo "     </select>
            </td>
        </tr>
        <tr>";
    if ($modeCreation) {
        echo "
            <td colspan='2' style='text-align: center'>
            <button style='color: black;' type='submit' name='buttonCreer'>Créer cet utilisateur</button>";


    } else {
        echo "<td>
                <button style='color: black;' type='submit' name='réinitialiserMDP'>Réinitialiser le mot de passe</button>
            </td>
            <td>
                <button style='color: black; width: 100%' type='submit' name='mettreAJour'>Mettre à jour</button>";
    }

    echo "</td>
        </tr>

    </form>
</table>

";
}