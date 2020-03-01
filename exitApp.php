<?php
    
    $servername = "localhost";
    $user = "root";
    $password = "";
    $dbname = "auth";

$json = file_get_contents('php://input');
 

$obj = json_decode($json,true);
$conn = mysqli_connect($servername, $user, $password, $dbname);

// Check connection
if (!$conn) {
die("Connection failed: " . mysqli_connect_error());

}
    
$del = "DELETE FROM curl_data";
$result = $conn->query($del);



?>
