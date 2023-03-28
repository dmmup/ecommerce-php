<?php
class Administrateurs{
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

    // Fetch single data
    public function displayAdminByEmail($email, $password){
        $new_query = "SELECT * FROM admin WHERE email = '$email' AND password = '$password'";
        $result = $this->con->query($new_query);
        if($result->num_rows > 0){            
           $row = $result->fetch_assoc();
           echo 'found!';
           echo 'Il marche';
           header('Location: dashboard.php');
            return $result;
        }
        else{
            echo 'email or password incorrect!';
        }
    }
}
?>