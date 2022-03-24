<?php
/* récupération du paramètre */
$isbn = htmlspecialchars($_GET['livre_choisi']) ;


/* connexion */
try
{
    $bdd = new PDO('mysql:host=localhost;dbname=bibli;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    $bdd->query("SET NAMES utf8"); /* pour éviter les pbs d'encodage */
}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());
}

/* définition de la variable $reponse_mot_du_titre  grâce à une requête SQL */

    $req = $bdd->prepare('SELECT `titre` , auteur.nom, auteur.prenom
                          FROM `livre`
                          JOIN auteur_de ON auteur_de.isbn = livre.isbn
                          JOIN auteur ON auteur.a_id = auteur_de.a_id
                          WHERE livre.`isbn`= :isbn;');

    $req->bindParam(':isbn', $isbn, PDO::PARAM_STR);
    $req->execute();
    $reponse_auteur = $req->fetchAll(PDO::FETCH_ASSOC);

?>
<!doctype html>
<html>
 <head>
     <title>
        Auteurs trouvés
     </title>
     <meta charset="utf8">
 </head>
 <body>
    <?php if (count($reponse_auteur) == 0){
         echo "<h2>Pas d'auteurs' trouvé</h2>";
     }
     else {
        echo "<h2>Titres trouvés : </h2>";
     }
    ?>
     <ul>
         <?php foreach($reponse_auteur as $element) : ?>
            <li> <?= $element["nom"]  ?>  <?= $element["prenom"]  ?></li>
         <?php endforeach ;?>
     </ul>
 </body>
</html>
