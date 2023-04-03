<?php

include('../config.php');

$bdd = new PDO('mysql:host=' . Config::HOST . ';dbname=' . Config::DATABASE . ';charset=utf8', Config::USER, Config::PASSWORD);

$numero_materiel = filter_input(INPUT_GET, 'numero_materiel', FILTER_SANITIZE_NUMBER_INT);

var_dump($numero_materiel);

$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$requestUpdateMateriel = $bdd->prepare('UPDATE materiel SET id_vehicule = NULL WHERE numero_materiel = :numero_materiel');
$requestUpdateMateriel->bindParam(':numero_materiel', $numero_materiel);

$requestUpdateMateriel->execute();

header('Location: ../vehicules.php');
