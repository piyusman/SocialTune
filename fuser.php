
<?php
session_start();
include "connectdb.php";
$s=$_SESSION['login_user'];
$ids = $_GET['id'];
?>
<!DOCTYPE html>
<html>
<head>
 <meta charset='utf-8'>
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <link rel="stylesheet" href="styles.css">
   <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
   <script src="script.js"></script>
<title>Your Home Page</title>
<link href="styl.css" rel="stylesheet" type="text/css">
<style type="text/css">
body {
	background-image: url(bg.jpg);
}
body,td,th {
	color: rgba(233,225,225,1);
}
.button-link {
    padding: 10px 15px;
    background: #4479BA;
    color: #FFF;
    -webkit-border-radius: 4px;
    -moz-border-radius: 4px;
    border-radius: 4px;
    border: solid 1px #20538D;
    text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.4);
    -webkit-box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.4), 0 1px 1px rgba(0, 0, 0, 0.2);
    -moz-box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.4), 0 1px 1px rgba(0, 0, 0, 0.2);
    box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.4), 0 1px 1px rgba(0, 0, 0, 0.2);
    -webkit-transition-duration: 0.2s;
    -moz-transition-duration: 0.2s;
    transition-duration: 0.2s;
    -webkit-user-select:none;
    -moz-user-select:none;
    -ms-user-select:none;
    user-select:none;
}
.button-link:hover {
    background: #356094;
    border: solid 1px #2A4E77;
    text-decoration: none;
}
.button-link:active {
    -webkit-box-shadow: inset 0 1px 4px rgba(0, 0, 0, 0.6);
    -moz-box-shadow: inset 0 1px 4px rgba(0, 0, 0, 0.6);
    box-shadow: inset 0 1px 4px rgba(0, 0, 0, 0.6);
    background: #2E5481;
    border: solid 1px #203E5F;
}
</style>
<meta charset="utf-8">
</head>
<body>
<table width="1200" height="1104" border="0">
  <tbody>
    <tr>
      <td width="491" height="195"><?php
      echo "<img src='img.php?id=".$ids."' height='500' width='400'>"; ?>

                                                                             </td>
      <td width="575"><label for="textarea">
        </label>
        <p align="right">
        <label for="textarea">
          <div align="left">
        <div align="left">
            <?php
			$id = $_SESSION['login_user'];
			$stm = $mysqli->prepare("SELECT fname,lname from user WHERE userid = '$ids'");
			$stm->execute();
			$stm->bind_result($fname,$lname);
			$stm->fetch();
            echo "<font size = '8' color='white'/>";
            $fname = strtoupper($fname);
			echo $fname;
            echo " ";
            $lname = strtoupper($lname);
			echo $lname;
            $stm->close();
            	$id = $_SESSION['login_user'];
			$rtm = $mysqli->prepare("SELECT gname from taste WHERE userid = '$ids'");
			$rtm->execute();
			$rtm->bind_result($gname);
            $rtm->store_result();
			while($rtm->fetch())
			{
            echo "<font color = 'red'/>" ;
            echo"&nbsp";
			echo "#";
			echo $gname;
            echo " ";
            }
            $rtm->close();
			?>
            <br>
          </div>
          </div>
        </label>
          <div align="right" >
            <p>&nbsp;</p>
            <p>      <form method = 'POST'>
              <input type="submit" name="submit2" id="submitbutton" value="FOLLOW" onclick="return changeText('submitbutton');">
           </form> </p>

          </div>
      </p>

      <?php
      if(isset($_POST['submit2']))
      {

        if($stmt=$mysqli->prepare("Insert into friends (followee,followed_by,date) values ('$ids','$s',now())"))
        {

          $stmt->execute();
$stmt->store_result();
    header("location:profile.php");
        }


          	   else {
    echo "Error: " . $stmt . "<br>" . $mysqli->error;
}
                    $stm->close();

      }
      ?>




    <tr>
      <td height="255">
       <?php

            	$id = $_SESSION['login_user'];
			$ktm = $mysqli->prepare("SELECT about_me from user_info WHERE userid = '$ids'");
			$ktm->execute();
			$ktm->bind_result($aname);
            $ktm->store_result();
			while($ktm->fetch())
			{
            echo "<font color = 'yellow'/>" ;
			echo "About HIM: ";
			echo $aname;
            echo " ";
            }
			?>
            <div id='cssmenu'></div>
      </td>
      <td><div align="center" id='cssmenu'><ul><li class='active'><a href="profile.php"><span>Home</span></a></li></ul></div></td>
      <td rowspan="2"><div align="center"></div></td>
    </tr>
    <tr>
      <td height="644">&nbsp;</td>
      <td><div align="center"><ul>
 <li class='active'><a href="profile.php"><span>Home</span></a></li></div></td>
    </tr>
  </tbody>
</table>
<p>&nbsp;</p>
</body>
</html>