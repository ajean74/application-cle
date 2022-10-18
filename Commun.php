<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../index.css"/>

    <title>Modifier la clé</title>
</head>

<body class="body">
    <div class="text-center container-fluid">
        <div class="col-lg-3 col-md-2"></div>
        <div class="container">
            <form class="box-update arrondi2"  action="<?php echo isset($_GET['update']) ? '' : 'Commun.php' ?>" method="POST" enctype="multipart/form-data" id="myForm">
                <script type="text/javascript">
                    myForm.addEventListener("keydown", function(e){if (e.keyCode==13) e.preventDefault()} );
                </script>
                <div class="row mx-5 my-3 justify-content-center">

                    <!-- Formulaire -->
                    <div class="col-md-4 p-4">
                        <h5>Intitulé de la clé :</h5>
                        <input type="text" class="form-control" id="nomcle" name="nomcle" value="<?php echo isset($_GET['cle']) ? $_GET['cle'] : '';?>">
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
                                foreach($ncop as $data2){
                                    if(isset($_GET['ncop'])){
                                        if($_GET['ncop'] == $data2["id"]){
                                            echo'<option selected value="'. $data2['id']. '">'.$data2["NomCopro"]."</option>";
                                        }
                                        echo'<option value="'. $data2['id']. '">'.$data2["NomCopro"]."</option>";
                                    }
                                    else{
                                        echo'<option value="'. $data2['id']. '">'.$data2["NomCopro"]."</option>";
                                    }
                                }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="row mx-5 justify-content-center">
                    <div class="col-md-6 p-4">
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
                    <div class="form-group col-md-5">
                        <h5>Photo :</h5>
                        <input type="file" class="btn btn-outline-primary" id="pj" name="pj" value="<?php echo isset($_GET['pj']) ? $_GET['pj'] : '' ?>">
                    </div>
                </div>
            
                <div class="form-group p-5">
                    <input type="submit" onsubmit="return false;" class="btn btn-outline-primary" value="Valider" id="valider" name="valider">
                    <input type="submit" class="btn btn-outline-primary" value="Annuler" id="annuler" name="annuler">
                </div>
                
                <?php
                    if(isset($_POST['valider'])){
                        $cle= $_POST['nomcle'];
                        $ncop= $_POST['copro'];
                        $ag= $_POST['agence'];
                        $oldpj = $_GET['pj'];
                        $sta = 1;

                        /* -- Fichier --*/
                        if(!empty($_FILES)) {
                            $file_name = $_FILES['pj']['name'];
                            $file_tmp_name = $_FILES['pj']['tmp_name'];
                            $file_dest = 'files/'.$file_name;
                            $file_error = $_FILES['pj']['error'];
                            $file_extension = strrchr($file_name, ".");
                            $extension_autorisees = array('.jpg','.jpeg','.pdf','.png','.JPG','.JPEG','.PDF','.PNG');
                            if (in_array($file_extension, $extension_autorisees)) {
                                if ($file_error == 0) {
                                    if (move_uploaded_file($file_tmp_name, $file_dest)) {
                                        $newpj= $file_dest;
                                    } else {
                                        $newpj= NULL;
                                    }
                                } else {
                                    $newpj= NULL;
                                }
                            }                        
                        }
                            
                        $db = new PDO('mysql:host=clesgrn1.mysql.db;dbname=clesgrn1;charset=utf8mb4', 'clesgrn1', 'Grosset74');

                        /* -- Modifier -- */
                        if(isset($_GET['update'])){
                            $id = $_GET['update'];
                            if($_GET['cle'] != $cle){
                                $stmt = $db->prepare("UPDATE CleCommun SET Intitule = :_nomcle WHERE id= :_id;");
                                $stmt->bindParam(':_nomcle', $cle);
                                $stmt->bindParam(':_id', $id);
                                $stmt->execute();
                            }
                            if($_GET['ncop'] != $ncop){
                                $stmt = $db->prepare("UPDATE CleCommun SET Copro = :_copro WHERE id= :_id;");
                                $stmt->bindParam(':_copro', $ncop);
                                $stmt->bindParam(':_id', $id);
                                $stmt->execute();
                            }
                            if($_GET['ag'] != $ag){
                                $stmt = $db->prepare("UPDATE CleCommun SET Agence = :_agence WHERE id= :_id;");
                                $stmt->bindParam(':_agence', $ag);
                                $stmt->bindParam(':_id', $id);
                                $stmt->execute();
                            }
                            if($oldpj != $newpj AND $newpj != NULL) {
                                $pj = $newpj;
                                $stmt = $db->prepare("UPDATE CleCommun SET Photo = :_pj WHERE id= :_id;");
                                $stmt->bindParam(':_pj', $pj);
                                $stmt->bindParam(':_id', $id);
                                $stmt->execute();
                            } elseif($oldpj != $newpj AND $newpj == NULL) {
                                $pj = $oldpj;
                                $stmt = $db->prepare("UPDATE CleCommun SET Photo = :_pj WHERE id= :_id;");
                                $stmt->bindParam(':_pj', $pj);
                                $stmt->bindParam(':_id', $id);
                                $stmt->execute();
                            } 
                        }

                        /* -- Creer -- */
                        else{
                            $stmt = $db->prepare("INSERT INTO CleCommun(Intitule, Copro, Agence, Etat, Photo) VALUES (:nomcle, :copro, :agence, :status, :pj);");
                            $stmt->bindParam(':nomcle', $cle);
                            $stmt->bindParam(':copro', $ncop);
                            $stmt->bindParam(':agence', $ag);
                            $stmt->bindParam(':status', $sta);
                            $stmt->bindParam(':pj', $newpj);
                            $stmt->execute();
                        }

                        /* -- Redirection -- */
                        if(isset($_GET['update'])){
                            echo '<script type="text/javascript">window.location.replace("Manager/clecommun.php");</script>';
                        }
                        else{
                            echo '<script type="text/javascript">window.location.replace("Manager/clecommun.php");</script>';
                        }
                    }
                    if(isset($_POST['annuler'])){
                        if(isset($_GET['update'])){
                            echo '<script type="text/javascript">window.location.replace("Manager/clecommun.php");</script>';
                        }
                        else{
                            echo '<script type="text/javascript">window.location.replace("Manager/clecommun.php");</script>';
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