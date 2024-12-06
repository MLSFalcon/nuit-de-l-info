<?php
var_dump($_POST);

$bdd = new PDO('mysql:host=isp.seblemoine.fr;dbname=bdd_chargpt', 'bdd_chatgpt', 'ySdf94kAM@');

$requete = $bdd->prepare('INSERT INTO Lieu(coordonnee_x,coordonnee_y,titre,resume) VALUES (:coordonnee_x, :coordonnee_y, :titre, :resume)');
$requete->execute(array(
    'coordonnee_x' => $_POST['posX'],
    'coordonnee_y' => $_POST['posY'],
    'titre' => $_POST['titre'],
    'resume' => $_POST['resume']
));
$requete->closeCursor();

header('Location:.././front/InterfaceAdmin.php? Ajout=Ajout bien pris en compte');
?>