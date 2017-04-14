<?php
$servername = "localhost";
$username = "thanatchaporn";
$password = "";
$dbname = "formInput";

$fname = $_POST['firstname'];
$lname = $_POST['lastname'];
$email = $_POST['email'];


try {
    $conn = new PDO("mysql:host=$servername;dbname=formInput", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "INSERT INTO data (fname, lname, email)
			VALUES ('$fname', '$lname', '$email')";

		if ($conn->query($sql) === TRUE) {
    		echo "New record created successfully";
		} 

    echo "Connected successfully"; 
    }
catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }


?>