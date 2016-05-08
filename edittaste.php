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
  <p align="center"><font size = "36" color = 'white'>Like your favourite Music</font> </p>
  <div align="center">
   <a href="addtaste.php">ADD ANOTHER GENRE</a>
  <p>&nbsp;</p>
       <?php
       $userid = $_SESSION['login_user'];

    if ($stmt =$mysqli->prepare("Select gname,subcategory
    FROM
    taste
WHERE userid = '$userid'"))

/*genre.gname = artist.gname AND
  //  (genre.gname LIKE CONCAT('%".$value."%')
    //OR artist.bname LIKE CONCAT('%".$value."%')
    //OR genre.subcategory LIKE CONCAT('%".$value."%'))"
    ))*/

     {
       $z =0;
//execute SQL query
        $stmt->execute();
        $stmt->bind_result($genre,$subgenre);
        echo "<center>";
        echo "<table border = '1'>\n";
        while ($stmt->fetch()) {

echo"<center>";
echo "<tr>";
echo"<form name = 'form1' Method = 'Post'>";
echo "<input type ='hidden' name ='genre[]' value =".$genre.">";
echo "<td>$genre</td><td>$subgenre</td><br/>";
echo"<td><div id='ck-button'><label><input type='checkbox' name='subgenre[]' value=".$subgenre."><span>DISLIKE</span></label></div>
   </td>";
                     echo "</tr>\n";
		echo "</center>";
        }

        echo "</table>\n";
  if($stm = $mysqli->prepare("Select distinct bname
    FROM
     fan
WHERE
userid ='$userid'"))
/* AND
    (genre.gname LIKE CONCAT('%".$value."%')
    OR artist.bname LIKE CONCAT('%".$value."%')
    OR genre.subcategory LIKE CONCAT('%".$value."%'))"
    ))*/
   {
   $stm->execute();
      $stm->bind_result($bname);
        echo "<center>";
        echo "<table border = '1'>\n";
        while ($stm->fetch()) {
echo"<center>";
echo "<tr>";
echo "<td>$bname<td>";
   echo"<td><div id='ck-button'><label><input type='checkbox' name = 'bname[]' value=".$bname."><span>DISLIKE</span></label></div>
   <p>&nbsp;</p></td><br/>";


	        echo "</tr>\n";
		echo "</center>";
        }

        echo "</table>\n";










   if($stmu = $mysqli->prepare("Select followee
    FROM
     friends
WHERE
followed_by ='$userid'"))
/* AND
    (genre.gname LIKE CONCAT('%".$value."%')
    OR artist.bname LIKE CONCAT('%".$value."%')
    OR genre.subcategory LIKE CONCAT('%".$value."%'))"
    ))*/
   {
   $stmu->execute();
      $stmu->bind_result($follow);
        echo "<center>";
        echo "<table border = '1'>\n";
        while ($stmu->fetch()) {
echo"<center>";
echo "<tr>";
echo "<td>$follow<td>";
   echo"<td><div id='ck-button'><label><input type='checkbox' name = 'follow[]' value=".$follow."><span>UNFRIEND</span></label></div>
   <p>&nbsp;</p></td><br/>";


	        echo "</tr>\n";
		echo "</center>";
        }

        echo "</table>\n";

        }
	echo"<input type='submit' name='submit2' id = 'submit2' >";
	echo "</center>";
    echo "</form>";



     }

	}

       if(isset($_POST['submit2']))
            {
              $int = $_POST['subgenre'];
              $bn = $_POST['bname'];
              $gn = $_POST['genre'];
              $fn = $_POST['follow'];
              for ($i = 0 ; $i<sizeof($int) ; $i++)
              {
                $query = $mysqli->prepare("DELETE from taste where userid = '$userid' AND gname = '$gn[$i]' AND subcategory = '$int[$i]' ");
                $query->execute();
                echo "success";
              }
               for ($i = 0 ; $i<sizeof($bn) ; $i++)
              {
                $que = $mysqli->prepare("DELETE from fan where userid ='$userid' AND bname ='$bn[$i]'");
                $que->execute();
              }
               for ($i = 0 ; $i<sizeof($fn) ; $i++)
              {
                $que = $mysqli->prepare("DELETE from friends where followee ='$fn[$i]' AND followed_by ='$userid'");
                $que->execute();
              }
       //       header("location:profile.php");
            }
       ?>
       <a href="profile.php">HOME</a>
</body>

</html>