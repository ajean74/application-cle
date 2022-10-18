<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../index.css"/>

    <title>Ajouter le stock</title>
</head>

<body class="body">
    <div class="text-center container-fluid">
        <div class="col-lg-3 col-md-2"></div>
        <div class="container">
            <form class="box-update2 arrondi2"  action="<?php echo isset($_GET['update']) ? '' : 'Stock.php' ?>" method="POST" enctype="multipart/form-data" id="myForm">
                <script type="text/javascript">
                    myForm.addEventListener("keydown", function(e){if (e.keyCode==13) e.preventDefault()} );
                </script>
                <div class="row mx-5 my-3 justify-content-center">
                    <!-- Formulaire -->
                    <div class="col-md-4 p-4">
                        <h5>Quantité de clés :</h5>
                        <input type="text" class="form-control" id="cle" name="cle" value="<?php echo isset($_GET['cle']) ? $_GET['cle'] : '';?>">
                    </div>
                    <div class="col-md-4 p-4">
                        <h5>N° de Copro + Intitulé :</h5>
                        <input type="text" class="form-control" id="int" name="int" value="<?php echo isset($_GET['int']) ? $_GET['int'] : '';?>">
                    </div>
                    <div class="col-md-4 p-4">
                        <h5>Prix :</h5>
                        <input type="text" class="form-control" id="prix" name="prix" value="<?php echo isset($_GET['prix']) ? $_GET['prix'] : '';?>">
                    </div>
                </div>
                <div class="row mx-5 my-3 justify-content-center">
                    <div class="col-md-4 p-4">
                        <h5>Agence :</h5>
                        <select class="btn btn-outline-primary" id="agence" name="agence">
                            <?php                         
                                $db = new PDO('mysql:host=clesgrn1.mysql.db;dbname=clesgrn1;charset=utf8mb4', 'clesgrn1', 'Grosset74');
                                $ag = $db->query("SELECT * FROM Agence")->fetchAll();
                                foreach($ag as $data){
                                    if(isset($_GET['ag'])){
                                        if($_GET['ag'] == $data["id"]){
                                            echo'<option selected value="'. $data['id']. '">'.$data["Nom"]."</option>";
                                        }
                                        echo'<option value="'. $data['id']. '">'.$data["Nom"]."</option>";
                                    }
                                    else{
                                        echo'<option value="'. $data['id']. '">'.$data["Nom"]."</option>";
                                    }
                                }
                            ?>
                        </select>
                    </div>
                    <div class="col-md-4 p-4">
                        <h5>Nom de la copropriété :</h5>
                        <select class="btn btn-outline-primary" id="copro" name="copro">
                            <?php
                                session_start();
                                if ($_SESSION['User'] == NULL) {
                                    header("Location: index.php");
                                }                                
                                $db = new PDO('mysql:host=clesgrn1.mysql.db;dbname=clesgrn1;charset=utf8mb4', 'clesgrn1', 'Grosset74');
                                $ncop = $db->query("SELECT * FROM Copropriete")->fetchAll();
                                foreach($ncop as $data0){
                                    if(isset($_GET['ncop'])){
                                        if($_GET['ncop'] == $data0["id"]){
                                            echo'<option selected value="'. $data0['id']. '">'.$data0["NomCopro"]."</option>";
                                        }
                                        echo'<option value="'. $data0['id']. '">'.$data0["NomCopro"]."</option>";
                                    }
                                    else{
                                        echo'<option value="'. $data0['id']. '">'.$data0["NomCopro"]."</option>";
                                    }
                                }
                            ?>
                        </select>
                    </div>
                </div>
            
                <div class="form-group p-5">
                    <input type="submit" onsubmit="return false;" class="btn btn-outline-primary" value="Valider" id="valider" name="valider">
                    <input type="submit" class="btn btn-outline-primary" value="Annuler" id="annuler" name="annuler">
                </div>
                
                <?php
                    if(isset($_POST['valider'])){
                        $cle= $_POST['cle'];
                        $int= $_POST['int'];
                        $prix= $_POST['prix'];
                        $ncop= $_POST['copro'];
                        $ag= $_POST['agence'];
                            
                        $db = new PDO('mysql:host=clesgrn1.mysql.db;dbname=clesgrn1;charset=utf8mb4', 'clesgrn1', 'Grosset74');

                        /* -- Modifier -- */
                        if(isset($_GET['update'])){
                            $id = $_GET['update'];
                            if($_GET['cle'] != $cle){
                                $stmt = $db->prepare("UPDATE Stock SET Quantite = :_numcle WHERE id= :_id;");
                                $stmt->bindParam(':_numcle', $cle);
                                $stmt->bindParam(':_id', $id);
                                $stmt->execute();
                            }
                            if($_GET['int'] != $int){
                                $stmt = $db->prepare("UPDATE Stock SET Intitule = :_int WHERE id= :_id;");
                                $stmt->bindParam(':_int', $int);
                                $stmt->bindParam(':_id', $id);
                                $stmt->execute();
                            }
                            if($_GET['ncop'] != $ncop){
                                $stmt = $db->prepare("UPDATE Stock SET Copro = :_copro WHERE id= :_id;");
                                $stmt->bindParam(':_copro', $ncop);
                                $stmt->bindParam(':_id', $id);
                                $stmt->execute();
                            }
                            if($_GET['ag'] != $ag){
                                $stmt = $db->prepare("UPDATE Stock SET Agence = :_agence WHERE id= :_id;");
                                $stmt->bindParam(':_agence', $ag);
                                $stmt->bindParam(':_id', $id);
                                $stmt->execute();
                            }
                            if($_GET['prix'] != $prix){
                                $stmt = $db->prepare("UPDATE Stock SET Prix = :_prix WHERE id= :_id;");
                                $stmt->bindParam(':_prix', $prix);
                                $stmt->bindParam(':_id', $id);
                                $stmt->execute();
                            }
                        }

                            

                        /* -- Creer -- */
                        else{
                            $stmt = $db->prepare("INSERT INTO Stock(Copro, Quantite, Intitule, Agence, Prix) VALUES (:copro, :quantite, :inti, :agence, :prix);");
                            $stmt->bindParam(':quantite', $cle);
                            $stmt->bindParam(':copro', $ncop);
                            $stmt->bindParam(':inti', $int);
                            $stmt->bindParam(':agence', $ag);
                            $stmt->bindParam(':prix', $prix);
                            $stmt->execute();
                        }

                        /* -- Redirection -- */
                        if(isset($_GET['update'])){
                            echo '<script type="text/javascript">window.location.replace("Manager/clestock.php");</script>';
                        }
                        else{
                            echo '<script type="text/javascript">window.location.replace("Manager/clestock.php");</script>';
                        }
                    }
                    if(isset($_POST['annuler'])){
                        if(isset($_GET['update'])){
                            echo '<script type="text/javascript">window.location.replace("Manager/clestock.php");</script>';
                        }
                        else{
                            echo '<script type="text/javascript">window.location.replace("Manager/clestock.php");</script>';
                        }
                    }
                ?>    
            </form>
        </div>
        <div class="col-lg-3 col-md-2"></div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
</body>
</html>