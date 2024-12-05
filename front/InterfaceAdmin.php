
<form method="post" action="InterfaceAdmin.php">
    <input type="submit" name=ajouter value="Ajouter">
</form>

<?php
if (isset($_POST['ajouter'])){
    ?>
    <form action=".././gestion/gestionAjoutDePoint.php" method="post">
        <label><input type="number" required step="any">Position X</label>
        <label><input type="number" required step="any">Position Y</label>
        <label><textarea>Texte : </textarea></label>
        <input type="submit" name="confirmer" value="ConfirmerAjout">
    </form>
    <?php
}

session_start();
$bdd = new PDO('mysql:host=https://isp.seblemoine.fr;dbname=bdd_chargpt;charset=utf8', 'bdd_chatgpt', 'ySdf94kAM@');


$requete = $bdd->prepare('SELECT * FROM Lieu');
$requete->execute();
$liste = $requete->fetchAll();
$requete->closeCursor();

var_dump($liste);

?>
<table id= "example" border="1">

    <thead>
    <tr>
        <td>Titre</td>
        <td>Année</td>
        <td>Résumé</td>
        <td>Auteur</td>

    </tr>
    </thead>
    <tbody>
    <?php
    for ($i=0; $i < count($liste); $i++) {
        ?>
        <tr>
            <td>
                <?= $liste[$i]['coordonnee_x']+$liste[$i]['coordonnee_y']?>
            </td>
            <td>
                <?= $liste[$i]['resume']?>
            </td>
        </tr>
        <?php
    }
    ?>
</table>

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

