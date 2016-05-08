<?php
 session_start();
include "connectdb.php";
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
<style type="text/css">
body {
	background-image: url(bg.jpg);
}
div label input {
   margin-right:100px;
}
body {
    font-family:sans-serif;
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
</style>
</head>

<body>
<div align="center">
  <p align="center"><font size = '36' color = 'red'>SOCIAL TUNE</font></p>
  <p>&nbsp;</p>
  <p align="center"><font size = "36" color = 'white'>WATCH YOUR FAVOURITE ARTIST PERFORM LIVE!</font> </p>
  <div align="center">
    <table width="285" height="168" border="1">
      <tbody>
        <tr>
        <form action ="" method = 'POST'>
          <td><label for="search">
            <div align="center">Search</div>
          </label>
            <div align="center">
              <p>
                <input name="text" type="text" id="text" placeholder="genre,band">
              </p>
              <p>
                <input type="submit" name="submit" id="submit" value="Submit">
              </p>
          </div></td>
        </tr>
      </tbody>
      </table>
  </div>
  </form>
  <p>&nbsp;</p>
       <?php
       $userid = $_SESSION['login_user'];
       if(!isset($_POST['submit']))
       {
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
echo"<form name = 'form1' Method = 'Post'>";
echo "<td>$cname</td><td>$vname</td><td>$bname</td><td>$concertdate</td><td>$starttime</td><td>$tickets</td><td>$price</td><br/>";
echo"<td><div id='ck-button'><label><input type='checkbox' name='cid[]' value=".$cid."><span>RSVP</span></label></div>
   </td>";
                     echo "</tr>\n";
		echo "</center>";
        }

        echo "</table>\n";
        }
            	echo"<input type='submit' name='submit2' id = 'submit2' >";
	echo "</center>";
    echo "</form>";

    if(isset($_POST['submit2']))
            {
              $int = $_POST['cid'];
            if($scor = $mysqli->prepare("SELECT score from user_info where userid = '$userid' "))
                {
                $scor->execute();
                $scor->bind_result($sco) ;
                $scor->store_result();
                $scor->fetch();
                echo $sco;
             }
                           else {
    echo "Error: " . $stmt . "<br>" . $mysqli->error;
}

              for ($i = 0 ; $i<sizeof($int) ; $i++)
              {
                $query = $mysqli->prepare("Insert into rsvp values('$userid','$int[$i]',now())");
                $query->execute();
                $query->store_result();
              }

                for ($i = 0 ; $i<sizeof($int) ; $i++)
             {
                if($score = $mysqli->prepare("UPDATE user_info SET score='$sco'+1 where userid ='$userid'"))
                {
                $score->execute();
                $score->store_result();
             }


                             else {
    echo "Error: " . $stmt . "<br>" . $mysqli->error;
}
             header("location:profile.php");



          }
          }
             }

    if(isset($_POST['submit'])){

        if (!empty($_REQUEST['text'])) {

$value = $mysqli->real_escape_string($_REQUEST['text']);
    if ($stmt =$mysqli->prepare("Select distinct cid,cname,vname,start_time,concert_date,concert.bname,tickets_sold,price from test.concert,test.taste,test.fan
 where (concert.gname LIKE CONCAT('%".$value."%')
    OR concert.bname LIKE CONCAT('%".$value."%')
    OR concert.cname LIKE CONCAT('%".$value."%'))"));

     {
//execute SQL query
        $stmt->execute();
        $stmt->bind_result($cid,$cname,$vname,$starttime,$concertdate,$bname,$tickets,$price);
        echo "<center>";
        echo "<table border = '1'>\n";
        while ($stmt->fetch()) {

echo"<center>";
echo "<tr>";
echo"<form name = 'form1' Method = 'Post'>";
echo "<td>$cname</td><td>$vname</td><td>$bname</td><td>$concertdate</td><td>$starttime</td><td>$tickets</td><td>$price</td><br/>";
echo"<td><div id='ck-button'><label><input type='checkbox' name='cid[]' value=".$cid."><span>RSVP</span></label></div>
   </td>";
                     echo "</tr>\n";
		echo "</center>";
        }

        echo "</table>\n";
        }

	echo"<input type='submit' name='submit2' id = 'submit2' >";
	echo "</center>";
    echo "</form>";


        $stmt->close();


	}


 if(isset($_POST['submit2']))
            {
              $int = $_POST['cid'];
              if($scor = $mysqli->prepare("SELECT score from user_info where userid = '$userid' "))
                {
                $scor->execute();
                $scor->bind_result($sco) ;
                $scor->store_result();
                $scor->fetch();
                echo $sco;
             }
                           else {
    echo "Error: " . $stmt . "<br>" . $mysqli->error;
}



              for ($i = 0 ; $i<sizeof($int) ; $i++)
              {
                $query = $mysqli->prepare("Insert into rsvp values('$userid','$int[$i]',now())");
                $query->execute();
                $query->store_result();
              }
              $query->close();
             for ($i = 0 ; $i<sizeof($int) ; $i++)
             {
                if($score = $mysqli->prepare("UPDATE user_info SET score='$sco'+ 1 where userid = '$userid' "))
                {
                $score->execute();

             }

                             else {
    echo "Error: " . $stmt . "<br>" . $mysqli->error;
}

             }
              header("location:profile.php");



 }
       }

      /* if(isset($_POST['submit2']))
            {
              $int = $_POST['subgenre'];
              $bn = $_POST['bname'];
              $gn = $_POST['genre'];

              for ($i = 0 ; $i<sizeof($int) ; $i++)
              {
                $query = $mysqli->prepare("Insert into taste values('".$userid."','".$gn[$i]."','".$int[$i]."',now())");
                $query->execute();
              }
       */
       ?>
</body>

</html>