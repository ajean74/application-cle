<?php
session_start();  
if ($_SESSION['User'] == NULL) {
    header("Location: index.php");
} 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../index.css"/>

    <title>Sortir une clé</title>
</head>

<body class="body">
    <div class="text-center container-fluid">
        <div class="col-lg-3 col-md-2"></div>
        <div class="container">
            <form class="box-update2 arrondi2"  action="<?php echo isset($_GET['update']) ? '' : 'sortir2.php' ?>" method="POST" enctype="multipart/form-data" id="myForm">
                <script type="text/javascript">
                    myForm.addEventListener("keydown", function(e){if (e.keyCode==13) e.preventDefault()} );
                </script>
                <div class="row mx-5 my-3 justify-content-center">

                    <!-- Formulaire -->
                    <div class="col-md-4 p-4">
                        <h5>Nom de la personne :</h5>
                        <input type="text" class="form-control" id="nmpersonne" name="nmpersonne">
                    </div>
                    <div class="col-md-4 p-4">
                        <h5>Contact(Mail et/ou Téléphone) :</h5>
                        <input type="text" class="form-control" id="contact" name="contact">
                    </div>
                </div>
                <div class="row mx-5 justify-content-center">
                    <div class="col-md-4 p-4">
                        <h5>Date de sortie :</h5>
                        <input id="date" class="form-control" type="datetime-local" name="date" value="" readonly>
                        <script>
                            var myField = document.getElementById("date");
                            var now = new Date();
                            myField.valueAsNumber = now.getTime() - now.getTimezoneOffset() * 60000;
                        </script>
                    </div>
                    <div class="col-md-4 p-4">
                        <h5>Date de retour:</h5>
                        <div>
                            <input type="checkbox" id="definitif" name="definitif">
                            <label for="definitif">Sortie définitive</label>
                        </div>
                        <input id="dateRetour" class="form-control" type="date" name="dateRetour">
                    </div>
                </div>
            
                <div class="form-group p-5">
                    <div>
                        <div>
                            <h5>Note :</h5>
                            <textarea class="bordur" id="note" name="note" rows="5" cols="25" maxlength="70"></textarea>
                        </div>
                    </div>
                    <input type="submit" onsubmit="return false;" class="btn btn-outline-primary" value="Valider" id="valider" name="valider">
                    <input type="submit" class="btn btn-outline-primary" value="Annuler" id="annuler" name="annuler">
                </div>
                
                <?php
                if(isset($_POST['valider'])){
                    $nmpers= $_POST['nmpersonne'];
                    $date= $_POST['date'];
                    $dateRetour= $_POST['dateRetour'];
                    $contact= $_POST['contact'];
                    $nmcoll= $_SESSION['idNom'];
                    $note= $_POST['note'];
                    $statut=2;
                            
                    $db = new PDO('mysql:host=clesgrn1.mysql.db;dbname=clesgrn1;charset=utf8mb4', 'clesgrn1', 'Grosset74');

                        /* -- Modifier -- */
                    if(isset($_GET['update'])){
                        $id = $_GET['update'];
                        $stmt = $db->prepare("UPDATE CleCommun SET NomPersonne = :_nmpersonne WHERE id= :_id;");
                        $stmt->bindParam(':_nmpersonne', $nmpers);
                        $stmt->bindParam(':_id', $id);
                        $stmt->execute();
                        
                        $stmt = $db->prepare("UPDATE CleCommun SET Date = :_date WHERE id= :_id;");
                        $stmt->bindParam(':_date', $date);
                        $stmt->bindParam(':_id', $id);
                        $stmt->execute();
                        
                        $stmt = $db->prepare("UPDATE CleCommun SET Contact = :_contact WHERE id= :_id;");
                        $stmt->bindParam(':_contact', $contact);
                        $stmt->bindParam(':_id', $id);
                        $stmt->execute();
                        
                        $stmt = $db->prepare("UPDATE CleCommun SET Etat = :_statut WHERE id= :_id;");
                        $stmt->bindParam(':_statut', $statut);
                        $stmt->bindParam(':_id', $id);
                        $stmt->execute();

                        $stmt = $db->prepare("UPDATE CleCommun SET Note = :_note WHERE id= :_id;");
                        $stmt->bindParam(':_note', $note);
                        $stmt->bindParam(':_id', $id);
                        $stmt->execute();

                        $stmt = $db->prepare("UPDATE CleCommun SET Utilisateur = :_nmcollabo WHERE id= :_id;");
                        $stmt->bindParam(':_nmcollabo', $nmcoll);
                        $stmt->bindParam(':_id', $id);
                        $stmt->execute();

                        if(isset($_POST['definitif'])){
                            $dateRetour= "Sortie définitive";
                            $stmt = $db->prepare("UPDATE CleCommun SET DateRetour = :_dateRetour WHERE id= :_id;");
                            $stmt->bindParam(':_dateRetour', $dateRetour);
                            $stmt->bindParam(':_id', $id);
                            $stmt->execute();
                        }
                        else{
                            $stmt = $db->prepare("UPDATE CleCommun SET DateRetour = :_dateRetour WHERE id= :_id;");
                            $stmt->bindParam(':_dateRetour', $dateRetour);
                            $stmt->bindParam(':_id', $id);
                            $stmt->execute();
                        }

                        $stmt = $db->prepare("INSERT INTO Historique(Libelle, Etat, NomPersonne, Date, Contact) VALUES (:libelle, :etat, :nom, :date, :contact);");
                        $stmt->bindParam(':libelle', $_GET['NumCle']);
                        $stmt->bindParam(':etat', $statut);
                        $stmt->bindParam(':nom', $nmpers);
                        $stmt->bindParam(':date', $date);
                        $stmt->bindParam(':contact', $contact);
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