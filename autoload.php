<?php
session_start();
//Création du tableau des dossiers à parcourir
$paths = array(
    join(DIRECTORY_SEPARATOR, [__DIR__, 'Modele']),
    join(DIRECTORY_SEPARATOR, [__DIR__, 'Vue'])
);


//Pour chaque dossier à parcourir
foreach($paths as $path){
    //On récupère la liste des fichiers php dans ces dossiers
    $fileList = glob($path.'\*.php');
    //On parcourt la liste des dossiers
    foreach($fileList as $filename){
    //    echo $filename."\n";
        include ($filename);
    }

}

//ce code inclut automatiquement tous les fichiers php dans les dossiers Modele et Vue
//Ce code est un peu vieillot (état de l'art entre 2005/2010) mais nous n'avons pas le choix sans objet (stratégie habituelle entre 2005/2010).
//Aujourd'hui, il y a  des solutions automatisées (avec spl_autoload_register) mais il faudrait programmer en objet (second semestre !!!).
