<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>connexion</title>
</head>
<link rel="stylesheet" href="../css/admin.css">

<body>
<?php
if (isset($_GET['erreur'])){
    echo '<p style="color:red" align="center">'.$_GET['erreur'];
}
?>
<form action="../gestion/gestionConnexionAdmin.php" method="post">
<table>

<h3>login
 <input type="login" name="login" ></h3>
    <h3>mdp
        <input type="mdp" name="mdp"></h3>
        <tr>
            <td>
         <input class="deh" type="submit" value="connexion">
            </td>
        </tr>
       <a href=""><input class="deA" type="submit" value="utilisateur"></a>
</table>
</form>
</body>
</html>