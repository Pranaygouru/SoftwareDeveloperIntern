<?php
/**
 * Created by PhpStorm.
 * User: pranay
 * Date: 1/27/2019
 * Time: 3:15 PM
 */
$servername = "localhost";
$username = "root";
$password = "";/* Put your password */
$dbname = "test";/* Put your database name */

/* Create connection */
$conn = new mysqli($servername, $username, $password, $dbname);
/* Check connection*/
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

/* sql to create table
$sql = "CREATE TABLE Person_Details
(
ID int NOT NULL AUTO_INCREMENT,
FirstName varchar(50),
LastName varchar(50),
EMAIL varchar(50),
PRIMARY KEY (ID)
)";

if ($conn->query($sql) === TRUE) {
    echo "Table test created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}
$conn->close();
?>*/