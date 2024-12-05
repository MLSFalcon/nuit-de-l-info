<?php
if (isset($_POST['mdp'])){
    $bdd = new PDO('mysql:host=localhost;dbname=RACEFORWATER;charset=utf8','root','');

    $req = $bdd -> prepare('SELECT * FROM Administrateur WHERE login = :login AND mdp = :mdp');
    $req -> execute(array(
        'login' => $_POST['login'],
        'mdp' => $_POST['mdp']
    ));
    $donnee = $req -> fetch();
    session_start();
    $_SESSION['login'] = $donnee['login'];
    $_SESSION['id_admin'] = $donnee['id_admin'];
    if ($donnee ['login'] == $_POST['login'] && $donnee['mdp'] == $_POST['mdp']){
        header("location:../index.php");
    }
    else{
        session_destroy();
        header("location:../connexion.php?erreur = Erreur, login ou mot de passe incorrect");
    }
}
?>
