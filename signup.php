<?php
// Include utilisateur/class file
include 'utilisateur.php';
//create customer object
$userObj = new Utilisateurs();
//insert into customer table 
if(isset($_POST['submit'])){
    $userObj->insertUser($_POST);
}


?>


<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="style_login.css">
    <title></title>
  </head>
  <body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">M&J RECORDS</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="home.php">Accueuil</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Categories</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Pricing</a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="loginAdmin.php" tabindex="-1" aria-disabled="true">Administrateur</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
  
    <div class="py-5">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-md-6">
            <div class="card">
              <div class="card-header">
                <h3>Signup </h3>
              </div>
              <div class="card-body">
            <form action="signup.php" method="POST">
                <div class="mb-3 mt-3">
                    <label for="lname" class="form-label">Nom:</label>
                    <input type="text" class="form-control" id="nom" placeholder="Entrer votre nom" name="nom">
                </div>
                <div class="mb-3">
                    <label for="fname" class="form-label">Prenom:</label>
                    <input type="text" class="form-control" id="prenom" placeholder="Entrer votre prenom" name="prenom">
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">E-mail:</label>
                    <input type="email" class="form-control" id="email" placeholder="Entrer votre email" name="email">
                </div>
                <div class="mb-3">
                    <label for="birthday" class="form-label">Date de naissance:</label>
                    <input type="date" class="form-control" id="birthday" placeholder="Entrer votre date de naissance" name="DateN">
                </div>
                <div class="mb-3">
                    <label for="pwd" class="form-label">Mot de passe:</label>
                    <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="password">
                </div>
                
                    <button type="submit" class="btn btn-primary" value="submit" name="submit">Soumettre</button>
            </form>
        </div>
            </div>
          </div>

        </div>
      </div>

    </div>

        <div class="formulaire">
            
        
        

        
    

    </div>
    

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>