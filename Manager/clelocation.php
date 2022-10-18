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

    <title>Clé de Locations</title>
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
                        <a class="nav-link active black" href="clelocation.php">Clé de Locations</a>
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
        <form method="POST" action="clelocation.php">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="col-lg-12 login-title">
                        Liste des clés
                    </div>

                    <!-- Creer une clé -->
                    <div class="ajout-button">
                        <a href="../Location.php" class="btn btn-outline-primary">Ajouter une clé</a>
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
                                    <th>N° Clé + Photo</th>
                                    <th>N° Copro</th>
                                    <th>Nom Copro</th>
                                    <th>Propriétaire</th>
                                    <th>Locataire</th>
                                    <th>Disponibilité</th>
                                    <th>Rentrer/Sortir</th>
                                    <th>Historique</th>
                                    <th>Modifier</th>
                                    <th>Supprimer</th>
                                </tr>
                            </thead>

                            <tbody class="bg-tableau">

                                <!-- Corps du tableau -->
                                <?php
                                    $db = new PDO('mysql:host=clesgrn1.mysql.db;dbname=clesgrn1;charset=utf8mb4', 'clesgrn1', 'Grosset74');
                                    $data = $db->query("SELECT * FROM CleLocation")->fetchAll();
                                    $data2 = $db->query("SELECT * FROM Copropriete")->fetchAll();
                                    $data4 = $db->query("SELECT * FROM Etat")->fetchAll();
                                    $data5 = $db->query("SELECT * FROM Agence")->fetchAll();
                                    $data6 = $db->query("SELECT * FROM Utilisateur")->fetchAll();

                                    foreach($data as $row){
                                        echo"<tr id='".$row['id']."' class='bg-tableau'>";
                                        if ($row['Photo'] == NULL){
                                            echo"<td class='black text-left'>".$row['NumCle']."</td>";
                                        }
                                        else{
                                            echo "<td class='black text-left'><a class='black' target='_blank' href='../".$row['Photo']."' type='submit'>".$row['NumCle']."</a></td>";
                                        }
                                        foreach($data2 as $numcop){
                                            if($row['Copro'] == $numcop['id']){
                                                echo "<td class='black text-left'>".$numcop['NumCopro'];
                                            }
                                        }
                                        echo"</td><td class='black text-left'>";
                                        foreach($data2 as $nomcop){
                                            if($row['Copro'] == $nomcop['id']){
                                                echo $nomcop['NomCopro'];
                                            }
                                        }
                                        echo"</td><td class='black text-left'>".$row['Proprietaire']."</td><td class='black text-left'>".$row['Locataire']."</td><td class='black text-left'>";
                                        foreach($data4 as $etat){
                                            if($row['Etat'] == $etat['id']){
                                                    echo $etat['NomEtat'].'    ';
                                            }
                                        }
                                        foreach($data5 as $loc){
                                            if($row['Agence'] == $loc['id']){
                                                if($row['Etat'] == 2){
                                                    foreach($data6 as $user){
                                                        if($row['Utilisateur'] == $user['id']){
                                                            echo "<a class='black' href='clelocation.php?info=".$row['id']."&1=".$row['NomPersonne']."&2=".$row['Date']."&3=".$row['Contact']."&4=".$user['Prenom']."&5=".$row['DateRetour']."&8=".$row['Note']."'>".$loc['Nom']."</a>";
                                                        }
                                                    }
                                                    
                                                }
                                                elseif($row['Etat'] == 3){
                                                    foreach($data6 as $user){
                                                        if($row['Utilisateur'] == $user['id']){
                                                            echo "<a class='black' href='clelocation.php?note=".$row['id']."&1=".$row['NomPersonne']."&2=".$row['Date']."&3=".$row['Contact']."&4=".$user['Prenom']."&5=".$row['Note']."&6=".$row['DateRetour']."'>".$loc['Nom']."</a>";
                                                        }
                                                    }
                                                    
                                                }
                                                else{
                                                    echo $loc['Nom'];
                                                }
                                            }
                                        }
                                        echo"</td>";
                                        echo"<td class='text-center'><div><a href='clelocation.php?rs=".$row['id']."'><input class='btn btn-outline-primary' name='lebouton' type='button' value='Interagir' id='Sortir'></a></div></td>";

                                        echo"<td class='text-center'><a href='../Historique.php?update=".$row['id']."&cle=".strval($row['NumCle'])."'><img src='../image/histo.png' width='30px'></a></td>";

                                        echo"<td class='text-center'><a href='../Location.php?update=".$row['id']."&cle=".$row['NumCle']."&ncop=".$row['Copro']."&cl=".$row['Proprietaire']."&cl2=".$row['Locataire']."&ag=".$row['Agence']."&pj=".$row['Photo']."'><img src='../image/Edit.png' width='30px'></a></td>";

                                        echo"<td class='text-center'><a href='clelocation.php?delete=".$row['id']."'><img src='../image/Poubelle.png' width='30px'></a></td></tr>";

                                        /* --- Info ---*/

                                        if (isset($_GET['info'])){
                                            echo '<div class="popup text-center" id="popup">
                                                    <div class="body arrondi7 p-3">
                                                        <div>
                                                            <h2>Information sur cette clé</h2>
                                                            <p>Cette clé a été sortie le <b>'.$_GET['2'].'</b> par <b>'.$_GET['4'].'</b> pour <b>'.$_GET['1'].'</b> et voici comment la contacter <b>'.$_GET['3'].'
                                                        </b></p><p>Date prévisionnelle de retour le <b>'.$_GET['5'].'</b></p><p>De plus voici la note ajoutée à cette clé : <b>'.$_GET['8'].'</b></p></div>
                                                        <div class="form-group">
                                                            <a href="clelocation.php?info='.$_GET['info'].'&annuler=1" class="btn btn-outline-primary mx-3" id="annuler">Annuler</a>
                                                        </div>
                                                    </div>
                                                </div>';
                                            echo '<script src="../js/index.js"></script>';
                                            if(isset($_GET['annuler'])){
                                                if($_GET['annuler'] == 1){
                                                    echo '<script type="text/javascript">document.getElementById("popup").remove();
                                                    window.location.replace("clelocation.php");</script>';
                                                }
                                            }
                                        }


                                        /* --- Note ---*/

                                        if (isset($_GET['note'])){
                                            echo '<div class="popup text-center" id="popup">
                                                    <div class="body arrondi7 p-3">
                                                        <div>
                                                            <h2>Information sur cette clé</h2>
                                                            <p>Cette clé a été sortie le <b>'.$_GET['2'].'</b> par <b>'.$_GET['4'].'</b> pour <b>'.$_GET['1'].'</b> et voici comment la contacter <b>'.$_GET['3'].'
                                                        </b></p><p>Date prévisionnelle de retour le <b>'.$_GET['6'].'</b></p><p>De plus voici la note ajoutée à cette clé : <b>'.$_GET['5'].'</b></p></div>
                                                        <div class="form-group">
                                                            <a href="clelocation.php?info='.$_GET['info'].'&annuler=1" class="btn btn-outline-primary btn-annuler mx-3" id="annuler">Annuler</a>
                                                        </div>
                                                    </div>
                                                </div>';
                                            echo '<script src="../js/index.js"></script>';
                                            if(isset($_GET['annuler'])){
                                                if($_GET['annuler'] == 1){
                                                    echo '<script type="text/javascript">document.getElementById("popup").remove();
                                                    window.location.replace("clelocation.php");</script>';
                                                }
                                            }
                                        }

                                        
                                        
                                        

                                        /* --- Supprimer --- */
                                        if (isset($_GET['delete'])){
                                            echo '<div class="popup text-center" id="popup">
                                            <div class="body arrondi6 p-5">
                                            <h2>Êtes-vous sûre de vouloir supprimer cette clé ?</h2>
                                            <div class="form-group p-2 mt-4">
                                            <a href="clelocation.php?delete='.$_GET['delete'].'&valider=1" class="btn btn-outline-primary mx-3" id="valider">Supprimer</a>
                                            <a href="clelocation.php?delete='.$_GET['delete'].'&annuler=1" class="btn btn-outline-primary mx-3" id="annuler">Annuler</a>
                                            </div>
                                            </div>
                                            </div>';
                                            echo '<script src="../js/index.js"></script>';
                                            if(isset($_GET['valider'])){
                                                if($_GET['valider'] == 1){
                                                    $idUser = $_GET['delete'];
                                                    $db = new PDO('mysql:host=clesgrn1.mysql.db;dbname=clesgrn1;charset=utf8mb4', 'clesgrn1', 'Grosset74');
                                                    $stmt = $db->prepare("DELETE FROM CleLocation WHERE id = :idUserDelete");
                                                    $stmt->bindParam(':idUserDelete', $idUser);
                                                    $stmt->execute();
                                                    echo '<script type="text/javascript">document.getElementById("popup").remove();
                                                    window.location.replace("clelocation.php");</script>';
                                                }
                                            }
                                            elseif(isset($_GET['annuler'])){
                                                if($_GET['annuler'] == 1){
                                                    echo '<script type="text/javascript">document.getElementById("popup").remove();
                                                    window.location.replace("clelocation.php");</script>';
                                                }
                                            }
                                        }
                                    }
                                    /* --- Bouton Rentrer Sortir ---*/

                                        $a='Choisir un utilisateur';
                                        if (isset($_GET['rs'])){
                                            $id2 = $_GET['rs'];
                                            $data111 = $db->query("SELECT * FROM CleLocation WHERE id = $id2")->fetchAll();
                                            $data111 = $data111[0];
                                            echo '<div class="popup text-center" id="popup">
                                            <div class="body arrondi4">
                                                <div class="p-5">
                                                    <div class="form-group p-2 mt-4">
                                                        <a href="../sortir4.php?update='.$_GET['rs'].'&user='.$a.'&NumCle='.$data111['NumCle'].'" class="btn btn-outline-danger mx-3" id="valider">Sortir</a>
                                                        <a href="../attente4.php?update='.$_GET['rs'].'&user='.$a.'&NumCle='.$data111['NumCle'].'" class="btn btn-outline-warning mx-3" id="attente">En transit</a>
                                                        <a href="clelocation.php?rs='.$_GET['rs'].'&rentrer=1" class="btn btn-outline-sucess mx-3" id="rentrer">Rentrer</a>
                                                    </div>
                                                    <div><a href="clelocation.php?rs='.$_GET['rs'].'&annuler=1" class="btn btn-outline-primary mx-3" id="annuler">Annuler</a></div>
                                                    </div>
                                                </div>
                                            </div>
                                            </div>';
                                            echo '<script src="../js/index.js"></script>';
                                            if(isset($_GET['valider'])){
                                                if($_GET['valider'] == 1){
                                                    echo '<script type="text/javascript">document.getElementById("popup").remove();
                                                    window.location.replace("clelocation.php");</script>';
                                                    }      
                                            }
                                            if(isset($_GET['attente'])){
                                                if($_GET['attente'] == 1){
                                                    echo '<script type="text/javascript">document.getElementById("popup").remove();
                                                    window.location.replace("clelocation.php");</script>';
                                                    }      
                                            }
                                            
                                            elseif(isset($_GET['annuler'])){
                                                if($_GET['annuler'] == 1){

                                                    echo '<script type="text/javascript">document.getElementById("popup").remove();
                                                    window.location.replace("clelocation.php");</script>';
                                                }
                                            }

                                            elseif(isset($_GET['rentrer'])){
                                                if($_GET['rentrer'] == 1){
                                                    $Object = new DateTime();  
                                                    $Object->setTimezone(new DateTimeZone('Europe/Paris'));
                                                    $DateAndTime = $Object->format("Y-m-d H:i:s");

                                                    $statut=1;
                                                    $idUser = $_GET['rs'];
                                                    $id = $_GET['rs'];
                                                    $db = new PDO('mysql:host=clesgrn1.mysql.db;dbname=clesgrn1;charset=utf8mb4', 'clesgrn1', 'Grosset74');
                                                    $stmt = $db->prepare("UPDATE CleLocation SET Etat = :_statut WHERE id= :_id;");
                                                    $stmt->bindParam(':_statut', $statut);
                                                    $stmt->bindParam(':_id', $id);
                                                    $stmt->execute();

                                                    $data21 = $db->query("SELECT * FROM CleLocation WHERE id = $id")->fetchAll();
                                                    $data21 = $data21[0];

                                                    $stmt = $db->prepare("INSERT INTO Historique(Libelle, Etat, NomPersonne, Date, Contact) VALUES (:libelle, :etat, :nom, :date, :contact);");
                                                    $stmt->bindParam(':libelle', $data21['NumCle']);
                                                    $stmt->bindParam(':etat', $statut);
                                                    $stmt->bindParam(':nom', $data21['NomPersonne']);
                                                    $stmt->bindParam(':date', $DateAndTime);
                                                    $stmt->bindParam(':contact', $data21['Contact']);
                                                    $stmt->execute();

                                                    echo '<script type="text/javascript">document.getElementById("popup").remove();
                                                    window.location.replace("clelocation.php");</script>';
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
