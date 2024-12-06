<?php
session_start();
$bdd = new PDO('mysql:host=isp.seblemoine.fr;dbname=bdd_chargpt', 'bdd_chatgpt', 'ySdf94kAM@');

if (!isset($_SESSION['id_user'])) {
    echo 0;
}
else{
    $requete = $bdd->prepare('UPDATE Utilisateur SET nb_clique=:nb_clique WHERE id_user = :id_user');
    $requete->execute(array
    ('nb_clique' => $_GET['nb_clique'],
        'id_user' => $_SESSION['id_user']));
    echo 1;
}
