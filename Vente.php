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

    <title>Ajouter la clé</title>
</head>

<body class="body">
    <div class="text-center container-fluid">
        <div class="col-lg-3 col-md-2"></div>
        <div class="container">
            <form class="box-update2 arrondi2"  action="<?php echo isset($_GET['update']) ? '' : 'Vente.php' ?>" method="POST" enctype="multipart/form-data" id="myForm">
                <script type="text/javascript">
                    myForm.addEventListener("keydown", function(e){if (e.keyCode==13) e.preventDefault()} );
                </script>
                <div class="row mx-5 my-3 justify-content-center">
                    <!-- Formulaire -->
                    <div class="col-md-4 p-4">
                        <h5>Quantité de clés :</h5>
                        <input type="number" class="form-control" id="cle" name="cle" value="<?php echo isset($_GET['cle']) ? $_GET['cle'] : '';?>">
                    </div>
                    <div class="col-md-4 p-4">
                        <h5>Client :</h5>
                        <input type="text" class="form-control" id="client" name="client" value="<?php echo isset($_GET['cl']) ? $_GET['cl'] : '';?>">
                    </div>
                    <div class="col-md-4 p-4">
                        <h5>Contact(Téléphone) :</h5>
                        <input type="text" class="form-control" id="contact" name="contact" value="<?php echo isset($_GET['contact']) ? $_GET['contact'] : '';?>">
                    </div>
                    <div class="col-md-4 p-4">
                        <h5>Mail :</h5>
                        <input type="text" class="form-control" id="mail" name="mail" value="<?php echo isset($_GET['mail']) ? $_GET['mail'] : '';?>">
                    </div>
                    <div class="col-md-4 p-4">
                        <h5>N° de clé/badge :</h5>
                        <input type="text" class="form-control" id="num" name="num" value="<?php echo isset($_GET['num']) ? $_GET['num'] : '';?>">
                    </div>
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
                        <h5>Clé :</h5>
                        <select class="btn btn-outline-primary" id="copro" name="copro">
                            <?php                            
                                $db = new PDO('mysql:host=clesgrn1.mysql.db;dbname=clesgrn1;charset=utf8mb4', 'clesgrn1', 'Grosset74');
                                $ncop = $db->query("SELECT * FROM Stock")->fetchAll();
                                foreach($ncop as $data0){
                                    if(isset($_GET['ncop'])){
                                        if($_GET['ncop'] == $data0["id"]){
                                            echo'<option selected value="'. $data0['id']. '">'.$data0["Intitule"]."</option>";
                                        }
                                        echo'<option value="'. $data0['id']. '">'.$data0["Intitule"]."</option>";
                                    }
                                    else{
                                        echo'<option value="'. $data0['id']. '">'.$data0["Intitule"]."</option>";
                                    }
                                }
                            ?>
                        </select>
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
                        <h5>Règlement :</h5>
                        <select class="btn btn-outline-primary" id="regle" name="regle">
                            <?php                        
                                $db = new PDO('mysql:host=clesgrn1.mysql.db;dbname=clesgrn1;charset=utf8mb4', 'clesgrn1', 'Grosset74');
                                $regle = $db->query("SELECT * FROM Reglement")->fetchAll();
                                foreach($regle as $data7){
                                    if(isset($_GET['regle'])){
                                        if($_GET['regle'] == $data7["id"]){
                                            echo'<option selected value="'. $data7['id']. '">'.$data7["Methode"]."</option>";
                                        }
                                        echo'<option value="'. $data7['id']. '">'.$data7["Methode"]."</option>";
                                    }
                                    else{
                                        echo'<option value="'. $data7['id']. '">'.$data7["Methode"]."</option>";
                                    }
                                }
                            ?>
                        </select>
                    </div>
                    <div>
                        <h5>Note :</h5>
                        <input type="text" class="form-control" id="note" name="note" rows="5" cols="25" maxlength="70" value="<?php echo isset($_GET['note']) ? $_GET['note'] : '';?>">
                    </div>
                </div>
            
                <div class="form-group p-5">
                    <input type="submit" onsubmit="return false;" class="btn btn-outline-primary" value="Valider" id="valider" name="valider">
                    <input type="submit" class="btn btn-outline-primary" value="Annuler" id="annuler" name="annuler">
                </div>
                
                <?php
                    if(isset($_POST['valider'])){
                        $cle= $_POST['cle'];
                        $mail= $_POST['mail'];
                        $num= $_POST['num'];
                        $regle= $_POST['regle'];
                        $date= $_POST['date'];
                        $ncop= $_POST['copro'];
                        $contact= $_POST['contact'];
                        $note= $_POST['note'];
                        $nmcoll= $_SESSION['idNom'];
                        $cl= $_POST['client'];
                        $ag= $_POST['agence'];
                            
                        $db = new PDO('mysql:host=clesgrn1.mysql.db;dbname=clesgrn1;charset=utf8mb4', 'clesgrn1', 'Grosset74');

                        $data111 = $db->query("SELECT * FROM Stock WHERE id = $ncop")->fetchAll();
                        $data111 = $data111[0];
                        $data9 = $db->query("SELECT * FROM Copropriete")->fetchAll();
                        $cleint = $data111['Intitule'];

                        $Prixtt = floatval($cle) * floatval($data111['Prix']);
                        $rest = intval($data111['Quantite']) - intval($cle);
                        foreach ($data9 as $key) {
                            if ($data111['Copro'] == $key['id']) {
                                $Copro = $key['id'];
                                $NCopro = $key['NumCopro'];
                            }
                        }

                        $nathalie = array("001", "003", "004", "005", "006", "008", "011", "013", "014", "018", "019", "027", "028", "031", "032", "035", "037", "039", "041", "043", "048", "051", "053", "054", "055", "061", "064", "096", "103", "107");

                        $jennifer = array("002", "007", "009", "023", "030", "050", "058", "067", "073", "076", "077", "078", "080", "082", "090", "091", "092", "097", "099", "100", "105");

                        $virginie = array("010", "015", "017", "034", "047", "068", "069", "070", "071", "072", "074", "075", "079", "081", "083", "084", "085", "086", "088", "089", "093", "094", "095", "098", "102", "104", "106");

                        $fabien = array("012", "016", "020", "021", "022", "024", "025", "033", "036", "038", "040", "042", "044", "046", "049", "052", "056", "057", "060", "062", "063", "065", "066", "087", "101");

                        if($rest <= 1){
                            if (in_array($NCopro, $nathalie)) {
                                $destinataire = 'nathalie@grossetgrange.com';
                                // Pour les champs $expediteur / $copie / $destinataire, séparer par une virgule s'il y a  plusieurs adresses
                                $expediteur = 'info@grossetgrange.com';
                                $objet = 'Information stock de clé en vente'; // Objet du message
                                $headers  = 'MIME-Version: 1.0' . "\n";
                                $headers .= 'Reply-To: '.$expediteur."\n";
                                $headers .= 'From: '.$expediteur."\n"; 
                                $headers .= 'Delivered-to: '.$destinataire."\n";   
                                $headers .= 'Cc: '.$copie."\n";   
                                $message = 'Il ne reste plus que 1 clé en stock pour : '.$cleint;
                                mail($destinataire, $objet, $message, $headers);
                            }
                            if (in_array($NCopro, $jennifer)) {
                                $destinataire = 'jennifer@grossetgrange.com';
                                // Pour les champs $expediteur / $copie / $destinataire, séparer par une virgule s'il y a  plusieurs adresses
                                $expediteur = 'info@grossetgrange.com';
                                $objet = 'Information stock de clé en vente'; // Objet du message
                                $headers  = 'MIME-Version: 1.0' . "\n";
                                $headers .= 'Reply-To: '.$expediteur."\n";
                                $headers .= 'From: '.$expediteur."\n"; 
                                $headers .= 'Delivered-to: '.$destinataire."\n";   
                                $headers .= 'Cc: '.$copie."\n";   
                                $message = 'Il ne reste plus que 1 clé en stock pour : '.$cleint;
                                mail($destinataire, $objet, $message, $headers);                            
                            }
                            if (in_array($NCopro, $virginie)) {
                                $destinataire = 'virginie@grossetgrange.com';
                                // Pour les champs $expediteur / $copie / $destinataire, séparer par une virgule s'il y a  plusieurs adresses
                                $expediteur = 'info@grossetgrange.com';
                                $objet = 'Information stock de clé en vente'; // Objet du message
                                $headers  = 'MIME-Version: 1.0' . "\n";
                                $headers .= 'Reply-To: '.$expediteur."\n";
                                $headers .= 'From: '.$expediteur."\n"; 
                                $headers .= 'Delivered-to: '.$destinataire."\n";   
                                $headers .= 'Cc: '.$copie."\n";   
                                $message = 'Il ne reste plus que 1 clé en stock pour : '.$cleint;
                                mail($destinataire, $objet, $message, $headers);                          
                            }
                            if (in_array($NCopro, $fabien)) {
                                $destinataire = 'fabien@grossetgrange.com';
                                // Pour les champs $expediteur / $copie / $destinataire, séparer par une virgule s'il y a  plusieurs adresses
                                $expediteur = 'info@grossetgrange.com';
                                $objet = 'Information stock de clé en vente'; // Objet du message
                                $headers  = 'MIME-Version: 1.0' . "\n";
                                $headers .= 'Reply-To: '.$expediteur."\n";
                                $headers .= 'From: '.$expediteur."\n"; 
                                $headers .= 'Delivered-to: '.$destinataire."\n";   
                                $headers .= 'Cc: '.$copie."\n";   
                                $message = 'Il ne reste plus que 1 clé en stock pour Fabien : '.$cleint;
                                mail($destinataire, $objet, $message, $headers);                          
                            }
                        }
                                    

                        
                        /* -- Modifier -- */
                        if(isset($_GET['update'])){
                            $id = $_GET['update'];
                            if($_GET['cle'] != $cle){
                                $stmt = $db->prepare("UPDATE CleVente SET Quantite = :_numcle WHERE id= :_id;");
                                $stmt->bindParam(':_numcle', $cle);
                                $stmt->bindParam(':_id', $id);
                                $stmt->execute();
                            }
                            if($_GET['date'] != $date){
                                $stmt = $db->prepare("UPDATE CleVente SET Date = :_date WHERE id= :_id;");
                                $stmt->bindParam(':_date', $date);
                                $stmt->bindParam(':_id', $id);
                                $stmt->execute();
                            }
                            if($_GET['contact'] != $contact){
                                $stmt = $db->prepare("UPDATE CleVente SET Contact = :_contact WHERE id= :_id;");
                                $stmt->bindParam(':_contact', $contact);
                                $stmt->bindParam(':_id', $id);
                                $stmt->execute();
                            }
                            if($_GET['note'] != $note){
                                $stmt = $db->prepare("UPDATE CleVente SET Note = :_note WHERE id= :_id;");
                                $stmt->bindParam(':_note', $note);
                                $stmt->bindParam(':_id', $id);
                                $stmt->execute();
                            }
                            if($_GET['nmcollabo'] != $nmcoll){
                                $stmt = $db->prepare("UPDATE CleVente SET Utilisateur = :_nmcollabo WHERE id= :_id;");
                                $stmt->bindParam(':_nmcollabo', $nmcoll);
                                $stmt->bindParam(':_id', $id);
                                $stmt->execute();
                            }
                            if($_GET['numerocop'] != $Copro){
                                $stmt = $db->prepare("UPDATE CleVente SET Copro = :_copro WHERE id= :_id;");
                                $stmt->bindParam(':_copro', $Copro);
                                $stmt->bindParam(':_id', $id);
                                $stmt->execute();
                            }
                            if($_GET['cl'] != $cl){
                                $stmt = $db->prepare("UPDATE CleVente SET Client = :_client WHERE id= :_id;");
                                $stmt->bindParam(':_client', $cl);
                                $stmt->bindParam(':_id', $id);
                                $stmt->execute();
                            }
                            if($_GET['ag'] != $ag){
                                $stmt = $db->prepare("UPDATE CleVente SET Agence = :_agence WHERE id= :_id;");
                                $stmt->bindParam(':_agence', $ag);
                                $stmt->bindParam(':_id', $id);
                                $stmt->execute();
                            }
                            if($_GET['prix'] != $Prixtt){
                                $stmt = $db->prepare("UPDATE CleVente SET Prix = :_prix WHERE id= :_id;");
                                $stmt->bindParam(':_prix', $Prixtt);
                                $stmt->bindParam(':_id', $id);
                                $stmt->execute();
                            }
                            if($_GET['mail'] != $mail){
                                $stmt = $db->prepare("UPDATE CleVente SET Mail = :_mail WHERE id= :_id;");
                                $stmt->bindParam(':_mail', $mail);
                                $stmt->bindParam(':_id', $id);
                                $stmt->execute();
                            }
                            if($_GET['num'] != $num){
                                $stmt = $db->prepare("UPDATE CleVente SET NumCle = :_num WHERE id= :_id;");
                                $stmt->bindParam(':_num', $num);
                                $stmt->bindParam(':_id', $id);
                                $stmt->execute();
                            }
                            if($_GET['regle'] != $regle){
                                $stmt = $db->prepare("UPDATE CleVente SET Reglement = :_regle WHERE id= :_id;");
                                $stmt->bindParam(':_regle', $regle);
                                $stmt->bindParam(':_id', $id);
                                $stmt->execute();
                            }
                        }

                            

                        /* -- Creer -- */
                        else{
                            $stmt = $db->prepare("UPDATE Stock SET Quantite = :_rest WHERE id= :_id;");
                            $stmt->bindParam(':_rest', $rest);
                            $stmt->bindParam(':_id', $ncop);
                            $stmt->execute();

                            $stmt = $db->prepare("INSERT INTO CleVente(Copro, Client, Quantite, Date, Contact, Agence, Utilisateur, Note, Prix, Mail, NumCle, Reglement) VALUES (:copro, :client, :quantite, :date, :contact, :agence, :utilisateur, :note, :prix, :mail, :num, :regle);");
                            $stmt->bindParam(':quantite', $cle);
                            $stmt->bindParam(':copro', $Copro);
                            $stmt->bindParam(':client', $cl);
                            $stmt->bindParam(':date', $date);
                            $stmt->bindParam(':agence', $ag);
                            $stmt->bindParam(':mail', $mail);
                            $stmt->bindParam(':contact', $contact);
                            $stmt->bindParam(':utilisateur', $nmcoll);
                            $stmt->bindParam(':num', $num);
                            $stmt->bindParam(':note', $note);
                            $stmt->bindParam(':regle', $regle);
                            $stmt->bindParam(':prix', $Prixtt);
                            $stmt->execute();

                            $data4 = $db->query("SELECT * FROM Copropriete")->fetchAll();
                            $data9 = $db->query("SELECT * FROM Reglement")->fetchAll();
                            $data666 = $db->query("SELECT * FROM CleVente WHERE id = (SELECT MAX(id) FROM CleVente)")->fetchAll();
                            $data666 = $data666[0];

                            foreach($data9 as $reglem){
                                if($data666['Reglement'] == $reglem['id']){
                                    foreach($data4 as $numcop){
                                        if($data666['Copro'] == $numcop['id']){
                                            if ($numcop['NumCopro'] <= 60) {
                                                $destinataire = 'eva@grossetgrange.com';
                                                $copie = $mail;
                                                // Pour les champs $expediteur / $copie / $destinataire, séparer par une virgule s'il y a  plusieurs adresses
                                                $expediteur = 'info@grossetgrange.com';
                                                $objet = 'Information vente badge/clé'; // Objet du message
                                                $headers  = 'MIME-Version: 1.0' . "\n";
                                                $headers .= 'Reply-To: '.$expediteur."\n";
                                                $headers .= 'From: '.$expediteur."\n"; 
                                                $headers .= 'Delivered-to: '.$destinataire."\n";   
                                                $headers .= 'Cc: '.$copie."\n";   
                                                $message = 'Résidence : '.$numcop['NomCopro']."\n".'Copropriétaire : '.$data666['Client'].' téléphone '.$data666['Contact'].'  a récuperé '.$data666['Quantite'].' clés/badges réglé '.$data666['Prix'].'€ par '.$reglem['Methode']."\n".'N° de clé/badge liée : '.$data666['NumCle']."\n".'Note ajoutée : '.$data666['Note'];
                                                mail($destinataire, $objet, $message, $headers);
                                            }
                                            elseif ($numcop['NumCopro'] > 60) {
                                                $destinataire = 'segolene@grossetgrange.com';
                                                $copie = $mail;
                                                $expediteur = 'info@grossetgrange.com';
                                                $objet = 'Information vente badge/clé'; // Objet du message
                                                $headers  = 'MIME-Version: 1.0' . "\n";
                                                $headers .= 'Reply-To: '.$expediteur."\n";
                                                $headers .= 'From: '.$expediteur."\n"; 
                                                $headers .= 'Delivered-to: '.$destinataire."\n"; 
                                                $headers .= 'Cc: '.$copie."\n"; // Copie Cc     
                                                $message = 'Résidence : '.$numcop['NomCopro']."\n".'Copropriétaire : '.$data666['Client'].' téléphone '.$data666['Contact'].'  a récuperé '.$data666['Quantite'].' clés/badges réglé '.$data666['Prix'].'€ par '.$reglem['Methode']."\n".'N° de clé/badge liée : '.$data666['NumCle']."\n".'Note ajoutée : '.$data666['Note'];
                                                mail($destinataire, $objet, $message, $headers);
                                            }
                                        }
                                    }
                                }                                    
                            }
                        }

                        /* -- Redirection -- */
                        if(isset($_GET['update'])){
                            echo '<script type="text/javascript">window.location.replace("Manager/clevente.php");</script>';
                        }
                        else{
                            echo '<script type="text/javascript">window.location.replace("Manager/clevente.php");</script>';
                        }
                    }
                    if(isset($_POST['annuler'])){
                        if(isset($_GET['update'])){
                            echo '<script type="text/javascript">window.location.replace("Manager/clevente.php");</script>';
                        }
                        else{
                            echo '<script type="text/javascript">window.location.replace("Manager/clevente.php");</script>';
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