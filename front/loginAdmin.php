<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>connexion</title>
    <link rel="stylesheet" href="../css/admin.css">
</head>
<body>
<video class="video-background" autoplay playsinline muted loop>
    <source src="https://storage.coverr.co/videos/7RzPQrmB00s01rknm8VJnXahEyCy4024IMG?token=eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJhcHBJZCI6Ijg3NjdFMzIzRjlGQzEzN0E4QTAyIiwiaWF0IjoxNjI5MTg2NjA0fQ.M8oElp5VNO8bWEWmdF2nGiu3qDOOYRFfP8wkKvl8I20" type="video/mp4">
    Votre navigateur ne supporte pas la vidéo HTML5.
</video>

<div class="content">
    <?php
    if (isset($_GET['erreur'])) {
        echo '<p style="color:red" align="center">' . $_GET['erreur'] . '</p>';
    }
    ?>
    <form action="../gestion/gestionConnexionAdmin.php" method="post">
        <div class="form-container">
            <h3>login
                <input type="text" name="login" required>
            </h3>
            <h3>mdp
                <input type="password" name="mdp" required>
            </h3>
            <div class="d-grid gap-2">
                <input class="deh" type="submit" value="connexion">
            </div>
        </div>
    </form>
    <a href="index.php">
        <input class="deA" type="submit" value="utilisateur">
    </a>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
