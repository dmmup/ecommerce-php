<?php 
// include customers/ class file
include 'product.php';
$productObj = new Product();
if(isset($_POST['submit'])){
    $productObj->insertProduct($_POST);
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
    <title>Add Customer</title>
</head>
<body>
    <div class='card text-center' style='padding:15px;'>
    <h4>ADD PRODUCT</h4>
    
        <a href="dashboard.php" class="btn btn-primary w-25" >Back</a><br>
    
    </div>
    <div class="container">
        <form action="add_product.php" enctype="multipart/form-data" method="POST">
            <div class='form-group'>
                <label for="artist">Artist:</label>
                <input type="text" class="form-control" name="artist" placeholder="Enter Artist" required="">
            </div>
            <div class='form-group'>
                <label for="title">Title:</label>
                <input type="text" class="form-control" name="title" placeholder="Enter title" required="">
            </div>
            <div class='form-group'>
                <label for="year">Year:</label>
                <input type="year" class="form-control" name="year" placeholder="Enter year" required="">
            </div>
            <div class='form-group'>
                <label for="price">Price:</label>
                <input type="price" class="form-control" name="price" placeholder="Enter price" required="">
            </div>
            <div class='form-group'>
                <label for="qty">Quantite:</label>
                <input type="qty" class="form-control" name="qty" placeholder="Enter quantite" required="">
            </div>
            <div class='form-group w-50'>
                <label for="description">Description:</label>
                <textarea  name="description" placeholder="Description" rows="5"></textarea>
            </div>
            <div class="mb-3">
                <label for="photo" class="form-label">Photo</label>
                <input class="form-control" type="file" id="photo" name="photo" required>
            </div>
            <input type="submit" name="submit" class="btn btn-primary" style="float-right;" value="submit">
        </form>
    </div>
</body>
</html>