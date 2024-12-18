<?php
session_start();

?>
    <!DOCTYPE html>
    <html lang="fr" onclick="toucheClick()" style="height: 100%">
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
    <body class="container-fluid" style="height: 100%">
    <div class="row" style="height: 100%">
        <div class="col-sm-9" >
            <div id="map" style="width: 100%; height: 100%; display: inline-block;">    </div>
        </div>

        <div class="col-sm-3 text-center" style="height: 100px">

            <div id="demo" class="text-center"  onclick="if (counterVal%10 === 0){reload(truc)}">
                Cliquez n'importe où sur l'écran
            </div>
            <div>
                <center><h3 class="container-fluid"  id="compteur">0</h3></center>
            </div>
            <hr>


            <?php
            $bdd = new PDO('mysql:host=isp.seblemoine.fr;dbname=bdd_chargpt', 'bdd_chatgpt', 'ySdf94kAM@');
            $req = $bdd->prepare('SELECT * FROM Questionnaire WHERE id_questionnaire NOT IN (SELECT id_questionnaire FROM Questionnaire as q RIGHT JOIN Questionnaire_user as qu On q.id_questionnaire =qu.ref_questionnaire WHERE qu.ref_user = :ref_user);  ');
            $req->execute([
                'ref_user' => $_SESSION['id_user'],
            ]);
            $donnee = $req->fetchAll();


        ?>
<div width="50px">
            <?php
            foreach ($donnee as $donnee1) {
                echo "<form action='../gestion/gestionReponse.php' method='POST'>";
                echo "<label for='$donnee1[Question]'>$donnee1[Question]</label>";
                echo "<input type='text' name='reponse' id='$donnee1[Question]'>";
                echo "<input type='hidden' name='id_questionnaire' value='$donnee1[id_questionnaire]'>";
                echo "<input type='submit' name='Valider' value='Valider'>";
                echo "</form>";
                ?><br>
            <?php
            }
            ?>
    <br><hr>
    <form action=".././gestion/gestionDeconnexion.php">
        <input class="align-bottom" type="submit" name="deconnexion" value="Se déconnecter">
    </form>
</div>
    </div>
</div>
<div id="modal">
</div>

    <center>


        <script
                src="https://code.jquery.com/jquery-3.7.1.min.js"
                integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo="
                crossorigin="anonymous"></script>
        <script>
            var map = L.map('map').setView([46.52302030397954, 6.611348944330389], 3);

            L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
                noWrap: true,
                minZoom: 0,
            }).addTo(map);


            <?php
            $bdd = include '../BDD/bdd.php';

            $reqPos = $bdd->prepare('SELECT * FROM Lieu');
            $reqPos->execute();
            $resultPos = $reqPos->fetchall();
            ?>

            var demo = `<?= json_encode($resultPos)?>`;

            demo = JSON.parse(demo);
            var modalC = document.getElementById("modal");
            for (i = 0 ; i < demo.length ; i++){
                console.log(demo[i])
                modalC.innerHTML += `<!-- Modal -->
<div class="modal fade" id="demo_`+i+`" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">`+ demo[i]["titre"] +`</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>`+ demo[i]["resume"] +`</p>
        <img src="`+ demo[i]["qr_code"] +`">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>`
            }
            indice = <?=(isset($_SESSION["nb_clique"]))? $_SESSION["nb_clique"]/10 : 0?>;
            var max = (demo.length >= indice)?indice : demo.length
            for (i = 0 ; i < max ; i++){
                L.marker([demo[i]["coordonnee_x"], demo[i]["coordonnee_y"]]).addTo(map)
                    // .bindPopup(demo[i]["titre"]+'<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#demo_'+i +'">Launch demo modal </button>')
                    .bindPopup("<a href='#' data-bs-toggle='modal' data-bs-target='#demo_"+ i +"'  >"+ demo[i]["titre"] +"</a>")
                    .openPopup();
            }
            let counterVal = <?=(isset($_SESSION["nb_clique"]))? $_SESSION["nb_clique"] : 0?>;

            // Fonction pour mettre à jour l'affichage
            function updateDisplay(val) {
                document.getElementById('compteur').innerHTML = val;
            }

            // Fonction de gestion du clic sur "Cliquer"
            function toucheClick() {
                counterVal++;
                if(counterVal%10 == 0){
                    indice++
                    L.marker([demo[indice]["coordonnee_x"], demo[indice]["coordonnee_y"]]).addTo(map)
                        .bindPopup("<a href='#' data-bs-toggle='modal' data-bs-target='#demo_"+ indice +"'  >"+ demo[indice]["titre"] +"</a>")
                        // .bindPopup(demo[indice]["titre"]+'<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#demo_'+indice +'">Launch demo modal </button>')
                        .openPopup();

                    var xmlhttp = new XMLHttpRequest();
                    xmlhttp.onreadystatechange = function() {
                        if (this.readyState == 4 && this.status == 200) {
                            console.log("test");
                            console.log(this.responseText);

                            //document.getElementById("txtHint").innerHTML = this.responseText;
                        }
                    };
                    xmlhttp.open("GET", "save.php?nb_clique=" + counterVal, true);
                    xmlhttp.send();
                }
                updateDisplay(counterVal);

            }

            // Fonction pour réinitialiser le compteur
            // Attacher les événements aux éléments

            document.getElementById('compteur').innerHTML =  counterVal;
            document.getElementById('demo').addEventListener('click', toucheClick);

        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    </body>
    </html>
<?php
