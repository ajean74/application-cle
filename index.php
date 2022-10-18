<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="index.css">
    <title>Connexion</title>
  </head>

  <body class="body">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>

    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-2"></div>
                <div class="col-lg-6 col-md-8 login-box">
                    <div class="col-lg-12 login-title">
                        Page de connexion
                    </div>
                        <div class="col-lg-12 login-form">
                            <form method="POST" action="index.php">
                                <div class="form-group">
                                    <label class="form-control-label">Identifiant : </label>
                                    <input type="text" id="user" name="user" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label">Mot de passe : </label>
                                    <div class="d-flex">
                                        <div class="col-11">
                                            <input type="password" id="password" name="password" class="form-control">
                                        </div>
                                        <div class="col-1 d-flex justify-content-center align-items-start">
                                            <img src="image/eye.png" alt="icone d'oeil" width="25px" onclick="let input = document.getElementById('password'); input.type == 'password' ? input.type = 'text' : input.type = 'password'; ">
                                        </div>
                                    </div>
                                </div>
                                <div class="login-button">
                                    <input type="submit" id="bouton" name="bouton" value="Connexion" class="btn btn-outline-primary">
                                </div>

                                <?php

                                    if (isset($_POST['bouton'])){
                                        session_start(); 
                                        $sucess1 = false;
                                        $sucess2 = false;
                                        $sucess3 = false;
                                        $username = ($_POST['user']) ? $_POST['user'] : NULL;
                                        $password = ($_POST['password'] ) ? $_POST['password'] : NULL;

                                        $db = new PDO('mysql:host=clesgrn1.mysql.db;dbname=clesgrn1;charset=utf8mb4', 'clesgrn1', 'Grosset74');

                                        $data = $db->query("SELECT * FROM Utilisateur")->fetchAll();

                                        foreach ($data as $row) {

                                            if ($row['Identifiant'] == $username){
                                                if ($row['MotDePasse'] == $password) {
                                                    $_SESSION['User'] = $row['Identifiant'];
                                                    $_SESSION['NomUser'] = $row['Prenom'];
                                                    $_SESSION['idNom'] = $row['id'];
                                                    $_SESSION['type'] = $row['Fonction'];
                                                    if ($row['Fonction'] == 1) {
                                                        $sucess1 = true;
                                                        break;
                                                    }
                                                    else {
                                                        $sucess2 = true;
                                                        break;
                                                    }
                                                }
                                            }
                                        }

                                        if ($sucess1) {
                                            header("location: Manager/manager.php");
                                            exit();
                                        }
                                        else if ($sucess2) {
                                            header("location: Comptable/comptable.php");
                                            exit();
                                        }
                                        else if ($username == NULL){
                                            echo'<div class="alert alert-danger alert-dismissible fade show mt-5" role="alert"> 
                                                <strong>Identifiant requis</strong>
                                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                </div>';
                                        }
                                        else if ($password == NULL){
                                            echo'<div class="alert alert-danger alert-dismissible fade show mt-5" role="alert"> 
                                                <strong>Mot de Passe requis</strong>
                                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                </div>';
                                        }
                                        else {
                                            echo'<div class="alert alert-danger alert-dismissible fade show mt-5" role="alert"> 
                                                <strong>Identifiant ou Mot de Passe incorrecte</strong>
                                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                </div>';
                                        }
                                    }
                                ?>
                            </form>
                        </div>
                </div>
            <div class="col-lg-3 col-md-2"></div>
        </div>
    </div>


  </body>
</html>