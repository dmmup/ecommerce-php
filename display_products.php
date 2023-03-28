<?php
    // Include products$products class
    include 'product.php';
    // Create object
    $productObj = new Product();
    // Delete record from products$products
    if(isset($_GET['deleteId']) && !empty($_GET['deleteId'])){
        $deleteId = $_GET['deleteId'];
        $productObj->deleteRecord($deleteId);
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" />
    <title>Display Customers</title>
    <style>
        .card-body:hover{
            opacity: 0.9;
            transform:scale(1.1);

        .card-body{
            transition: transform .1s;
        }
        }
    </style>
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
        <a class="nav-link" href="display_products.php">Our Products</a>
        </li>
        <li class="nav-item">
        <a class="nav-link" href="panier.php">Panier</a>
        </li>
        <li class="nav-item">
        <a class="nav-link" href="#">About Us</a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="loginAdmin.php" tabindex="-1" aria-disabled="true">Administrateur</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
    <div class="py-5">
        <div class="container bg-light">
            <div class="row">
                <div class="col-md-12">
                    <div class="row d-flex justify-content-between mb-4">
                    <h2>OUR PRODUCTS</h2>
                    
                    </div>
                    
                    <div class="row ">
                        <?php
                            $products = $productObj->displayData();
                            foreach ($products as $product) {                  
                        
                        ?>
                        <div class="col-3 mb-2">

                        
                            <div class="card justify-content-center shadow ">
                            <a href="display_singlep.php?id_product=<?php echo $product['id'] ?>">
                                <div class="card-body">
                                    <div class="img"><img src="<?php echo $product['photos'] ?>" alt=""><br><br></div>
                                    <div class="info ">
                                    <h6>Artist: <?php echo $product['artistname'] ?><br></h6>
                                    <h6>Title: <?php echo $product['title'] ?><br></h6>
                                    <h6>Year: <?php echo $product['annee'] ?><br></h6>
                                    <h6>Price: <?php echo $product['prix']. "$" ?><br></h6>
                                    
                                    </div>


                                </div>
                                </a> 
                                <button type="button" class="btn btn-primary mt-4 text-white"><i class="icon-cart-add mr-2"></i> Add to cart</button> 
                            </div>
                            
                            

                        </div>
                            
                            
                                <?php
                                    // echo '<i class="bi bi-cart"></i>';

                                    }
                                ?>

                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>