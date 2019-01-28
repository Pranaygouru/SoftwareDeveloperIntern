<?php
/**
 * Created by PhpStorm.
 * User: pranay
 * Date: 1/27/2019
 * Time: 5:34 PM
 */
include_once 'connect.php';

if (!file_exists("storage.json")) {
  fclose(fopen("storage.json", "w"));
}

$data = json_decode(file_get_contents("storage.json"), true);
if ($data == null) {
  $data = array();
}

$operation = $_POST['operation'];

if ($operation == "update") {
  $id = $_POST['id-edit'];
  $first_name = $_POST['first-edit'];
  $last_name = $_POST['last-edit'];
  $email = $_POST['handle-edit'];
  /*sql query for inserting data into database*/
  mysqli_query(
    $conn, "UPDATE person_details set FirstName='" . $first_name . "', LastName='" . $last_name . "', EMAIL='" . $email . "' WHERE ID='" . $id . "'");
  $data[$id] = array("first_name" => $first_name, "last_name" => $last_name, "handle" => $email);
} elseif ($operation == "add") {
  $first_name = $_POST['first-edit'];
  $last_name = $_POST['last-edit'];
  $email = $_POST['handle-edit'];
  /*sql query for inserting data into database*/
  mysqli_query($conn, "insert into person_details(FirstName, LastName, EMAIL) 
	 values ('$first_name','$last_name','$email')") or die();
  $data[$conn->insert_id] = array("first_name" => $first_name, "last_name" => $last_name, "handle" => $email);
} elseif ($operation == "delete") {
  $id = $_POST['delete-id-holder'];
  mysqli_query($conn, "DELETE FROM person_details WHERE ID='" . $id . "'");
  unset($data[$id]);
}

file_put_contents("storage.json", json_encode($data, JSON_PRETTY_PRINT));
header('Location: http://localhost:63342/InternProject/index.php');
