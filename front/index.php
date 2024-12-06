<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>RACEFORWATER</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <link rel="stylesheet" href="../css/deTouteBeautééééééé.css">
</head>
<body>

<video class="video-background" autoplay playsinline muted loop>
    <source src="https://storage.coverr.co/videos/7RzPQrmB00s01rknm8VJnXahEyCy4024IMG?token=eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJhcHBJZCI6Ijg3NjdFMzIzRjlGQzEzN0E4QTAyIiwiaWF0IjoxNjI5MTg2NjA0fQ.M8oElp5VNO8bWEWmdF2nGiu3qDOOYRFfP8wkKvl8I20" type="video/mp4">
    Votre navigateur ne supporte pas la vidéo HTML5.
</video>


<div class="content">
    <div class="form-container">
     <h2> <div class="h2o"> RACE4WATER</div></h2>
        <form action="../gestion/gestionUtilisateur.php" method="post">
            <div class="mb-3">
                <label for="pseudo_user" class="form-label">Pseudo</label>
                <input type="text" name="pseudo_user" id="pseudo_user" class="form-control">
            </div>
            <div class="d-grid gap-2">
                <button type="submit" name="Jouer" class="btn btn-primary">Jouer</button>
                <button type="submit" name="admin" class="btn btn-secondary">Connexion admin</button>
            </div>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
