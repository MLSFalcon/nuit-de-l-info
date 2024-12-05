<?php
var_dump($_POST);

$bdd = new PDO('mysql:host=isp.seblemoine.fr;dbname=bdd_chargpt', 'bdd_chatgpt', 'ySdf94kAM@');

$requete = $bdd->prepare('INSERT INTO Lieu VALUES ');

$requete->closeCursor();
