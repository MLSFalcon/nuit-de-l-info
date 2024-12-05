<?php
$bdd = new PDO('mysql:host=localhost;dbname=RACEFORWATER;charset=utf8','root','');

$req = $bdd->prepare('INSERT INTO Utilisateur(pseudo_user) VALUES(:pseudo_user)');
$req->execute(array(
    'pseudo_user' => $_POST['pseudo_user']
));

$req->closeCursor();
header("location:../index.php");
