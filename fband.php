

<?php
session_start();
include "connectdb.php";
$ids=$_GET['id'];
$s=$_SESSION['login_user'];
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
<table width="1200" height="1233" border="0">
  <tbody>
    <tr>
      <td width="515" height="326"><?php
      echo "<img src='aimg.php?id=".$ids."' height='400' width='600'>"; ?>

                                                                             </td>
      <td width="545"><label for="textarea">
        </label>
        <p align="right">
        <label for="textarea">
          <div align="left">
        <div align="left">
            <?php
			$id = $_GET['id'];

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
        <form method='POST'>
        <p align="right">&nbsp;        </p>
        <p align="right">
          <input type="submit" name="submit" id="submitbutton" value="BECOME A FAN" onclick="return changeText('submitbutton');">
        </p>
      </p></td>             </form>

      <?php
      if(isset($_POST['submit']))
      {
        $id = $_GET['id'];
			$stm = $mysqli->prepare("SELECT bname from artist WHERE alogin_id = '$id'");
			$stm->execute();
			$stm->bind_result($bname);
             $stm->store_result();
			$stm->fetch();



            echo "<font size = '8' color='white'/>";
        if($stmt=$mysqli->prepare("Insert into fan (userid,bname,date) values ('$s','$bname',now())"))
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


      <td width="126"><div align="center">
        <p>  <form action="user_search.php"></form>
        </p>
        <p>&nbsp;</p>
        <p>&nbsp;</p>
      </div></td>
    </tr>
    <tr>
      <td height="255">
      <?php
			$id = $_GET['id'];

			if($rtm = $mysqli->prepare("SELECT gname,about_me
            from artist,artistinfo
            WHERE artist.alogin_id = artistinfo.alogin_id AND artist.alogin_id = '$id'"))
            {
			$rtm->execute();
			$rtm->bind_result($gname,$about);
            $rtm->store_result() ;
			while($rtm->fetch())

			{
            echo "<font size ='16' color = 'yellow'/>" ;
			echo "#";
			echo $gname;
            echo "                                ";
             echo "<font size ='5' color = 'white'/>" ;
            echo "About Artist: ";echo $about;

            }
            }
                  	   else {
    echo "Error: " . $rtm . "<br>" . $mysqli->error;
}
			?></td>
      <td><div align="center" id='cssmenu'><ul><li class='active'><a href="profile.php"><span>Home</span></a></li></ul></div></td>
      <td rowspan="2"><div align="center">RECOMMENDED BANDS</div></td>
    </tr>
    <tr>
      <td height="644">&nbsp;</td>
      <td><div align="center">Latest Posts of People you are Following</div></td>
    </tr>
  </tbody>
</table>
<p>&nbsp;</p>
</body>
</html>