<?php
$title = 'Gestion du matériel';
include "header.php";

include "config.php";

$bdd = new PDO('mysql:host=' . Config::HOST . ';dbname=' . Config::DATABASE . ';charset=utf8', Config::USER, Config::PASSWORD);

$requete = $bdd->prepare("SELECT * FROM materiel");
$requete->execute();
$materiel = $requete->fetchAll();


?>

<h1 class="title"><?= $title ?></h1>

<div class="add-CSV-file">
    <form action="actions/insert-data.php" method="post" enctype="multipart/form-data">
        <div class="input-group">
            <input type="file" class="form-control" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04" aria-label="Upload" name="file" accept=".csv" >
            <button class="btn btn-outline-secondary" type="submit" id="inputGroupFileAddon04" name="submit">Importer le fichier</button>
        </div>
    </form>
</div>

<div class="liste-materiel">

    <table class="table table-bordered" style="text-align:center;">

    <tr>
        <th>Code barre</th>
        <th>Dénomination</th>
        <th>Catégorie</th>
        <th>Nombre d'utlisations</th>
        <th>Nombre d'utilisations limite</th>
        <th>Date d'expiration</th>
        <th>Date de maintenance</th>
    </tr>

    <?php foreach ($materiel as $m) {?>
        <tr>
            <td><span class="numero_materiel"><?= $m['numero_materiel'] ?></span></td>
            <td><?= $m['denomination'] ?></td>
            <td><?= $m['categorie'] ?></td>
            <td><?= $m['nombre_utilisations'] ?></td>
            <td><?= $m['utilisations_limite'] ?></td>
            <td><?= $m['date_expiration'] ?></td>
            <td><?= $m['date_maintenance'] ?></td>
        </tr>
    <?php
        }
    ?>


    </table>

</div>

<?php
include "footer.php";