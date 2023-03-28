<?php 
session_start();
class Product{
// Cobfigurations DB
private $servername = '127.0.0.1';
private $username = 'root';
private $password = '';
private $database = 'projetcm1';
public $con;

public function __construct(){
    $this->con = new mysqli($this->servername, $this->username,
     $this->password, $this->database);
     if(mysqli_connect_error()){
        trigger_error("Failed to connect MYSQL: " .mysqli_connect_error());
     }
     else {
        echo 'Connected Successfully!';
        return $this->con;
        
     }
}

// Insert data
public function insertProduct($post){
    $var_artist = $this->con->real_escape_string($_POST['artist']);
    $var_title = $this->con->real_escape_string($_POST['title']);
    $var_year = $this->con->real_escape_string($_POST['year']);
    $var_price = $this->con->real_escape_string($_POST['price']);
    $var_desc = $this->con->real_escape_string($_POST['description']);
    $var_qty = $this->con->real_escape_string($_POST['qty']);

    $nom_photo = $_FILES['photo']['name'];
        
        $tmpName = $_FILES['photo']['tmp_name'];	

        $photo_dossier="./images/".$nom_photo;

       copy($_FILES['photo']['tmp_name'],$photo_dossier);

    $new_query = "INSERT INTO products(artistname, title, annee, description, photos, prix, qty) 
        VALUES('$var_artist', '$var_title', '$var_year', '$var_desc','$photo_dossier', '$var_price', '$var_qty')";
    $result = $this->con->query($new_query);
    if($result){
        echo 'Object inserted successfully! <br/>';
        // $_SESSION['email'] = $email;
        // $_SESSION['password'] = $password;

        // echo "<meta http-equiv='refresh' content='0;home.php' />";
    }else{
        echo 'Failed to insert!';
    }
    }

    public function displayData(){
        $new_query = "SELECT * FROM products";
        $result = $this->con->query($new_query);
        if($result->num_rows > 0){
            $data = array();
            while($row = $result->fetch_assoc()){
                $data[] = $row;
            }
            return $data;
        }
        else{
            echo 'No found records!';
        }
    }
// Fetch singe data
public function displayRecordById($id){
    $new_query = "SELECT * FROM products WHERE id = '$id'";
    $result = $this->con->query($new_query);
    if($result->num_rows > 0){   
        $data = array();         
        while($row = $result->fetch_assoc()){
            $data[] = $row;
        }
        return $data;
    }
    else{
        echo 'Record not found!';
    }
}
// Update record
public function updateRecord($post){
    $var_artistname = $this->con->real_escape_string($_POST['artistname']);
    $var_title = $this->con->real_escape_string($_POST['title']);
    $var_annee = $this->con->real_escape_string($_POST['annee']);
    $var_desc = $this->con->real_escape_string($_POST['description']);
    $var_photo = $this->con->real_escape_string($_POST['photos']);
    $var_prix = $this->con->real_escape_string($_POST['prix']);
    $var_qty = $this->con->real_escape_string($_POST['qty']);
    $var_id = $this->con->real_escape_string($_POST['id']);
    if(!empty($var_id) && !empty($post)){
        $new_query = "UPDATE products SET artistname = '$var_artistname', title ='$var_title',
        annee = '$var_annee', description ='$var_desc', photos ='$var_photo', prix='$var_prix', qty='$var_qty' WHERE id = '$var_id'";
        $result = $this->con->query($new_query);
        if($result){
            echo 'Object updated successfully! <br/>';
        }else{
            echo 'Failed to update!';
        }
    }
    
}
// delete record
public function deleteRecord($id){
    $new_query = "DELETE FROM products WHERE id = '$id'";
    $result = $this->con->query($new_query);
    if($result){            
        echo 'Record deleted successfully!';
    }
    else{
        echo 'Could not delete!';
    }
}



}








?>