<?php
$title = "Véhicules";
include "header.php";

include "config.php";

$bdd = new PDO('mysql:host=' . Config::HOST . ';dbname=' . Config::DATABASE . ';charset=utf8', Config::USER, Config::PASSWORD);

$requestVehicules = $bdd->prepare('SELECT * FROM vehicule');
$requestVehicules->execute();
$vehicules = $requestVehicules->fetchAll();

?>

<h1 class="title"><?= $title ?></h1>

<div class="liste-vehicule">

    <h2 class="subtitle">Ajouter un véhicule</h2>

    <form action=" actions/add-vehicule.php" method="post" class="add-vehicule">
        <div class="input-group">
            <input type="text" class="form-control" placeholder="Nom du véhicule" name="nom" required>
            <span class="input-group-text">Le nom du véhicule</span>
        </div>
        <div class="input-group">
            <input type="text" class="form-control" placeholder="Marque du véhicule" name="marque" required>
            <span class="input-group-text">La marque du véhicule</span>
        </div>
        <div class="input-group">
            <input type="text" class="form-control" placeholder="Immatriculation du véhicule" name="immatriculation" required>
            <span class="input-group-text">L'immatriculation du véhicule</span>
        </div>
        <button type="submit" class="btn ajout-vehicule">Ajouter un véhicule</button>
    </form>

    <h2 class="subtitle">Liste des véhicules</h2>

    <?php

    foreach ($vehicules as $v) {?>
        <details open="true">
            <summary><?= $v['nom'] ?></summary>
            <ul>
                <li>Marque : <?= $v['marque'] ?></li>
                <li>Immatriculation : <?= $v['immatriculation'] ?></li>
            </ul>

            <h4>Liste du matériel dans le véhicule</h4>

            <table class="table-bordered">
                <tr>
                    <th>Code Barre</th>
                    <th>Nomination</th>
                    <th>Catégorie</th>
                    <th>Nombre d'utilisations</th>
                    <th>Nombre d'utilisations limite</th>
                    <th>Date d'expiration</th>
                    <th>Date de maintenance</th>
                    <th>Supprimer</th>
                </tr>
            

            <?php 
            
            $id_vehicule = $v['id'];
            $requestMateriel = $bdd->prepare('SELECT * FROM materiel WHERE id_vehicule = :id_vehicule');
            $requestMateriel->bindParam(':id_vehicule', $id_vehicule);
            $requestMateriel->execute();
            $materiel = $requestMateriel->fetchAll();

            foreach ($materiel as $m) { ?>

                <tr>
                    <td><?= $m["numero_materiel"] ?></td>
                    <td><?= $m["denomination"] ?></td>
                    <td><?= $m["categorie"] ?></td>
                    <td><?= $m["nombre_utilisations"] ?></td>
                    <td><?= $m["utilisations_limite"] ?></td>
                    <td><?= $m["date_expiration"] ?></td>
                    <td><?= $m["date_maintenance"] ?></td>
                    <td>
                        <a href="actions/delete_materiel.php?numero_materiel=<?= $m["numero_materiel"] ?>" class="btn-supprimer"><i class="fa-solid fa-trash"></i></a>
                    </td>
                </tr>
            <?php } ?>

            </table>

            <div class="form-ajout-materiel">
                <form action="actions/insert-materiel.php?id=<?= $v["id"] ?>" id="form-ajout-materiel">
                    <div class="input-group">
                        <input type="number" class="form-control" placeholder="Code barre du matériel" name="numero_materiel" maxlength="8" required>
                        <input type="hidden" name="id_vehicule" value="<?= $v['id'] ?>">
                        <span class="input-group-text">Le code barre</span>
                    </div>
                    <button type="submit" class="btn ajout-materiel">Ajouter du matériel</button>
                </form>
            </div>

        </details>
    <?php } ?>
</div>

<?php
include "footer.php";