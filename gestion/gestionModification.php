<?php
$bdd = new PDO('mysql:host=isp.seblemoine.fr;dbname=bdd_chargpt', 'bdd_chatgpt', 'ySdf94kAM@');
if(isset($_POST['modifier'])) {
    $requete = $bdd->prepare('UPDATE Lieu SET coordonnee_x =:coordonnee_x, coordonnee_y = :coordonnee_y, resume = :resume WHERE id_lieu =:id');
    $requete->execute(array(
        'id' => $_POST['id_lieu'],
        'coordonnee_x' => $_POST['coordonnee_x'],
        'coordonnee_y' => $_POST['coordonnee_y'],
        'resume' => $_POST['resume']
    ));
}
header("location:../front/InterfaceAdmin");