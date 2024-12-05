<?php
$lieu = $_POST['lieu'];
$bdd = new PDO('mysql:host=isp.seblemoine.fr;dbname=bdd_chargpt', 'bdd_chatgpt', 'ySdf94kAM@');


$requete = $bdd->prepare('DELETE FROM Lieu WHERE id_lieu = :lieu ');
$requete->execute(array(
    'lieu' => $lieu
));
$requete->closeCursor();
header("location:../front/InterfaceAdmin.php");
