<?php
$bdd = new PDO('mysql:host=isp.seblemoine.fr;dbname=bdd_chargpt', 'bdd_chatgpt', 'ySdf94kAM@');
if(isset($_POST['modifier'])) {
    $requete = $bdd->prepare('UPDATE Lieu SET coordonnee_x =:coordonnee_x, coordonnee_y = :coordonnee_y, titre = :titre, resume = :resume, qr_code = :qr_code WHERE id_lieu =:id');
    $requete->execute(array(
        'id' => $_POST['id_lieu'],
        'titre' => $_POST['titre'],
        'coordonnee_x' => $_POST['coordonnee_x'],
        'coordonnee_y' => $_POST['coordonnee_y'],
        'resume' => $_POST['resume'],
        'qr_code' => $_POST['qr_code']
    ));
    header("location:../front/InterfaceAdmin.php");
}
if (isset($_POST['modifierQuestion'])) {
    $requete = $bdd->prepare('UPDATE Questionnaire SET Question =:question, reponse = :reponse WHERE id_questionnaire =:id');
    $requete->execute(array(
        'id' => $_POST['id_questionnaire'],
        'question' => $_POST['question'],
        'reponse' => $_POST['reponse']
    ));
    header("location:../front/InterfaceAdmin.php");
}
