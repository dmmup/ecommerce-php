<?php 
    // Include products$products class
    include 'product.php';
    // Create object
    $productObj = new Product();
    $output='';
   
    
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
    <title>Desccriptions</title>
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
    <?php 
    $products = $productObj->displayRecordById($_GET['id_product']);
    foreach ($products as $product){

    ?> 
    <!-- <div class="container">
        <div class="row">
            <div class="col-md-4">
                <img src="<?php echo $product['photos'] ?>" class="w-100" alt="product image">
            </div>
            <div class="col-md-8">
                <h4><?php echo $product['artistname'] ?></h4>
                <p><?php echo $product['description'] ?></p>
            </div>
            <button class="btn btn-primary "><i class="fa fa-shopping-cart me-2">Add to Cart</i></button>
        </div>
    </div>

<?php
     }
?> -->

<div class="container d-flex justify-content-center mt-50 mb-50">
            
        <div class="row">
           <div class="col-md-10">
            
                <div class="card card-body">
                            <div class="media align-items-center align-items-lg-start text-center text-lg-left flex-column flex-lg-row">
                                <div class="mr-2 mb-3 mb-lg-0">
                                    
                                <img src="<?php echo $product['photos'] ?>" width="300" height="300" alt="">
                                   
                                </div>

                                <div class="media-body">
                                    <h6 class="media-title font-weight-semibold">
                                        <a href="#" data-abc="true"><?php echo $product['artistname'] ?></a>
                                    </h6>

                                    <ul class="list-inline list-inline-dotted mb-3 mb-lg-2">
                                        <li class="list-inline-item"><a href="#" class="text-muted" data-abc="true">Album</a></li>
                                        <li class="list-inline-item"><a href="#" class="text-muted" data-abc="true">Hip Hop</a></li>
                                    </ul>

                                    <p class="mb-3"><?php echo $product['description'] ?> Lorem ipsum dolor, laudantium, cupiditate dicta, explicabo harum reiciendis incidunt fuga exercitationem, tenetur distinctio veritatis animi dolore. Nobis obcaecati vel iusto dolorem architecto maxime eius officia officiis blanditiis commodi excepturi illo suscipit facilis nisi, aliquid saepe ad veritatis pariatur omnis ipsum sed nihil consequatur cumque eaque. Reiciendis nemo ad harum voluptatum id neque modi, exercitationem totam expedita ut laboriosam rem inventore, nesciunt mollitia commodi.</p>

                                    
                                </div>

                                <div class="mt-3 mt-lg-0 ml-lg-3 text-center">
                                    <h3 class="mb-0 font-weight-semibold"><?php echo $product['prix'] ?>$</h3>

                                    <div>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>

                                    </div>

                                    <div class="text-muted">1985 reviews</div>
<h6> Stock: <?php echo $product['qty'] ?></h6>

                                      
<?php 
$output .= '<form method="post" action="panier.php">';
$output .= "<input type='hidden' name='id' value='".$product['id']."' />";
$output .= '<p>Amount to Buy: </p>';
$output .= '<select id="quantite" name="quantite">';
for ($i = 1; $i <= $product['qty']; $i++)
		{
				$output .= "<option>$i</option>";
			}
			$output .= '</select>';
      
    
      $output .= '<br />';

      $output .= '<input type="submit" class="btn btn-warning mt-4 text-white" name="ajout_panier" value="Add to Cart" />';
			$output .= '</form>';
      echo $output;
    ?>
    
    </select>
            
    <br />
             
                                    
                                </div>
                            </div>
                        </div>

</body>
</html>