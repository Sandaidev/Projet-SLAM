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
			<li><a href='Gerer_catalogue.php'>Catalogue</a></li>
			<li><a href='Gerer_monCompte.php'>Mon compte</a></li>  
      	</ul>
    </nav> ";
}

function Vue_Administration_Gerer_Compte($nom_compte)
{
    /*
     * Body de le la page "Gérer mon compte"
     * Administration -> Navbar -> Mon compte
     */

    echo "
    <h1 style='color: white;'>Gérer mon compte</h1>
    
    <table style='margin: auto;'>
        <tr style='text-align: center; color: white;'>
            <th>Vous êtes connecté(e) en tant que : <em>$nom_compte</em></th>
        </tr>
        
        <!-- Bouton : Changer le mot de passe actuel -->
        <tr style='text-align: center'>
            <td>
                <form style='display: contents'>
                    <button style='width: 100%' type='submit' name='changerMDP'>Changer mot de passe </button>
                </form>
            </td>
        </tr>
        
        <!-- Bouton : Se déconnecter -->
        <tr style='text-align: center'>
            <td>
                <form style='display: contents'>
                   <button style='width: 100%' type='submit' name='SeDeconnecter'>Se déconnecter </button>
                </form>
            </td>
        </tr>
    </table>
    
    ";
}

function Vue_ModifierMDP_SuperAdmin($erreur = "")
{
    /*
     * Vue de saisie du nouveau mot de passe administrateur
     */

    if ($erreur != "")
    {
        echo "
        <h1>Une erreur est survenue!</h1>
        <p style='margin: auto; text-align: center'>
            <b>$erreur</b>
        </p>
        ";

        return;
    }

    echo "
    <table align='center' style='padding-top: 25px'>
        <form>
            <tr>
                <td><input type='password' required placeholder='Ancien mot de passe' name='old_pass'></td>
            </tr>
            
            <tr>
                <td><input type='password' required placeholder='Nouveau mot de passe' name='new_pass'></td>
            </tr>
            
            <tr>
                <td><input type='password' required placeholder='Confirmation du nouveau mot de passe' name='new_pass_confirm'></td>
            </tr>
            
            <tr>
                <td><input type='submit' name='changerMDP_confirmation' value='Confirmer'></td>
            </tr>
        </form>
    </table>
    ";

}