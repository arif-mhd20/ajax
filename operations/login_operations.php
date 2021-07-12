<?php

include 'utility_operations.php';
include '../model/user_model.php';

function getLoginConfirmationFromDatabase($username, $password)
{
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

    $sql = "SELECT * FROM " . $tableName;

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {

            if( $row["username"] == $username && $row["password"] == $password ){

                $conn->close();
                return true;
            }
        }
    } else {
        $conn->close();
        return false;
        
    }

    $conn->close();
    return false;


    
}



function saveLoginDataInDatabase($loginData)
{
 
    $servername = "localhost";
    $username = "root";
    $dbname = "wtk";
    $password = "";
    $tableName = "users";
    $sql = "";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql .= "INSERT INTO " . $tableName . " (first_name, last_name, gender, dob, religion, present_address, permanent_address,";
    $sql .= "phone, email, personal_website, username, password)";
    $sql .= " VALUES (" . "'" . $loginData->firstName .  "'" 
            . ", '" . $loginData->lastName .  "'" 
            . ", '" . $loginData->gender .  "'" 
            . ", '" . $loginData->birthday .  "'" 
            . ", '" . $loginData->religion .  "'" 
            . ", '" . $loginData->presentAddress .  "'" 
            . ", '" . $loginData->permenentAddress .  "'" 
            . ", '" . $loginData->phone .  "'" 
            . ", '" . $loginData->email .  "'" 
            . ", '" . $loginData->personalWebsiteLink .  "'" 
            . ", '" . $loginData->userName .  "'" 
            . ", '" . $loginData->password .  "'" 
            .")";

    if ($conn->query($sql) === TRUE) {
        echo "Record inserted successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}

function saveLoginData($loginData)
{
    saveLoginDataInDatabase($loginData);
    /*
    $previousData = getLoginData();
    $dataArray = array();

    if (count($previousData) == 0) {
        array_push($dataArray, $loginData);
        writeToFile($dataArray, "../data/login.txt");
    } else {
        array_push($previousData, $loginData);
        writeToFile($previousData, "../data/login.txt");
    }
    */
}

function getLoginData($username, $password)
{

    return getLoginConfirmationFromDatabase($username, $password);
    /*
    $json = readFromFile("../data/login.txt");
    $data = User::getUserArrayFromJsonArray($json);

    return $data;
    */
}

/*
function changePassword($username, $password)
{
    $previousData = getLoginData();
    $size = count($previousData);

    for ($x = 0; $x < $size; $x++) {
        if ($previousData[$x]->getUserName() == $username) {
            $previousData[$x]->password = $password;
        }
    }

    writeToFile($previousData, "../data/login.txt");
}

function updateProfile($userData)
{
    $previousData = getLoginData();
    $size = count($previousData);

    for ($x = 0; $x < $size; $x++) {
        if ($previousData[$x]->getUserName() == $userData->username) {
            $previousData[$x] = $userData;
        }
    }

    writeToFile($previousData, "../data/login.txt");
}
*/