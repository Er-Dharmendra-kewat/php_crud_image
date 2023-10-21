<?php 

 $sername = "localhost";
 $username = "root";
 $password = "laravel";
 $db_name  = "crud";


// $conn  = new mysqli("localhost","root","laravel","crud");
$conn  = new mysqli($sername,$username,$password,$db_name);

if(!$conn){
    die("connection Failed:".mysqli_connect_error());
}
// else
// {
//     echo"Connected Successfully";
// }


?>