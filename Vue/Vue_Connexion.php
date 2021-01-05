<?php
/**
 *
 */
function Vue_Connexion_Formulaire_connexion_entreprise($msgErreur = "")
{
    echo "
    <form action='connexion.php' style='width: 40%; display: block; margin: auto; margin-top: 26vh; box-shadow: cyan 0px 0px 15px; border-radius: 20px;'>
        <h1>Entreprise</h1>
        <h2 style='width: 50%; text-align: center; margin: auto'>— Connexion —</h2>
        
        <hr class='styled' style='background-image: linear-gradient(to right, rgba(0, 0, 0, 0), rgba(0, 0, 0, 1), rgba(0, 0, 0, 0)); width: 60%'>  
        
        <label><b>Compte</b></label>
        <input type=\"text\" placeholder=\"login\" name=\"compte\" required>
        
        <label><b>Mot de passe</b></label>
        <input type=\"password\" placeholder=\"mot de passe\" name=\"password\" required>
                
        <input type=\"submit\" id='submit' value='Se connecter'>
        
        <hr class='styled' style='background-image: linear-gradient(to right, rgba(0, 0, 0, 0), rgba(0, 0, 0, 0.75), rgba(0, 0, 0, 0)); width: 100%'>
        
        <a href='connexionAdmin.php'> < Connexion : Administration </a>";

    if($msgErreur != "")
    {
        echo "<h3>Erreur : $msgErreur</h3>";
    }

    echo "</form>";
}

function Vue_Connexion_Formulaire_connexion_administration($msgErreur = "")
{
    echo "
        <form action='connexionAdmin.php' style='width: 40%; display: block; margin: auto; margin-top: 26vh; box-shadow: cyan 0px 0px 15px; border-radius: 20px;'>
        
        <h1>Administration</h1>
        <h2 style='width: 50%; text-align: center; margin: auto'>— Connexion —</h2>
        
        <hr class='styled' style='background-image: linear-gradient(to right, rgba(0, 0, 0, 0), rgba(0, 0, 0, 1), rgba(0, 0, 0, 0)); width: 60%'>     
        <label><b>Compte</b></label>
        <input type=\"text\" placeholder=\"login\" name=\"login\" required>

        <label><b>Mot de passe</b></label>
        <input type=\"password\" placeholder=\"mot de passe\" name=\"password\" required>

        <input type=\"submit\" id='submit' value='Se connecter' >
        
        <hr class='styled' style='background-image: linear-gradient(to right, rgba(0, 0, 0, 0), rgba(0, 0, 0, 0.75), rgba(0, 0, 0, 0)); width: 100%'>
        
        <a href='connexion.php'> < Connexion : Entreprises </a>
        ";

    if($msgErreur != "")
    {
        echo "<h4>Erreur : $msgErreur</h4>";
    }

    echo "</form>";
}
