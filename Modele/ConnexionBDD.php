<?php

/**
 * Fonction qui crée la connexion à la base de données.
 * @return PDO : Connexion à la base de données
 */
function Creer_Connexion()
{
    $instancePdo = new PDO('mysql:host=127.0.0.1;dbname=torrefacteur;charset=UTF8',  "root", "", array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION ));
    return $instancePdo;
}

