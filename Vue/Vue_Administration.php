<?php
function Vue_Administration_Menu()
{
    /*
     * Navbar de la page d'administration
     */

    echo "
<nav id='menu'>
  <ul id='menu-closed'> 
    <li><a href='Gerer_entreprisesPartenaires.php'>Entreprises partenaires</a></li>
    <li><a href='Gerer_utilisateursAdministratifs.php'>Utilisateurs administratifs</a></li>  
    <li><a href='Gerer_monCompte.php'>Mon compte</a></li>  
  </ul>
</nav> ";
}

function Vue_Administration_Gerer_Compte(){
    /*
     * Body de le la page "Gérer mon compte"
     * Administration -> Navbar -> Mon compte
     */

    echo " 
    <H1>Gérer mon compte</H1>
    <table style='display: inline-block'>
        <tr>
            <td>
                <form style='display: contents'>
                    <button type='submit' name='changerMDP'>Changer mot de passe </button>
                </form>
            </td>
        </tr>
        <tr>
            <td>
                <form style='display: contents'>
                    <button type='submit' name='SeDeconnecter'>Se déconnecter </button>
                </form>
            </td>
        </tr>
    </table>
    
    ";
}

function Vue_ModifierMDP_SuperAdmin($erreur = "") {
    /*
     * Vue de saisie du nouveau mot de passe administrateur
     */

    if ($erreur != "") {
        echo "
        <h1>Une erreur est survenue!</h1>
        <p style='text-align: center'>
            <b>$erreur</b>
        </p>
        ";

        return;
    }

    echo "
    <table border align='center' style='padding-top: 25px'>
    <form>
        <tr>
            <td>
                <input type='password' required placeholder='Ancien mot de passe' name='old_pass'> 
            </td>
        </tr>
        <tr>
            <td>
                <input type='password' required placeholder='Nouveau mot de passe' name='new_pass'> 
            </td>
        </tr>
        <tr>
            <td>
                <input type='password' required placeholder='Confirmation du nouveau mot de passe' name='new_pass_confirm'>
            </td>
        </tr>
        <tr>
            <td>
                <input type='submit' name='changerMDP_confirmation' value='Confirmer'>
            </td>
        </tr>
    </form>
    </table>
    ";

}