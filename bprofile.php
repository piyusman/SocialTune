
<?php
include('bsession.php');
include "connectdb.php";
$ids=$_SESSION['login_user'];
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
	background-image: url(bg5.jpg);
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
<span style="font-family: 'Comic Sans MS', cursive, sans-serif">
<table width="1200" height="1104" border="0">
  <tbody>
    <tr>
      <td width="250" height="195"><?php
      echo "<img src='aimg.php?id=".$ids."' height='380' width='250'>"; ?>

                                                                             </td>
      <td width="640"><label for="textarea">
        </label>
        <p align="right">
        <label for="textarea">
          <div align="left">
          <div align="left">
            <?php
			$id = $_SESSION['login_user'];
			$stm = $mysqli->prepare("SELECT bname from artist WHERE alogin_id = '$id'");
			$stm->execute();
			$stm->bind_result($bname);
			$stm->fetch();
            echo "<font size = '8' color='white'/>";
            $fname = strtoupper($bname);
			echo $fname;
            echo " ";

            $stm->close();
			?>
            <br>
          </div>
          </div>
        </label>
          <div align="right">
            <p align="left">
              <textarea name="textarea" cols="90" rows="6" id="textarea"></textarea>
              <input type="submit" name="Post" id="Post" value="Post">
            </p>
          </div>
      </p></td>
      <td width="230"><div align="center">
        
        </p>
        <p>&nbsp;</p>
        <p>&nbsp;</p>
        <p>&nbsp;</p>
        <p></p>
      </div></td>
    </tr>
    <tr>
      <td height="255">
       <?php
			$id = $_SESSION['login_user'];
			$rtm = $mysqli->prepare("SELECT gname from artist WHERE alogin_id = '$id'");
			$rtm->execute();
			$rtm->bind_result($gname);
			while($rtm->fetch())
			{
            echo "<font color = 'red'/>" ;
			echo "#";
			echo $gname;
            echo " ";
            }
			?>
            <div id='cssmenu'>
<ul>
 <li class='active'><a href="profile.php"><span>Home</span></a></li>
   <li><a href='reg_b2.php'><span>Change Profile Pic</span></a></li>
   <li><a href='reg_b2.php'><span>Edit Profile</span></a></li>
   <li><a href='#'><span>See Fans</span></a></li>
   <li></li>
   <p></p>
   <li><a href='editConcert.php'><span>Edit Concerts</span></a></li>
   <p></p>
   <li></li>
   <li><a href='a_concert.php'><span>Add Concerts</span></a></li>
   <li><a href='#'><span>Upload Pictures</span></a></li>
   <li><a href='#'><span>Upload Concert videos</span></a></li>
   <li class='last'><b id = "logout2" ><a href="logout.php"><span>Log Out</span></a></li>
</ul>
</div>
      </td>
      <td><div align="center"></div></td>
      <td rowspan="2"><div align="center"></div></td>
    </tr>
    <tr>
      <td height="644">&nbsp;</td>
      <td><div align="center"></div></td>
    </tr>
  </tbody>
</table>
<p>&nbsp;</p>
</body>
</html>