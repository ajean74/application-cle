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
    <title>Historique</title>
</head>

<body class="body">
    
    <div class="container-fluid">
        <form method="POST" action="Historique.php">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="col-lg-12 login-title">
                        Historique de la clé <?php echo $_GET['cle'];?>
                    </div>

                    <div class="ajout-button">
                        <a href="Manager/manager.php" class="btn btn-outline-primary">Revenir</a>
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
                                    <th>Date</th>
                                    <th>Etat</th>
                                    <th>Client</th>
                                    <th>Contact</th>
                                </tr>
                            </thead>

                            <tbody class="bg-tableau">

                                <!-- Corps du tableau -->
                                <?php
                                    $db = new PDO('mysql:host=clesgrn1.mysql.db;dbname=clesgrn1;charset=utf8mb4', 'clesgrn1', 'Grosset74');
                                    $idhisto = strval($_GET['cle']);
                                    $data = $db->query("SELECT * FROM Historique WHERE Libelle = $idhisto")->fetchAll();
                                    $data4 = $db->query("SELECT * FROM Etat")->fetchAll();

                                    foreach($data as $row){
                                        echo"<tr id='".$row['id']."' class='bg-tableau'><td class='black text-left'>".$row['Date']."</td>";
                                        foreach($data4 as $etat){
                                            if($row['Etat'] == $etat['id']){
                                                echo "<td class='black text-left'>".$etat['NomEtat'];
                                            }
                                        }
                                        echo"</td><td class='black text-left'>".$row['NomPersonne']."</td><td class='black text-left'>".$row['Contact']."</td></tr>";

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
