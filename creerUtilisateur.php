<?php
include ("autoload.php");

//Code à utiliser en mode console
//Ce code sert à créer un utilisateur du back office, si jamais vous le perdez...


$connexion = Creer_Connexion();

$id = Utilisateur_Creer($connexion, "root", "1");

Utilisateur_Modifier_motDePasse($connexion, $id , "secret");