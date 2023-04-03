<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css" type="text/css">
    <link rel="shortcut icon" href="pictures/casque-de-pompier.png" type="image/x-icon">
    <script src="script.js" defer></script>
    <script src="https://kit.fontawesome.com/7c568e5098.js" crossorigin="anonymous" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous" defer></script>
    <title><?= $title ?></title>
</head>
<body>
    
<header>
    <div class="wrapper">
        <div class="wrapper-left">
            <a href="index.php">
                <img src="pictures/casque-de-pompier.png" alt="Icône" class="header-icon">
            </a>
        </div>

        <div class="wrapper-center">
            <h1>B.I.C.E</h1>
        </div>

        <div class="wrapper-right">
            <div class="search-bar">
                <form action="recherche.php" class="search-form">
                    <input type="text" placeholder="Rechercher..." name="header-search">
                    <button type="submit">
                        <div>
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </div> 
                    </button>
                </form>
            </div>
        </div>

    </div>
</header>

<div class="container-fluid">