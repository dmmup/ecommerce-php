<?php
    // Include albums class
    include 'product.php';
    // Create object
    $productObj = new Product();
    // Delete record from albums
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
        .container{
            /* background:black; */
            display:flex;
            flex-direction:row;
            flex-wrap: wrap;
        }
        .main{
            margin: 15px;
            border:1px solid black;
            
            display:flex;
            flex-direction:row;
            flex-wrap: wrap;
            width: 220px;
            
            
        }
        img{
            width:50px;
        }
    </style>
</head>
<body>
<div class='card text-center ' style='padding:15px;'>
    <h4>DASHBOARD</h4>
    </div>
    
    <h2>View records
        <a href="add_product.php" class="btn btn-primary" > Add New Record</a><br>
    </h2>
    
    

    <div class="container ">

    
        
    <table class="table table-hover">
            <thead>                
            <tr>
                <th>Id</th>
                <th>Artist</th>
                <th>Title</th>
                <th>Year</th>
                <th>Description</th>
                <th>Photo</th>
                <th>Prix</th>
                <th>Quantites</th>
                
            </tr>            
            </thead>
            <tbody>
                <?php
                    $products = $productObj->displayData();
                    foreach ($products as $product) {                  
                    
                ?>
                <tr>
                <td><?php echo $product['id'] ?></td>
                <td><?php echo $product['artistname'] ?></td>
                <td><?php echo $product['title'] ?></td>
                <td><?php echo $product['annee'] ?></td>
                <td><?php echo $product['description'] ?></td>
                <td><img src="<?php echo $product['photos'] ?>" alt="<?php echo $product['artistname'] ?> "></td>
                <td><?php echo $product['prix'].'$' ?></td>
                <td><?php echo $product['qty'] ?></td>
                
                <td>
                    <a href="edit.php?editId=<?php echo $product['id']?>" style="color:green">
                        <i class="fa fa-pencil" aria-hidden=true></i></a>&nbsp
                    <a href="dashboard.php?deleteId=<?php echo $product['id']?>" style="color:red" 
                                onclick="confirm('Are you sure want to delete this record?')">
                        <i class="fa fa-trash" aria-hidden=true></i></a>
                </td>
                </tr>
                <?php
                    }
                ?>
            </tbody>
        </table>
            
        
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>