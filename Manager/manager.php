<?php
    session_start();
    if ($_SESSION['User'] == NULL) {
       header("Location: ../index.php");
    }
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../index.css">
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css">
    <script defer src='../js/index.js'></script>
    
    <title>Accueil</title>
</head>

<body class="body">

    <!-- Barre de navigation -->
    <nav class="navbar navbar-expand-lg navbar-primary bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand" href="manager.php"><img src="../image/logo.png" alt="logo" width="45" height="39" class="d-inline-block align-text-top"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <img src="../image/list.png" alt="list" width="45" height="39" class="d-inline-block align-text-top">
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav nav justify-content-end">
                    <li class="nav-item">
                        <?php $NomUser = $_SESSION['NomUser']; echo "<a class='nav-link active black' href='manager.php'>".$NomUser."</a>"; ?>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active black" href="manager.php">Accueil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link black" href="clecopro.php">Clé de Copropriétaires</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link black" href="clecommun.php">Clé des Communs</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link black" href="cletransaction.php">Clé de Transactions</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link black" href="clelocation.php">Clé de Locations</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link black" href="clevente.php">Vente de Clés</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link black" href="clestock.php">Stock</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link black" href="gestionCopro.php">Gestion des Copropriétés</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link black" href="../index.php">Déconnexion</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    

    <div class="container-fluid">
        <form method="POST" action="manager.php">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="col-lg-12 login-title">
                        Accueil
                    </div>
                    <div class="spacing-info">
                        <div class="text-center">
                            <?php $NomUser = $_SESSION['NomUser']; echo "<div class='login-title'>Bienvenue ".$NomUser." sur votre espace de gestion des clés.</div>
                            <div class='text-info'>Ici, vous pourrez gérer les clés afin de connaître leur disponibilité avec la possibilité de les sortir, de les rentrer et de les mettre en attente, vous pourrez ajouter de nouvelle clé ou encore en supprimés.
                            </div><br> 
                            <div class='d-flex justify-content-center flex-row'>
                                <div class='accueil-button'>
                                    <a href='clecopro.php' class='btn btn-outline-accueil'>Clé de Copropriétaires</a>
                                </div>
                                <div class='accueil-button'>
                                    <a href='clecommun.php' class='btn btn-outline-accueil'>Clé des Communs</a>
                                </div>
                            </div> 
                            <div class='d-flex justify-content-center flex-row'>
                                <div class='accueil-button'>
                                    <a href='cletransaction.php' class='btn btn-outline-accueil'>Clé de Transactions</a>
                                </div>
                                <div class='accueil-button'>
                                    <a href='clelocation.php' class='btn btn-outline-accueil'>Clé de Locations</a>
                                </div>
                            </div> 
                            <div class='accueil-button'>
                                <a href='clevente.php' class='btn btn-outline-accueil'>Vente de Clés</a>
                            </div><br>
                            <div class='text-info'>Seules les images avec comme extension PNG, JPG, JPEG, PDF seront accepté par le système.
                            </div><br>
                            <div class='text-info'>Pour toute demande, suggestion, problème à propos du site, merci de contacter Anthony par mail en cliquant <a class='black' href='mailto:nany.jean74@gmail.com'> ICI</a> .
                            </div>"
                            ?>
                        </div><br>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script src="../js/dataTable.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
  </body>
</html>
