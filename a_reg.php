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
<p>Give Your Identification number</p><input name="aid" type="text" class="style1" id="aid" placeholder="aid" size="20" maxlength="20">
<p>Band Name:</p><input name="band" type="text" class="style1" id="band" placeholder="bname" size="20" maxlength="20">
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
        <input name="pass" type="password" id="pass" placeholder="*********">
      </p>
        <p>Confirm Your Password:</p>
        <p>
          <input name="cpass" type="password" id="cpass" placeholder="*********">
      </p>
      <p>Genre<br><input type="text" name="gname" id="gname">
      </p>

      </td>
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
      </p><p><br>Hyperlink:<input type="text" name="hyper" id="hyper">
      </p>
      </td>
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
  $bname=$_POST['band'];
  $aid=$_POST['aid'];
$gname=$_POST['gname'];
$emid=$_POST['email'];
$country = $_POST['country'];
$city = $_POST ['city'];
$state = $_POST['state'];
         $hyper=$_POST['hyper'];
$id=$_POST['id'];
$pass=$_POST['pass'];
$cpass=$_POST['cpass'];
echo $aid;
	if($pass==$cpass)
	{
          echo "done";
    if($stm = $mysqli->prepare("select aid from test.permission where aid ='$aid'"))
    {
      $stm->execute();
       $stm->store_result();
      $stm->bind_result($a);
      $stm->fetch();

      echo $a;
      }
      if($a==$aid)
      {
		if($stmt = $mysqli->prepare("insert into artist (aid,bname,alogin_id,password,fname,lname,city,state,country,email,gname,hyperlink) values('$aid','$bname','$id','$pass','$fname','$lname','$city','$state','$country','$emid','$gname','$hyper')"))
		{
            $stmt->execute();
            $stmt->store_result();
            echo "Successful" ;
            $_SESSION['login_user']=$id;
           header("location:reg_b2.php");
		}
		else
		{
		     echo "Error: " . $stmt . "<br>" . $mysqli->error;
			echo "Please refill the form";
		}
     /*   if($stmt = $mysqli->prepare("insert into test.login (userid,login,logout) values ('$id',now(),now())"))
{
  $stmt->execute();
}
 else {
    echo "Error: " . $stmt . "<br>" . $mysqli->error;
}
       */
            }
            else
            {
              echo "Sorry You do not have perrmission to register as an artist";
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
