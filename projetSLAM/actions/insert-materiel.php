<?php

session_start();

include('../config.php');

$bdd = new PDO('mysql:host=' . Config::HOST . ';dbname=' . Config::DATABASE . ';charset=utf8', Config::USER, Config::PASSWORD);

$id = filter_input(INPUT_GET, 'id_vehicule', FILTER_SANITIZE_NUMBER_INT);
$numero_materiel = filter_input(INPUT_GET, 'numero_materiel', FILTER_SANITIZE_NUMBER_INT);

echo $id;
echo $numero_materiel;

$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$requestUpdateMateriel = $bdd->prepare('UPDATE materiel SET id_vehicule = :id_vehicule WHERE numero_materiel = :numero_materiel');
$requestUpdateMateriel->bindParam(':id_vehicule', $id, PDO::PARAM_INT);
$requestUpdateMateriel->bindParam(':numero_materiel', $numero_materiel, PDO::PARAM_INT);
$requestUpdateMateriel->execute();

header('Location: ../vehicules.php');
