<?php
    
$servername = "localhost";
$user = "root";
$password = "";
$dbname = "auth";

$conn = mysqli_connect($servername, $user, $password, $dbname);

// Check connection
if (!$conn) {
die("Connection failed: " . mysqli_connect_error());

}
    
$json = file_get_contents('php://input');
 

$obj = json_decode($json,true);
   
 
    
$all_data = "SELECT * FROM curl_data";
$result = $conn->query($all_data);

while($row = $result->fetch_assoc()){
$username = $row["username"];


$password = $row["password"];


$hostname = $row["hostname"];
}




$url_received = $obj['url_received'];
////echo($url_received);
//
if ($url_received == "virtsys")
{
$url = 'https://10.76.125.214/resources/virtualSystemPatterns';

}

else
{
$url = 'https://10.76.125.214/resources/environmentProfiles';

}
//echo($url) ;

$ch = curl_init( $url);
//$user_name = 'swanand';
//$password = 'L0ngl1vecps';

curl_setopt ( $ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt ( $ch, CURLOPT_SSL_VERIFYHOST, false);

curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');


curl_setopt($ch, CURLOPT_USERPWD, $username . ':' . $password);

$headers = array();
$headers[] = 'X-Ibm-Puresystem-Api-Version: 3.0';
$headers[] = 'X-Ibm-Workload-Deployer-Api-Version: 5.0.0.0';
$headers[] = 'Content-Type: application/json';
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

$result = curl_exec($ch);
echo($result);
if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
}
curl_close ($ch);

?>
