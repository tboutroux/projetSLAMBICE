<?php

// Connect to database
include("../config.php");

// Se connecter à la base de données
try {
    $pdo = new PDO('mysql:host=' . Config::HOST . ';dbname=' . Config::DATABASE . ';charset=utf8', Config::USER, Config::PASSWORD);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("La connexion a échoué : " . $e->getMessage());
}

$requeteDelete = $pdo->prepare('DELETE FROM materiel');
$requeteDelete->execute();

if (isset($_POST["submit"])) {

    $fileName = $_FILES["file"]["tmp_name"];

    if ($_FILES["file"]["size"] > 0) {

        $file = fopen($fileName, "r");

        $request = $pdo->prepare("INSERT INTO materiel (numero_materiel, denomination, categorie, nombre_utilisations, utilisations_limite, date_expiration, date_maintenance)
             VALUES (:numero_materiel, :denomination, :categorie, :nombre_utilisations, :utilisations_limite,:date_expiration,:date_maintenance)");

        while (($column = fgetcsv($file, null, ";")) !== FALSE) {

            // Vérifier que les indices existent dans le tableau $column
            $numero_materiel = isset($column[0]) ? $column[0] : '';
            $denomination = isset($column[1]) ? $column[1] : '';
            $categorie = isset($column[2]) ? $column[2] : '';
            $nb_utilisation = isset($column[3]) ? $column[3] : '';
            $utilisations_limite = isset($column[4]) ? $column[4] : '';
            $utilisations_limite = (int) $utilisations_limite;

            $date_peremption = isset($column[5]) ? $column[5] : '';
    
            if ($date_peremption != '') {
                $date_peremption = DateTime::createFromFormat('d/m/Y', $date_peremption);
                $date_peremption_formatted = $date_peremption->format('Y-m-d');
                echo $date_peremption_formatted;
            } else {
                $date_peremption_formatted = null;
            }

            $date_maintenance = isset($column[6]) ? $column[6] : '';
            
            if ($date_maintenance != '') {
                $date_maintenance = DateTime::createFromFormat('d/m/Y', $date_maintenance); // création de l'objet DateTime
                $date_maintenance_formatted = $date_maintenance->format('Y-m-d'); // formatage de la date pour MySQL
                echo $date_maintenance_formatted;
            } else {
                $date_maintenance_formatted = null;
            }

            var_dump($column);

            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $request->bindParam(':numero_materiel', $numero_materiel);
            $request->bindParam(':denomination', $denomination);
            $request->bindParam(':categorie', $categorie);
            $request->bindParam(':nombre_utilisations', $nb_utilisation);
            $request->bindParam(':utilisations_limite', $utilisations_limite);
            $request->bindParam(':date_expiration', $date_peremption_formatted);
            $request->bindParam(':date_maintenance', $date_maintenance_formatted);

            $request->execute();

            $rowCount = $request->rowCount();

            if ($rowCount > 0) {
                $type = "success";
                $message = "Les Données sont importées dans la base de données";
            } else {
                $type = "error";
                $message = "Problème lors de l'importation de données CSV";
            }
        }
    }
    // Fermer la connexion à la base de données
    $pdo = null;
    echo $message;
}
//Retourner à la page index.php
header('location:../hangar.php');