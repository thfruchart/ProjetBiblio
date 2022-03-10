<?php
    require "../connexion.php";

    /*  REQUETE PRÉPARÉE  puis EXÉCUTÉE      */
    $req = $bdd->prepare('SELECT * FROM `livre` WHERE `titre` LIKE :titre');
    $titre = "%".$titre."%";
    $req->bindParam(':titre', $titre, PDO::PARAM_STR);
    $req->execute();
    $reponse_mot_du_titre = $req->fetchAll(PDO::FETCH_ASSOC);


/* Pour voir la reponse renvoyée par la requête : dé-commenter l'instruction suivante */
    /* var_dump($reponse_mot_du_titre);  */

/*  Pour voir comment parcourir chaque ligne de la variable $reponse,
    dé-commenter l'instruction suivante */
    /*   foreach($reponse_mot_du_titre as $element) :
            var_dump($element);
            echo "<br>";
    endforeach ; */
?>
