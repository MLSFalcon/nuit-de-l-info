<?php
$bdd = new PDO('mysql:host=isp.seblemoine.fr;dbname=bdd_chargpt', 'bdd_chatgpt', 'ySdf94kAM@');
session_start();

$requete  = $bdd->prepare("SELECT * FROM Questionnaire_user WHERE ref_user = :id AND ref_questionnaire = :questionnaire");
$requete->execute(array( 'id' => $_SESSION['id_user'], 'questionnaire' => $_POST['id_questionnaire']));
$donnee = $requete->fetch();
$requete->closeCursor();

var_dump($donnee);

if (!($donnee==NULL||(empty($donnee['ref_questionnaire']&&empty($donnee['ref_user']))))) {
header('Location: .././gestion/map.php?erreur=Vous avez déja répondu à cette question');
}

$requete=$bdd->prepare("SELECT * FROM Questionnaire WHERE id_questionnaire  = :id");
$requete->execute(array('id' => $_POST['id_questionnaire']));
$reponse = $requete->fetch();
$requete->closeCursor();

if ($reponse['reponse']==$_POST['reponse']) {
    $requete=$bdd->prepare("INSERT INTO Questionnaire_user(ref_user,ref_questionnaire) VALUES (:id,:questionnaire)");
    $requete->execute(array( 'id' => $_SESSION['id_user'], 'questionnaire' => $_POST['id_questionnaire']));
    $requete->closeCursor();

    $requete=$bdd->prepare("UPDATE Utilisateur SET nb_clique=nb_clique+10  WHERE id_user = :id");
    $requete->execute(array('id' => $_SESSION['id_user']));
    $_SESSION['nb_clique']+=10;
}

header('Location: .././front/map.php?ok=Félicitation, Bonne réponse !');