<?php
/*include "connectdb.php";
    if(isset($_GET['id']))
    {
      $id = $_GET['id'];
              $query = mysql_query("Select * from storeimages where id = '$id'");
              while($row = mysql_fetch_assoc($query))
              {
                $data = $row["image"];
              }
              header("content-type: image/jpeg");
              echo $data;
    }
?>*/

    $mysqli=mysqli_connect('localhost','root','','test');


    if (!$mysqli)
        die("Can't connect to MySQL: ".mysqli_connect_error());


    if(isset($_GET['id']))
    {
      $id = $_GET['id'];

    $stmt = $mysqli->prepare("SELECT image FROM images WHERE userid=?");
    $stmt->bind_param("s", $id);

    $stmt->execute();
    $stmt->store_result();

    $stmt->bind_result($image);
    $stmt->fetch();

    header("Content-Type: image/jpeg");
    echo $image;
    }
?>