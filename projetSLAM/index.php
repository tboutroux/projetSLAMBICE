<?php
$title = "Accueil";
include "header.php";

?>

<h1 class="title"><?= $title ?></h1>

<div class="container-fluid" style="width: 80%;">

    <div class="row home-page" style="gap:5vw; justify-content: space-between;">
        <div class="card col-sm-3" style="height: 40vh;" id="card1">
            <h2>Gestion du stock</h2>
        </div>
        <div class="card col-sm-3" style="height: 40vh;" id="card2">
            <h2>Gestion des véhicules</h2>
        </div>
        <div class="card col-sm-3" style="height: 40vh;" id="card3">
            <h2>Retour d’intervention</h2>
        </div>
    </div>

    <div class="row" style="justify-content: center;margin-top:5vh">
        <div class="card col-sm" style="height: 20vh;" id="card4">
            <h2>Historique</h2>
        </div>
    </div>

</div>

</table>
<?php
include "footer.php";