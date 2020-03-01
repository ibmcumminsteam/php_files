<?php
    $servername = "localhost";
    $user = "root";
    $password = "";
    $dbname = "auth";
    
    // Create connection
    $conn = mysqli_connect($servername, $user, $password, $dbname);
    
    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
        
    }
    
    $json = file_get_contents('php://input');
    //echo($json);
    
    // decoding the received JSON and store into $obj variable.
    $obj = json_decode($json,true);
    
    $username = $obj['username'];
    $password = $obj['password'];
    $hostname = $obj['hostname'];
    //echo ($username);
    
    //echo("jkdsba");
    // isSet : checks if variable is not null
    
    $sql = 'SELECT username, password, hostname FROM login_details';
    $result = mysqli_query($conn, $sql);
    
    //$a = 'SELECT password FROM login_details WHERE username=';
    //$CheckSQL = $a.'"'.$username.'"';
    $CheckSQL = 'SELECT * FROM login_details WHERE username = ' .'"' .$username .'" and password = '  .'"' .$password .'" and hostname = ' .'"' .$hostname .'"' ;
    //$CheckSQL = "SELECT * FROM login_details WHERE username='swanand' and password='L0ngl1vecps' and hostname='10.76.125.214'";
    
    //$CheckSQL = "SELECT * FROM login_details WHERE username='swanand' and password='L0ngl1vecps' and hostname='10.76.125.214'";
    
    
    // Executing SQL Query.
    $check = mysqli_fetch_array(mysqli_query($conn,$CheckSQL));
    
    if(isset($check)){
        
        $Sql_Query = "insert into curl_data (username,password,hostname) values ('$username','$password','$hostname')";
        $result = $conn->query($Sql_Query);
        $SuccessLoginMsg = 'Data Matched';
        
        // Converting the message into JSON format.
        $SuccessLoginJson = json_encode($SuccessLoginMsg);
        
        // Echo the message.
        echo $SuccessLoginJson ;
        
    }
    
    else{
        
        // If the record inserted successfully then show the message.
        $InvalidMSG = 'Invalid Username or Password or Hostname Please Try Again' ;
        
        // Converting the message into JSON format.
        $InvalidMSGJSon = json_encode($InvalidMSG);
        
        // Echo the message.
        echo $InvalidMSGJSon ;
        
    }
    
    mysqli_close($conn);
    ?>
