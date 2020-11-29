<?php
/**
 * Fonction qui affiche l'entête HTML de chaque page
 * @param bool $enHTML
 */
function Vue_Structure_Entete($enHTML = false){

    if($enHTML == false)
        echo "<html>
        <head>
           <meta charset=\"utf-8\">
            <!-- importer le fichier de style -->
            <link rel=\"stylesheet\" href=\".\public\style.css\" media=\"screen\" type=\"text/css\" />
        </head>
        <body>
            <div id=\"container\">";
    else
        echo "<html>
        <head>
           <meta charset=\"utf-8\">
            <!-- importer le fichier de style -->
            <link rel=\"stylesheet\" href=\"..\style.css\" media=\"screen\" type=\"text/css\" />
        </head>
        <body>
            <div id=\"container\">";
}

/**
 * Fonction qui affiche le bas HTML de chaque page
 */
function Vue_Structure_BasDePage(){
    echo" 
            

        </div>
    </body>
</html>";
}