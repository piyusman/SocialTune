<?php
include('alogin.php'); // Includes Login Script
?>
<!DOCTYPE html>
<html>
<head>
<title>Login BAND</title>
<link href="style.css" rel="stylesheet" type="text/css">
<style type="text/css">
body {
	background-image: url(bg5.jpg);
	background-repeat: repeat;
}
body,td,th {

}
</style>
<span style="font-family: 'Comic Sans MS', cursive, sans-serif">
<meta charset="utf-8">
</head>
<body>
<p align="center"><font size = "36" color='black'  >SOCIAL TUNE: GET INTO THE TUNE!</font></p>
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
          <a href="a_reg.php"> New Here? Sign Up</a></p>
    <p align="justify"><?php echo $error; ?>
    </div>
</p>
  </form>
</div>
</body>
</html>