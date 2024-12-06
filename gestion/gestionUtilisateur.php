<?php
$bdd = new PDO('mysql:host=isp.seblemoine.fr;dbname=bdd_chargpt', 'bdd_chatgpt', 'ySdf94kAM@');
$req = $bdd->prepare('SELECT * FROM Utilisateur');
$req->execute();
$email = $req->fetchAll();
$existe = 0;
for ($i = 0; $i < count($email); $i++) {
    if ($email[$i]['email'] == $_POST['pseudo_user']) {
        $existe = 1;
    }
}
if($existe == 1){
    $req = $bdd->prepare('SELECT * FROM Utilisateur WHERE pseudo_user = :pseudo');
    $req->execute(array(
        'pseudo' => $_POST['pseudo_user']
    ));
    $donnee = $req->fetchAll();
    $_SESSION['id_user'] = $donnee[0]['id_user'];
    $_SESSION['nb_clique'] = 0;
    header('location:../front/map.php');
}else{
    $req = $bdd->prepare('INSERT INTO Utilisateur(pseudo_user,nb_clique) VALUES(:pseudo_user,:nb_clique)');
    $req->execute(array(
        'pseudo_user' => $_POST['pseudo_user'],
        'nb_clique' => 0
    ));

    $req->closeCursor();

    $req = $bdd->prepare('SELECT * FROM Utilisateur WHERE pseudo_user = :pseudo');
    $req->execute(array(
        'pseudo' => $_POST['pseudo_user']
    ));
    $donnee = $req->fetchAll();
    $_SESSION['id_user'] = $donnee[0]['id_user'];
    $_SESSION['nb_clique'] = 0;
    header('location:../front/map.php');
}


