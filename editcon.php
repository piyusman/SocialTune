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
	background-image: url(bg5.jpg);
}
</style>
</head>

<body text="#E0DADA">
<p>Add a Concert!</p>
<table width="1000" height="531" border="0">
  <tbody>
    <tr>
    <form method = "Post">
      <td width="532"><p align="right"><strong><cite>Name of the Band Organizing Concert
        <input type="text" name="bname" id="bname">
      </cite></strong></p>
      <p align="right"><cite><strong>Name of the Concert:
        <input type="text" name="concert" id="concert">
      </strong></cite></p>
      <p align="right"><cite><strong>Genre
        <input type="text" name="gname" id="gname">
      </strong></cite></p>
      <p align="right"><cite><strong>Date of Concert
        <input type="date" name="date" id="date">
      </strong></cite></p>
      <p align="right"><cite><strong>Time
        <input type="time" name="time" id="time">
      </strong></cite></p>
      <p align="right"><cite><strong>Venue
        <select name="venue" id="venue">
            <option value="BarclaysCenter">BarclaysCenter</option>
              <option>NokiaCenter</option>
              <option>Pilgrimage</option>
              <option>High</option>
              <option>Kimota</option>
            </select>
      </strong></cite></p>
      <p align="right"><cite><strong>Ticket Prices:
        <input type="text" name="price" id="textfield5">
      </strong></cite></p>
      <p align="right"><cite><strong>Total Tickets:
        <input type="text" name="total" id="textfield6">
      </strong></cite></p>
      <p align="right"><cite><strong>Ticket Link:
        <input type="text" name="link" id="textfield7">
      </strong></cite>      </p>
      <p align="right">
        <input type="submit" name="submit" id="submit" value="UPDATE">
      </p></td>

    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </tbody>
</table>
</form>
<p>&nbsp;</p>
<?php
if(isset($_GET['id']))
{
  $cid = $_GET['id'];
if (isset($_POST['submit']))
{

$id = $_SESSION['login_user'];
echo $id;
$cname=$_POST['concert'];
echo $cname;
$gname=$_POST['gname'];
echo $gname;

$bname=$_POST['bname'];
$cdate=$_POST['date'];
echo $cdate;

$time=$_POST['time'];
echo $bname;
$vname=$_POST['venue'];
$price = $_POST['price'];
$total = $_POST ['total'];
echo $vname; echo $price; echo $total; echo $time;echo $cid;
		if($stmt = $mysqli->prepare("UPDATE test.concert SET bname='$bname',cname='$cname',gname='$gname',concert_date='$cdate',start_time='$time',vname='$vname',price='$price',post_date=now(),tickets_sold='$total' where cid = '$cid' and added_by = '$id'"))
		{
            $stmt->execute();


            echo "Successful" ;

            header("location:bprofile.php");
		}
	   else {
    echo "Error: " . $stmt . "<br>" . $mysqli->error;
}


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