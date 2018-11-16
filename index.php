<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Explorateur de fichier</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
</head>

<body>
<h1>Explorateur de Fichier PHP</h1>
<?php
$nb_fichier = 0;
$dossierDemander;
$arborescence;

/*********************************************************
***********    Préparation de l'arborescence   ***********
***********    pour accèder au bon dossier     ***********
*********** et du chemin pour le bouton retour *********** 
**********************************************************/

// Ici on met à jour la position dans l'arborescence des dossiers (fil d'Arianne)
// Si il y a des caractère dans le tableau arborescence et si arborescence ne vaut pas /explorateurFichier
if (isset($_GET['arborescence']) && $_GET['arborescence'] != '/explorateurFichier'){
    
    $arborescence = $_GET['arborescence'];  // On récupere la position actuelle depuis la racine
    
    $dossierDemander = "../".$arborescence; // On définit le chemin à suivre pour accèder au dossier


    //Pour le bouton retour je commence par tester si l'arborescence n'est pas vide
    if ($arborescence != ""){

        
        $retour = strrpos($arborescence, "/");  //strrpos = position du dernier / dans la chaine de caractère arborescence

        $retour = substr($arborescence, 0, $retour);    //retour = Chaine de caractère situé avant le dernier "/"
        
        echo '<p><a href="?arborescence='.$retour.'"><i class="fas fa-arrow-left fa-2x"></i></a></p>';
       
        echo '<div class="arborescence"> ' . $arborescence .'</div>'; //Affiche la variable Arborescence

       // echo 'dossier demander = ' . $dossierDemander .'<br>';
        
    }

    // // Sinon on reviens a la racine
    // else {
    //     echo '<p><a href="/">Retour</a></p>';
    // }
}
// Si il n'y a pas de variable arborescence dans l'URL alors on affiche ce qui est présent à la racine du localhost
else {
    $arborescence = "/explorateurFichier"; //$arborescence vaut vide
    $dossierDemander = "../explorateurFichier"; // Dossier demander vaut retour
    echo '<p><a href="./"><i class="fas fa-arrow-left fa-2x"></i></a></p>';  // Afficher le bouton retour

}

/****************************************************
 *******      Affichage du tableau       ************
 ******* Avec les variables dans les URL ************ 
 ****************************************************/
?>


<div class="listederoulante">
<?php
// si var dossier = ouvre le dossier ($dossierdemander)
if ($dossier = opendir($dossierDemander)) {

    // Tant qu'il y a un fichier applique la boucle
    while (false !== ($fichier = readdir($dossier))) {

        // si le fichier n'est pas le fichier courant ou le parent ou index.php
        if ($fichier != '.' && $fichier != '..' && $fichier != 'index.php' && $fichier != '.git' && $fichier != 'main.css' && $fichier != 'main.js')
        {

            if (is_dir($dossierDemander."/".$fichier) || $fichier == 'explorateurFichier')
            {
                $nb_fichier++;
                // Crée un lien pour $arborescence = $arborescence/$fichier et affiche $fichier
                //                  ?Paramètre  =  valeur
                echo '<li><a href="?arborescence=' .$arborescence. '/' .$fichier. '"><img class="dossier" src="dossier.png">' . $fichier . '</a></li>';
            }
            else 
            {   // Sinon crée un lien direct vers le fichier
                $nb_fichier++;
                //
                echo '<li><a href=" ' .$arborescence.'/' .$fichier. '"><img class="fichier" src="fichier.png">' . $fichier . '</a></li>';
            }
            

        } //Fin de if 

    }?>
    </div>
    <?php //On termine la boucle

    echo '</ul><br />';
    echo '<div class="nombredossier">Il y a <strong>' . $nb_fichier . '</strong> élément(s) dans le dossier</div>';

    closedir($dossier);
} 
else
{
    echo "Le dossier n' a pas pu être ouvert";
}

//  echo isset($path_parts['extension']);
//  $path_parts = pathinfo($fichier);
//  var_dump($path_parts);
// echo  'fichier = ' . $fichier;



?>
<script src="main.js"></script>
</body>
</html>

<!-- 
$dossier = scandir ('.') = scandir de sossier courant
print_r($dossier);

realpath('index.php') = affiche le chemi réel

-->