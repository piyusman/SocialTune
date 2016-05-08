<?php
session_start();// Starting Session
// Storing Session
$mysqli = new mysqli("localhost", "root", "","test");

/* check connection */
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}
$user_check=$_SESSION['login_user'];
// SQL Query To Fetch Complete Information Of User
$ses_sql= $mysqli->prepare("select alogin_id from artist where alogin_id='$user_check'");
$ses_sql->execute();
$ses_sql->bind_result($fsa);
$ses_sql->fetch();
$login_session =$fsa;
if(!isset($login_session)){
$mysqli->close(); // Closing Connection
header('Location: index.html'); // Redirecting To Home Page
}
?>