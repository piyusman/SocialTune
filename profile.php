
<?php
include('session.php');
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
	background-image: url(bg12.jpg);
}
body,td,th {
	color: rgba(233,225,225,1);
}
#ck-button {
    margin:4px;
    background-color:#EFEFEF;
    border-radius:4px;
    border:1px solid #D0D0D0;
    overflow:auto;
    float:left;
}

#ck-button {
    margin:4px;
    background-color:#EFEFEF;
    border-radius:4px;
    border:1px solid #D0D0D0;
    overflow:auto;
    float:left;
}

#ck-button:hover {
    margin:4px;
    background-color:#EFEFEF;
    border-radius:4px;
    border:1px solid red;
    overflow:auto;
    float:left;
    color:red;
}

#ck-button label {
    float:left;
    width:4.0em;
}

#ck-button label span {
    text-align:center;
    padding:3px 0px;
    display:block;
}

#ck-button label input {
    position:absolute;
    top:-20px;
}

#ck-button input:checked + span {
    background-color:#911;
    color:#fff;
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
      echo "<img src='img.php?id=".$ids."' height='380' width='250'>"; ?>

                                                                             </td>
      <td width="640"><label for="textarea">
        </label>
        <p align="right">
        <label for="textarea">
          <div align="left">
          <div align="left">
            <?php
			$id = $_SESSION['login_user'];
			$stm = $mysqli->prepare("SELECT fname,lname from user WHERE userid = '$id'");
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
			?>
            <br>
          </div>
          </div>
        </label>     <form name = "form6" method = "POST">
          <div align="right">
            <p align="left">
              <textarea name="posted" cols="90" rows="6" id="textarea"></textarea>
              <input type="submit" name="post" id="post" value="Post">
            </p>
          </div>
                      </form>
      </p><?php
      $id = $_SESSION['login_user'];

               if(isset ($_POST['post']))
               {

                 $post = $_POST['posted'];
                 if(!empty($_POST['posted']))
                 {
                 if($que = $mysqli->prepare("Insert into test.post(pid,userid,msg,p_date) values('','$id','$post',now())"))
                 {
                 $que->execute();
                 $que->store_result();
                  }
                  else
                  {
                    echo "Error: " . $que . "<br>" . $mysqli->error;
                  }
                                }

                  }

      ?></td>
      <td width="230"><div align="center">
        <p><?php echo"<form name ='form3' method = 'Post'>
          <input name='text' type='text' id='text' placeholder='Search Friends'> ";
          echo"<input type='submit' name='submit' id='submit' value='Search'>     </form>";
          if(isset ($_POST['submit']))
          {
            $send = $_POST['text'];
            header("location:user_search.php?id=$send");
          }
          ?>
        </p>
        <p>&nbsp;</p>

        <p>Recommendations From Your Friends</p>
         <?php
       $userid = $_SESSION['login_user'];
       if ($stmt =$mysqli->prepare("Select distinct concert.cid,cname,vname,start_time,concert_date,concert.bname,tickets_sold,price
from test.concert,test.r_concert,test.friends
 where concert.cid in
(Select r_concert.cid from test.r_concert,test.friends where friends.followed_by='$userid' AND friends.followee = r_concert.userid)"))
     {
//execute SQL query
        $stmt->execute();
        $stmt->bind_result($cid,$cname,$vname,$starttime,$concertdate,$bname,$tickets,$price);
        $stmt->store_result();
        echo "<center>";
        echo "<table border = '1'>";
        while ($stmt->fetch()) {
echo"<center>";
echo "<tr>";
echo "<td>$cname</td><td>$vname</td><td>$bname</td><td>$concertdate</td><td>$starttime</td><td>$tickets</td><td>$price</td><br/>";
echo"";
                     echo "</tr>\n";
		echo "</center>";
        }

        echo "</table>\n";
        }
      ?>
      <p>&nbsp;</p>
      <p>TOP BAND</p>
      <?php
      $band = $mysqli->prepare("SELECT bname,count(userid) from test.fan
group by bname
 having
count(userid) =
(SELECT count(userid) from test.fan group by bname order by count(userid) DESC LIMIT 1)");

$band->execute();
$band->bind_result($bname,$fan);
$band->store_result();
$band->fetch();
echo $bname;echo" has "; echo $fan; echo "fans";
/*
$band = $mysqli->prepare("SELECT cname,count(userid) from test.rsvp,test.concert
group by cid
 having
count(userid) =
(SELECT count(userid) from test.rsvp group by cid order by count(userid) DESC LIMIT 1)")
  */
      ?>

      </div></td>
    </tr>
    <tr>
      <td height="255">
       <?php
			$id = $_SESSION['login_user'];
			$rtm = $mysqli->prepare("SELECT gname from taste WHERE userid = '$id'");
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
   <li><a href='editpic.php'><span>Edit Profile</span></a></li>
   <li><a href='edittaste.php'><span>Edit Taste</span></a></li>
   <li><a href='fan_search.php'><span>Become a Fan</span></a></li>
   <li><a href='rsvp.php'><span>RSVP Concert</span></a></li>
   <li></li>
   <p></p>
   <li><a href='rating.php'><span>Rate Concerts</span></a></li>
   <p></p>
   <li></li>
   <li><a href='add_concert.php'><span>Add Concerts</span></a></li>
   <li><a href='recommend.php'><span>Recommend Concerts</span></a></li>
   <li><a href='#'><span>See Your Level</span></a></li>
   <li class='last'><b id = "logout2" ><a href="logout.php"><span>Log Out</span></a></li>
</ul>
</div>
      </td>

      <td><div align="center">UPCOMING CONCERTS</div>
       <?php
       $userid = $_SESSION['login_user'];
       if ($stmt =$mysqli->prepare("Select distinct cid,cname,vname,start_time,concert_date,concert.bname,tickets_sold,price from test.concert,test.taste,test.fan
 where (fan.bname = concert.bname
 AND fan.userid = '$userid') or (taste.gname = concert.gname
 AND taste.userid = '$userid')"));

     {
//execute SQL query
        $stmt->execute();
        $stmt->bind_result($cid,$cname,$vname,$starttime,$concertdate,$bname,$tickets,$price);
        $stmt->store_result();
        echo "<center>";
        echo "<table border = '1'>\n";
        while ($stmt->fetch()) {

echo"<center>";
echo "<tr>";
echo "<td>$cname</td><td>$vname</td><td>$bname</td><td>$concertdate</td><td>$starttime</td><td>$tickets</td><td>$price</td><br/>";
echo"";
                     echo "</tr>\n";
		echo "</center>";
        }

        echo "</table>\n";
        }




          ?>
          </td>
      <td rowspan="2"><div align="center">RECOMMENDED BANDS</div></td>
    </tr>
    <tr>
      <td height="644">&nbsp;</td>
      <td><div align="center">Latest Posts of People you are Following</div>
      <?php
      if($bn= $mysqli->prepare("Select fname,lname,msg,p_date from test.friends,test.user,test.post where followed_by = '$userid' AND friends.followee = post.userid AND user.userid = friends.followee"))
      {
      $bn->execute();
      $bn->bind_result($fn,$ln,$msg,$p);
      $bn->store_result();
        echo "<center>";
        echo "<table border = '1'>\n";
        while ($bn->fetch()) {
      $fn = strtoupper($fn);
      $ln = strtoupper($ln);
echo"<center>";
echo "<tr>";
echo "<td>$fn $ln</td><td>$msg</td><td>$p</td><br/>";
echo"";
                     echo "</tr>\n";
		echo "</center>";
        }

        echo "</table>\n";
        }


      ?>
      </td>
    </tr>
  </tbody>
</table>
<p>&nbsp;</p>
</span>
</body>
</html>