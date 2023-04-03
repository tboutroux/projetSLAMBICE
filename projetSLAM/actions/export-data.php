<?php

// Connexion à la base de données
$bdd = new PDO('mysql:host=' . Config::HOST . ';dbname=' . Config::DATABASE . ';charset=utf8', Config::USER, Config::PASSWORD);


// Vérifier si la connexion a réussi
if ($conn->connect_error) {
    die("La connexion a échoué: " . $conn->connect_error);
}

// Récupérer les informations de la base de données
$sql = "SELECT numero_materiel, denomination, categorie, nombre_utilisations, utilisations_limite, date_expiration, date_maintenance FROM materiel";
$result = $conn->query($sql);

// Vérifier si la requête a réussi
if ($result->num_rows > 0) {
    // Ouvrir le fichier CSV pour écrire les données
    $filename = "export.csv";
    $fp = fopen($filename, "w");

    // Écrire les en-têtes de colonnes dans le fichier CSV
    fputcsv($fp, array('Code barre', 'Dénomination', 'Catégorie', 'Nombre d\'utilisations', 'Utilisations limite', 'Date d\'expiration', 'Date de maintenance'));

    // Écrire les données des utilisateurs dans le fichier CSV
    while($row = $result->fetch_assoc()) {
        fputcsv($fp, $row);
    }

    // Fermer le fichier CSV
    fclose($fp);

    echo "Le fichier CSV a été créé avec succès!";
} else {
    echo "Aucun matériel trouvé dans la base de données.";
}

// Fermer la connexion à la base de données
$conn->close();

?>
