<?php
include 'utility_operations.php';
include '../model/user_model.php';

// get the q parameter from URL
$q = $_REQUEST["q"];

$hint = "";

$servername = "localhost";
    $user = "root";
    $dbName = "wtk";
    $pass = "";
    $tableName = "users";

    // Create connection
    $conn = new mysqli($servername, $user, $pass, $dbName);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM " . $tableName . " WHERE first_name LIKE '%" . $q . "%';";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            $hint .= '<br>';
            $hint .= $row["username"];
        }
    } 

    $conn->close();



// Output "no suggestion" if no hint was found or output correct values
echo $hint === "" ? "No user found" : $hint;
?>