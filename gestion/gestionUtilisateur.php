<?php
var_dump($_POST);
$bdd = new PDO('mysql:host=isp.seblemoine.fr;dbname=bdd_chargpt', 'bdd_chatgpt', 'ySdf94kAM@');

$req = $bdd->prepare('INSERT INTO Utilisateur(pseudo_user) VALUES(:pseudo_user)');
$req->execute(array(
    'pseudo_user' => $_POST['pseudo_user']
));

$req->closeCursor();

