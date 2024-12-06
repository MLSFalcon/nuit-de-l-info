<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Race 4 Water</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
          integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
          crossorigin=""/>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
            integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
            crossorigin="">
    </script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="../css/map.css" rel="stylesheet">

</head>
<body>

<div id="map" style="width: 100%; height: 100%">
</div>
<script
        src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo="
        crossorigin="anonymous"></script>
<script>

    var map = L.map('map').setView([46.52302030397954, 6.611348944330389], 2);

    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    L.marker([46.52302030397954, 6.611348944330389]).addTo(map)
        .bindPopup('Siege de Race 4 Water')
        .openPopup();

    <?php
    $bdd = include '../BDD/bdd.php';

    $reqPos = $bdd->prepare('SELECT * FROM Lieu');
    $reqPos->execute();
    $resultPos = $reqPos->fetchall();
    ?>
    var demo = `<?= json_encode($resultPos)?>`;
    demo = JSON.parse(demo);
    $( document ).ready(function() {
        for ( i = 0 ; i < demo.length ; i ++ ){
           console.log(demo[i])
            L.marker([demo[i]["coordonnee_x"], demo[i]["coordonnee_y"]]).addTo(map)
                .bindPopup(demo[i]["resume"])
                .openPopup();
        }
    });

    


</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
<?php