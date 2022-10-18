<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../index.css"/>

    <title>Copropriété</title>
</head>
<body class="body">
    <div class="text-center">
        <div class="col-lg-3 col-md-2"></div>
        <div class="container">
            <form class="box-update arrondi3"  action="<?php echo isset($_GET['update']) ? '' : 'Copropriete.php' ?>" method="POST" id="myForm">
                <script type="text/javascript">
                    myForm.addEventListener("keydown", function(e){if (e.keyCode==13) e.preventDefault()} );
                </script>
                <div class="row mx-4 my-3 justify-content-center">

                    <!-- Formulaire -->
                    <div class="col-md-4 p-4">
                        <h5>N° de la copropriété:</h5>
                        <input type="text" class="form-control" id="num" name="num" value="<?php echo isset($_GET['num']) ? $_GET['num'] : '' ?>">
                    </div>
                    <div class="col-md-4 p-4">
                        <h5>Nom de la copropriété:</h5>
                        <input type="text" class="form-control" id="nom" name="nom" value="<?php echo isset($_GET['nom']) ? $_GET['nom'] : '' ?>">
                    </div>
                </div>
                <div class="row mt-4 mb-3 justify-content-center">
                    <div class="mb-4">
                        <input type="submit" class="btn-outline-primary btn" value="Valider" id="valider" name="valider">
                        <input type="submit" class="btn btn-outline-primary" value="Annuler" id="annuler" name="annuler">
                    </div>
                </div>
                
                <?php
                session_start(); 
                if ($_SESSION['User'] == NULL) {
                    header("Location: index.php");
                }      
                    if(isset($_POST['valider'])){
                        $num= $_POST['num']; 
                        $nom= $_POST['nom']; 
                        $db = new PDO('mysql:host=clesgrn1.mysql.db;dbname=clesgrn1;charset=utf8mb4', 'clesgrn1', 'Grosset74');
                        
                        /* -- Modifier -- */
                        if(isset($_GET['update'])){
                            $id = $_GET['update'];
                            if($_GET['num'] != $num){
                                $stmt = $db->prepare("UPDATE Copropriete SET NumCopro = :_ident WHERE id= :_id;");
                                $stmt->bindParam(':_ident', $num);
                                $stmt->bindParam(':_id', $id);
                                $stmt->execute();
                            }
                            if($_GET['nom'] != $nom){
                                $stmt = $db->prepare("UPDATE Copropriete SET NomCopro = :_intitule WHERE id= :_id;");
                                $stmt->bindParam(':_intitule', $nom);
                                $stmt->bindParam(':_id', $id);
                                $stmt->execute();
                            }
                        }

                        /* -- Creer -- */
                        else{
                            $stmt = $db->prepare("INSERT INTO Copropriete(NumCopro, NomCopro) VALUES (:num, :nom);");
                            $stmt->bindParam(':num', $num);
                            $stmt->bindParam(':nom', $nom);
                            $stmt->execute();
                        }

                        /* -- Redirection -- */
                        if(isset($_GET['update'])){
                            echo '<script type="text/javascript">window.location.replace("Manager/gestionCopro.php");</script>';
                        }
                        else{
                            echo '<script type="text/javascript">window.location.replace("Manager/gestionCopro.php");</script>';
                        }
                    }
                    if(isset($_POST['annuler'])){
                        if(isset($_GET['update'])){
                            echo '<script type="text/javascript">window.location.replace("Manager/gestionCopro.php");</script>';
                        }
                        else{
                            echo '<script type="text/javascript">window.location.replace("Manager/gestionCopro.php");</script>';
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