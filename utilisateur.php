<?php
class Utilisateurs{
    // Cobfigurations DB
    private $servername = '127.0.0.1';
    private $username = 'root';
    private $password = '';
    private $database = 'projetcm1';
    public $con;
    // Database Connection
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
    public function insertUser($post){
        $var_lastname = $this->con->real_escape_string($_POST['nom']);
        $var_name = $this->con->real_escape_string($_POST['prenom']);
        $var_email = $this->con->real_escape_string($_POST['email']);
        $var_datenaissance = $this->con->real_escape_string($_POST['DateN']);
        $var_password = $this->con->real_escape_string($_POST['password']);
        if(empty($var_lastname && $var_name && $var_email && $var_datenaissance && $var_password)){
            echo 'Remplir tout les champs!';
        }else{
        $new_query = "INSERT INTO utilisateurs(nom, prenom, email, DateN, password) 
            VALUES('$var_lastname', '$var_name', '$var_email', '$var_datenaissance', '$var_password')";
        $result = $this->con->query($new_query);
        if($result){
            echo 'Object inserted successfully! <br/>';
            $_SESSION['email'] = $email;
            $_SESSION['password'] = $password;

            echo "<meta http-equiv='refresh' content='0;home.php' />";
        }else{
            echo 'Failed to insert!';
        }
        }
    }
    // Fetch customer records 
    public function displayUser(){
        $new_query = "SELECT * FROM utilisateurs";
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
    // Fetch single data
    public function displayUserByEmail($email, $password){
        $new_query = "SELECT email FROM utilisateurs WHERE email = '$email' AND password = '$password'";
        $result = $this->con->query($new_query);
        if($result->num_rows > 0){            
           $row = $result->fetch_assoc();
           echo 'found!';
            // echo "<meta http-equiv='refresh' content='0;menu.php' />";
            header('Location: display_products.php');
            return $result;
            
        }
        else{
            echo 'email or password incorrect!';
        }
    }

    // Update record
    public function updateUser($post){
        $var_name = $this->con->real_escape_string($_POST['name']);
        $var_email = $this->con->real_escape_string($_POST['email']);
        $var_username = $this->con->real_escape_string($_POST['username']);
       // $var_password = $this->con->real_escape_string($_POST['password']);
        $var_id = $this->con->real_escape_string($_POST['id']);
        if(!empty($var_id) && !empty($post)){
            $new_query = "UPDATE utilisateurs SET name = '$var_name', email ='$var_email',
            username = '$var_username' WHERE id = '$var_id'";
            $result = $this->con->query($new_query);
            if($result){
                echo 'Object updated successfully! <br/>';
                
            }else{
                echo 'Failed to update!';
            }
        }
    }
    // Delete record
    public function deleteUser($id){
        $new_query = "DELETE FROM customers WHERE id = '$id'";
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