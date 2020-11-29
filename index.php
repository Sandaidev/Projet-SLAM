<?php

//Page appelée par défaut. Le client pourra se connecter et consulter le catalogue en static.
include_once ("autoload.php");

Vue_Structure_Entete();
Vue_Connexion_Formulaire_connexion_entreprise();
Vue_Structure_BasDePage();