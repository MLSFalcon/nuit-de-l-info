<?php
$bdd = new PDO('mysql:host=isp.seblemoine.fr;dbname=bdd_chargpt', 'bdd_chatgpt', 'ySdf94kAM@');
if (isset($_POST['lieu'])) {
    $lieu = $_POST['lieu'];

    $requete = $bdd->prepare('DELETE FROM Lieu WHERE id_lieu = :lieu ');
    $requete->execute(array(
        'lieu' => $lieu
    ));
    $requete->closeCursor();

}

if (isset($_POST['question'])) {
    $question = $_POST['question'];

    $requete = $bdd->prepare('DELETE FROM Questionnaire WHERE id_questionnaire = :question ');
    $requete->execute(array(
        'question' => $question
    ));
    $requete->closeCursor();
}
header("location:../front/InterfaceAdmin.php");
