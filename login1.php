<?php
include('login.php'); // Includes Login Script
?>
<!DOCTYPE html>
<html>
<head>
<title>Login Form in PHP with Session</title>
<link href="style.css" rel="stylesheet" type="text/css">
<style type="text/css">
body {
	background-image: url(red.jpg);
	background-repeat: repeat;
}
body,td,th {
	color: rgba(231,212,212,1);
}
</style>
<meta charset="utf-8">
</head>
<body>
<p align="center"><font size = "36"  >SOCIAL TUNE : GET INTO THE TUNE!</font></p>
<div align = "center" id="main">
<div id="login">
<h2 align="justify">Login</h2>
  <form action="" method="post">
        <p align="center">
          <label>
            <div align="left">UserName :</div>
          </label>
          <input id="name" name="username" placeholder="username" type="text">
          <label>
            <div align="left">Password :</div>
          </label>
          <input id="password" name="password" placeholder="**********" type="password">
          <input name="submit" type="submit" value=" Login ">
          <a href="reg_user.php"> New Here? Sign Up</a></p>
    <p align="justify"><?php echo $error; ?>
    </div>
</p>
  </form>
</div>
</body>
</html>