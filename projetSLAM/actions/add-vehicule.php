<?php

$nom = filter_input(INPUT_POST, 'nom',);
$marque = filter_input(INPUT_POST, 'marque',);
$immatriculation = filter_input(INPUT_POST, 'immatriculation',);

include "../config.php";

$bdd = new PDO('mysql:host=' . Config::HOST . ';dbname=' . Config::DATABASE . ';charset=utf8', Config::USER, Config::PASSWORD);

$request = $bdd->prepare('INSERT INTO vehicule (nom, marque, immatriculation) 
                          VALUES (:nom, :marque, :immatriculation)');

$request->bindParam(':nom', $nom);
$request->bindParam(':marque', $marque);
$request->bindParam(':immatriculation', $immatriculation);

echo $nom;
echo $marque;
echo $immatriculation;

$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$request->execute();

header('Location: ../vehicules.php');

?>