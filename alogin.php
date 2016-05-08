<?php
session_start(); // Starting Session
include "connectdb.php";
$error = "";
// Variable To Store Error Message
if (isset($_POST['submit'])) {
if (empty($_POST['username']) || empty($_POST['password'])) {
$error = "\n";
$error = "\nUsername or Password is invalid";
}
else
{
// Define $username and $password
$username=$_POST['username'];
$password=$_POST['password'];
// Establishing Connection with Server by passing server_name, //user_id and password as a parameter
// To protect MySQL injection for Security purpose
$username = stripslashes($username);
$password = stripslashes($password);
$username = $mysqli->real_escape_string($username);
$password = $mysqli->real_escape_string($password);
// SQL query to fetch information of registerd users and finds //user match.

if($query = $mysqli->prepare("select * from test.artist where password='$password' AND alogin_id='$username'"))
{
$query->execute();
$query->store_result();
$rows = $query->num_rows();
echo $rows;
echo $password;
echo $username;
if ($rows == 1) {
$_SESSION['login_user']=$username; // Initializing Session
echo $username;
header("location: bprofile.php"); // Redirecting To Other Page
}
}
else {
$error = "/n";
$error = "\nUsername or Password is invalid";
}
$query->close();
/*
if($stmt = $mysqli->prepare("update test.login set userid= '$username',login=now()"))
{
  $stmt->execute();
}
 else {
    echo "Error: " . $stmt . "<br>" . $mysqli->error;
}
  */
$mysqli->close(); // Closing Connection
}


}
?>