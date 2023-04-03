<?php 

$title = "Résultat de la recherche";
include("header.php");

include("config.php");

$bdd = new PDO('mysql:host=' . Config::HOST . ';dbname=' . Config::DATABASE . ';charset=utf8', Config::USER, Config::PASSWORD);

$recherche = filter_input(INPUT_GET, 'header-search', FILTER_SANITIZE_STRING);

$request1 = "SELECT * FROM materiel LEFT JOIN vehicule ON materiel.id_vehicule = vehicule.id WHERE numero_materiel LIKE :recherche";

if ($bdd->prepare($request1)) {
    $requestMateriel = $bdd->prepare($request1);
}

$requestMateriel->bindParam(':recherche', $recherche);

$requestMateriel->execute();

$materiel = $requestMateriel->fetchAll();

?>

<h1 class="title"><?= $title ?></h1>


<div class="liste-materiel">

    <table class="table table-bordered">

    <tr>
        <th>Code barre</th>
        <th>Dénomination</th>
        <th>Catégorie</th>
        <th>Nombre d'utlisations</th>
        <th>Nombre d'utilisations limite</th>
        <th>Date d'expiration</th>
        <th>Date de maintenance</th>
        <th>Lieu de stockage</th>
    </tr>

    <?php foreach ($materiel as $m) {
        if ($m['id_vehicule'] == NULL){
            $m['nom'] = "Hangar";
        }
    ?>
        
        <tr>
            <td><span class="numero_materiel"><?= $m['numero_materiel'] ?></span></td>
            <td><?= $m['denomination'] ?></td>
            <td><?= $m['categorie'] ?></td>
            <td><?= $m['nombre_utilisations'] ?></td>
            <td><?= $m['utilisations_limite'] ?></td>
            <td><?= $m['date_expiration'] ?></td>
            <td><?= $m['date_maintenance'] ?></td>
            <td><?= $m['nom'] ?></td>
        </tr>
    <?php
        }
    ?>


    </table>

</div>