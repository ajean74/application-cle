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
    <script>
    function printDiv() {
        var divToPrint = document.getElementById('areaToPrint');
        newWin = window.open("");
        newWin.document.write(divToPrint.outerHTML);
        newWin.print();
        newWin.close();
    }
    </script>
    <title>Stock de Clés</title>
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
                        <a class="nav-link black" href="manager.php">Accueil</a>
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
                        <a class="nav-link active black" href="clestock.php">Stock</a>
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
        <form method="POST" action="clestock.php">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="col-lg-12 login-title">
                        Stock des clés en vente</br>
                    </div>

                    <!-- Creer un stock -->
                    <div class="ajout-button">
                        <a href="../Stock.php" class="btn btn-outline-primary">Ajouter un stock</a>
                    </div>
                    <div class="ajout2-button">
                        <input type="image" src="../image/print.png" width="45" height="39" onclick="printDiv()" />
                    </div>
                    
                    <!-- Affichage des types -->    
                    <div class="table-responsive" id="areaToPrint">
                        <table id="exemple" class="table table-bordered cell-border table-striped" style="width:95%">
                            <thead>

                                <!-- Tête du tableau -->
                                <tr class="bg-head-tableau">
                                    <th>N° Copro</th>
                                    <th>Nom Copro</th>
                                    <th>Intitulé</th>
                                    <th>Nombre de Clés</th>
                                    <th>Prix</th>
                                    <th>Agence</th>
                                    <th>Modifier</th>
                                    <th>Supprimer</th>
                                </tr>
                            </thead>

                            <tbody class="bg-tableau">

                                <!-- Corps du tableau -->
                                <?php
                                    $db = new PDO('mysql:host=clesgrn1.mysql.db;dbname=clesgrn1;charset=utf8mb4', 'clesgrn1', 'Grosset74');
                                    $data = $db->query("SELECT * FROM Stock")->fetchAll();
                                    $data4 = $db->query("SELECT * FROM Copropriete")->fetchAll();
                                    $data5 = $db->query("SELECT * FROM Agence")->fetchAll();

                                    foreach($data as $row){
                                        echo"<tr id='".$row['id']."' class='bg-tableau'>";
                                        foreach($data4 as $numcop){
                                            if($row['Copro'] == $numcop['id']){
                                                echo "<td class='black text-left'>".$numcop['NumCopro'];
                                            }
                                        }
                                        echo"</td><td class='black text-left'>";
                                        foreach($data4 as $nomcop){
                                            if($row['Copro'] == $nomcop['id']){
                                                echo $nomcop['NomCopro'];
                                            }
                                        }
                                        echo"</td><td class='black text-left'>".$row['Intitule']."</td><td class='black text-left'>".$row['Quantite']."</td><td class='black text-left'>".$row['Prix']."</td>";
                                        foreach($data5 as $agen){
                                            if($row['Agence'] == $agen['id']){
                                                echo "<td class='black text-left'>".$agen['Nom'];
                                            }
                                        }
                                        echo"</td>";

                                        echo"<td class='text-center'><a href='../Stock.php?update=".$row['id']."&cle=".$row['Quantite']."&int=".$row['Intitule']."&ncop=".$row['Copro']."&ag=".$row['Agence']."&prix=".$row['Prix']."'><img src='../image/Edit.png' width='30px'></a></td>";

                                        echo"<td class='text-center'><a href='clestock.php?delete=".$row['id']."'><img src='../image/Poubelle.png' width='30px'></a></td></tr>";


                                        /* --- Supprimer --- */
                                        if (isset($_GET['delete'])){
                                            echo '<div class="popup text-center" id="popup">
                                            <div class="body arrondi6 p-5">
                                            <h2>Êtes-vous sûre de vouloir supprimer cette clé ?</h2>
                                            <div class="form-group p-2 mt-4">
                                            <a href="clestock.php?delete='.$_GET['delete'].'&valider=1" class="btn btn-outline-primary mx-3" id="valider">Supprimer</a>
                                            <a href="clestock.php?delete='.$_GET['delete'].'&annuler=1" class="btn btn-outline-primary mx-3" id="annuler">Annuler</a>
                                            </div>
                                            </div>
                                            </div>';
                                            echo '<script src="../js/index.js"></script>';
                                            if(isset($_GET['valider'])){
                                                if($_GET['valider'] == 1){
                                                    $idUser = $_GET['delete'];
                                                    $db = new PDO('mysql:host=clesgrn1.mysql.db;dbname=clesgrn1;charset=utf8mb4', 'clesgrn1', 'Grosset74');
                                                    $stmt = $db->prepare("DELETE FROM Stock WHERE id = :idUserDelete");
                                                    $stmt->bindParam(':idUserDelete', $idUser);
                                                    $stmt->execute();
                                                    echo '<script type="text/javascript">document.getElementById("popup").remove();
                                                    window.location.replace("clestock.php");</script>';
                                                }
                                            }
                                            elseif(isset($_GET['annuler'])){
                                                if($_GET['annuler'] == 1){
                                                    echo '<script type="text/javascript">document.getElementById("popup").remove();
                                                    window.location.replace("clestock.php");</script>';
                                                }
                                            }
                                        }
                                    }
                                    ?>
                            </tbody>
                        </table><br>
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
