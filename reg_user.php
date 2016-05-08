 <?php
 session_start();
include "connectdb.php";
?>

<html>
<head>


<title>Registration Page</title>
<style type="text/css">
<!--
.style1 {
	font-size: 18px;
	font-weight: bold;
}
body {
	background-image: url(bg.jpg);
	background-repeat: repeat-x;
}
.regdiv form fieldset .style1 center {
	font-family: Lucida Grande, Lucida Sans Unicode, Lucida Sans, DejaVu Sans, Verdana, sans-serif;
}
.sd {
	font-family: Lucida Grande, Lucida Sans Unicode, Lucida Sans, DejaVu Sans, Verdana, sans-serif;
}
.kl {
	font-family: Constantia, Lucida Bright, DejaVu Serif, Georgia, serif;
}
body,td,th {
	color: rgba(224,205,205,1);
}
-->
</style>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>

<body bgcolor="#0099FF" class="kl">
<div align="left">
  <p align="center"><strong>Create your Account
  </strong></p>
</div>
<form action="" id = "login" method = "Post" >
<p>Name:</p>
<table width="545" border="0" class="style1">
  <tbody>
    <tr>
      <td width="178" height="52"><p>
        <input name="fname" type="text" class="style1" id="fname" placeholder="First" size="20" maxlength="20">
      </p></td>
      <td width="178"><p>
        <input name="lname" type="text" class="style1" id="lname" placeholder="Last" size="20" maxlength="20">
      </p></td>
      <td width="167">&nbsp;</td>
    </tr>
  </tbody>
</table>
<img src="images/7.jpg" width="194" height="259" alt=""/>
<p>Choose Your UserName                 </p>
<table width="373" border="0">
  <tbody>
    <tr>
      <td width="363"><input type="text" name="id" id="id"></td>
    </tr>
    <tr>
      <td><p>Password:</p></td>
    </tr>
    <tr>
      <td><p>
        <input name="pass" type="text" id="pass" placeholder="*********">
      </p>
        <p>Confirm Your Password:</p>
        <p>
          <input name="cpass" type="text" id="cpass" placeholder="*********">
      </p>
      <p>
        <label for="date">DOB:<br>
        </label>
        <input type="date" name="dob" id="dob">
      </p>
      <p>Gender:
        <input type="radio" name="sex" id="sex" value="male">
        Male
        <input type="radio" name="sex" id="sex" value="female">
        Female
      </p></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
    </tr>
  </tbody>
</table>
<table width="222" border="0">
  <tbody>
    <tr>
      <td width="216"><p>&nbsp;</p>
        <p align="right">
          <label for="textfield6">City:</label>
          <input type="text" name="city" id="city">
          State
          <input type="text" name="state" id="state">
          Country:
        :</p>
        <p align="right">
  <select name="country" size="01" id="country">
    <option>Usa</option>
    <option>India</option>
    <option>UK</option>
  </select>
  <label for="textfield9"><br>
    <br>
    Email Id::</label>
          <input type="text" name="email" id="email">
      </p></td>
    </tr>
  </tbody>
</table>
<p>&nbsp;</p>
<table width="237" height="40" border="0">
  <tbody>
    <tr>
      <td><div align="center">
        <input type="submit" name="submit" id="submit" value="Submit">
      </div></td>
    </tr>
  </tbody>
</table>
<p>
</form>
  <?php
if (isset($_POST['submit']))
{
$fname=$_POST['fname'];
$lname=$_POST['lname'];
$sex=$_POST['sex'];
$dob=$_POST['dob'];
$emid=$_POST['email'];
$country = $_POST['country'];
$city = $_POST ['city'];
$state = $_POST['state'];

$id=$_POST['id'];
$pass=$_POST['pass'];
$cpass=$_POST['cpass'];
	if($pass==$cpass)
	{

		if($stmt = $mysqli->prepare("insert into user (userid,password,fname,lname,gender,dob,city,state,country,email,date) values('$id','$pass','$fname','$lname','$sex','$dob','$city','$state','$country','$emid',now())"))
		{
            $stmt->execute();
            echo "Successful" ;
            $_SESSION['login_user']=$id;
           header("location:reg_user2.php");
		}
		else
		{
			echo "Please refill the form";
		}
        if($stmt = $mysqli->prepare("insert into test.login (userid,login,logout) values ('$id',now(),now())"))
{
  $stmt->execute();
}
 else {
    echo "Error: " . $stmt . "<br>" . $mysqli->error;
}

			}

else
{
	echo "password and confirm password does not match";
}
}
?>
</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
</body>
</html>
