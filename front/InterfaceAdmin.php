<?php
session_start();
if (!isset($_SESSION['id_admin'])){
    header("location:index.html");
}
?>
<head>
    <link rel="stylesheet" href="../css/interfaceAdmin.css">
</head>
<form method="post" action="InterfaceAdmin.php">
    <input type="submit" name=ajouter value="Ajouter">
</form>
<form method="post" action="InterfaceAdmin.php">
    <input type="submit" name=ajouterQuestion value="ajouter question">
</form>
<?php
if (isset($_GET['Ajout'])) {
    echo $_GET['Ajout'];
}
?>

<?php
if (isset($_POST['ajouter'])){
    ?>
    <form action=".././gestion/gestionAjoutDePoint.php" method="post">
        <label>Titre<input type="text" name="titre" required></label>
        <label>Position X<input type="number" name="posX" required step="any"></label>
        <label>Position Y<input type="number" name="posY" required step="any"></label>
        <label><textarea name="resume"></textarea></label>
        <label>inserer le lien du QR code<input type="text" name="qr_code"></label>
        <input type="submit" name="confirmer" value="ConfirmerAjout">
    </form>
    <?php
}
?>
<?php
if (isset($_POST['ajouterQuestion'])){
    ?>
    <form action=".././gestion/gestionAjoutDePoint.php" method="post">
        <label>Question<input type="text" name="question" required></label>
        <label>Reponse<input type="text" name="reponse" required></label>
        <input type="submit" name="confirmerQuestion" value="ConfirmerAjout">
    </form>
    <?php
}
$bdd = new PDO('mysql:host=isp.seblemoine.fr;dbname=bdd_chargpt', 'bdd_chatgpt', 'ySdf94kAM@');

if (isset($_POST['modifier'])){
    $bdd = new PDO('mysql:host=isp.seblemoine.fr;dbname=bdd_chargpt', 'bdd_chatgpt', 'ySdf94kAM@');

    $requete = $bdd->prepare('SELECT * FROM Lieu WHERE id_lieu = :lieu');
    $requete->execute(array(
        'lieu' => $_POST['lieu']
    ));
    $info = $requete->fetch();
    $requete->closeCursor();
    ?>
    <table>
        <form action="../gestion/gestionModification.php" method="post">
            <input type="hidden" name="id_lieu" value="<?= $info['id_lieu'] ?>">
            <tr>
                <td><label for="titre"></label>titre :</td>
                <td><input type="text" id="titre" required name="titre" value=<?=$info['titre']?>></td>
            </tr>
            <tr>
                <td><label for="coordonnee_x"></label>coordonnee_x :</td>
                <td><input type="text" id="coordonnee_x" required name="coordonnee_x" value=<?=$info['coordonnee_x']?>></td>
            </tr>
            <tr>
                <td><label for="coordonnee_y">coordonnee_y : </label></td>
                <td><input type="text" id="coordonnee_y" required name="coordonnee_y" value=<?=$info['coordonnee_y']?>></td>
            </tr>
            <tr>
                <td><label for="resume">resume : </label></td>
                <td><textarea name="resume" id="resume" rows="20px" cols="100px" ><?=$info['resume']?></textarea> </td>
            </tr>
            <tr>
                <td><label for="qr_code">lien Qr code : </label></td>
                <td><input type="text" id="qr_code" required name="qr_code" value=<?=$info['qr_code']?>></td>
            </tr>
            <tr>
                <td><input type="submit" name="modifier" value="confirmer"></td>
            </tr>
        </form>
    </table>
<?php }
if (isset($_POST['modifierQuestion'])) {
    $bdd = new PDO('mysql:host=isp.seblemoine.fr;dbname=bdd_chargpt', 'bdd_chatgpt', 'ySdf94kAM@');

    $requete = $bdd->prepare('SELECT * FROM Questionnaire WHERE id_questionnaire = :id');
    $requete->execute(array(
        'id' => $_POST['question']
    ));
    $info = $requete->fetch();
    $requete->closeCursor();
?>
<table>
    <form action="../gestion/gestionModification.php" method="post">
        <input type="hidden" name="id_questionnaire" value="<?= $info['id_questionnaire'] ?>">
        <tr>
            <td><label for="titre"></label>Question :</td>
            <td><textarea name="question" id="question" rows="20px" cols="100px" ><?=$info['Question']?></textarea></td>
        </tr>
        <tr>
            <td><label for="reponse"></label>Reponse :</td>
            <td><input type="text" id="reponse" required name="reponse" value=<?=$info['reponse']?>></td>
        </tr>
        <tr>
            <td><input type="submit" name="modifierQuestion" value="confirmer"></td>
        </tr>
    </form>
</table>
<?php
}


$requete = $bdd->prepare('SELECT * FROM Lieu');
$requete->execute();
$liste = $requete->fetchAll();
$requete->closeCursor();

$requete = $bdd->prepare('SELECT * FROM Questionnaire');
$requete->execute();
$listeQuestion = $requete->fetchAll();
$requete->closeCursor();


?>
<table id= "example" border="1">

    <thead>
    <tr>
        <td>Titre</td>
        <td>Coordonée</td>
        <td>Résumé</td>
        <td>QR code</td>
        <td>Action</td>
    </tr>
    </thead>
    <tbody>
    <?php
    for ($i=0; $i < count($liste); $i++) {
        ?>
        <tr>
            <td>
                <?= $liste[$i]['titre']?>
            </td>
            <td>
                <?= $liste[$i]['coordonnee_x']," / ",$liste[$i]['coordonnee_y']?>
            </td>
            <td>
                <?= $liste[$i]['resume']?>
            </td>
            <td>
                <img src="<?= $liste[$i]['qr_code']?>" width="200px">
            </td>
            <td>
                <form action="InterfaceAdmin.php" method="post">
                    <input type="hidden" name="lieu" value=<?= $liste[$i][0] ?>>
                    <input type="submit" value="modifier" name="modifier">
                </form>
                <form action="../gestion/gestionSuppression.php" method="post">
                    <input type="hidden" name="lieu" value="<?= $liste[$i][0] ?>">
                    <input type="submit" value="supprimer">
                </form>
            </td>
        </tr>
        <?php
    }
    ?>
</table>


<table id= "example" border="1">

    <thead>
    <tr>
        <td>Question</td>
        <td>Reponse</td>
        <td>Action</td>
    </tr>
    </thead>
    <tbody>
    <?php
    for ($i=0; $i < count($listeQuestion); $i++) {
    ?>
    <tr>
        <td>
            <?= $listeQuestion[$i]['Question']?>
        </td>
        <td>
            <?= $listeQuestion[$i]['reponse']?>
        </td>
        <td>
            <form action="InterfaceAdmin.php" method="post">
                <input type="hidden" name="question" value=<?= $listeQuestion[$i]['id_questionnaire'] ?>>
                <input type="submit" value="modifierQuestion" name="modifierQuestion">
            </form>
            <form action="../gestion/gestionSuppression.php" method="post">
                <input type="hidden" name="question" value="<?= $listeQuestion[$i]['id_questionnaire'] ?>">
                <input type="submit" value="supprimer">
            </form>
        </td>
    </tr>
    <?php
    }
    ?>
    </tbody>
</table>

<hr>
<a href="../gestion/gestionDeconnexion.php">Se déconnecte</a>
<hr>
</body>
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/responsive/3.0.3/js/dataTables.responsive.js"></script>
<script src="https://cdn.datatables.net/responsive/3.0.3/js/responsive.dataTables.js"></script>
<script>
    new DataTable('#example', {
        responsive: true
    });
</script>