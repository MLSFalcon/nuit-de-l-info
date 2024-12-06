<?php
$bdd = new PDO('mysql:host=isp.seblemoine.fr;dbname=bdd_chargpt', 'bdd_chatgpt', 'ySdf94kAM@');
if (isset($_POST['confirmer'])){
    $requete = $bdd->prepare('INSERT INTO Lieu(coordonnee_x,coordonnee_y,titre,resume) VALUES (:coordonnee_x, :coordonnee_y, :titre, :resume)');
    $requete->execute(array(
        'coordonnee_x' => $_POST['posX'],
        'coordonnee_y' => $_POST['posY'],
        'titre' => $_POST['titre'],
        'resume' => $_POST['resume']
    ));
    $requete->closeCursor();

    header('Location:.././front/InterfaceAdmin.php? Ajout=Ajout bien pris en compte');
}
if (isset($_POST['confirmerQuestion'])){
    $requete = $bdd->prepare('INSERT INTO Questionnaire(Question,reponse) VALUES (:question, :reponse)');
    $requete->execute(array(
        'question' => $_POST['question'],
        'reponse' => $_POST['reponse']
    ));
    $requete->closeCursor();

    header('Location:../front/InterfaceAdmin.php');
}
?>