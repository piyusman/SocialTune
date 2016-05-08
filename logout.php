<?php
session_start();
$id=$_SESSION['login_user'];
include "connectdb.php";
$query = $mysqli->prepare("update login SET logout = now() where userid = '$id' ");
$query->execute();
if(session_destroy()) // Destroying All Sessions
{
header("Location: index.html"); // Redirecting To Home Page
}
?>