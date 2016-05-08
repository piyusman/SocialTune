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
  <p align="center"><font size = "36" color = 'white'>Getting Started: Like your favourite Music</font> </p>
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
      if(isset($_POST['submit'])){

        if (!empty($_REQUEST['text'])) {

$value = $mysqli->real_escape_string($_REQUEST['text']);
    if ($stmt =$mysqli->prepare("Select distinct genre.gname,genre.subcategory
    FROM
    genre,artist
WHERE
genre.gname = artist.gname AND
    (genre.gname LIKE CONCAT('%".$value."%')
    OR artist.bname LIKE CONCAT('%".$value."%')
    OR genre.subcategory LIKE CONCAT('%".$value."%'))"
    ))

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
echo"<td><div id='ck-button'><label><input type='checkbox' name='subgenre[]' value=".$subgenre."><span>Like</span></label></div>
   </td>";
                     echo "</tr>\n";
		echo "</center>";
        }

        echo "</table>\n";
  if($stm = $mysqli->prepare("Select distinct artist.bname
    FROM
    genre,artist
WHERE
genre.gname = artist.gname AND
    (genre.gname LIKE CONCAT('%".$value."%')
    OR artist.bname LIKE CONCAT('%".$value."%')
    OR genre.subcategory LIKE CONCAT('%".$value."%'))"
    ))
   {
   $stm->execute();
      $stm->bind_result($bname);
        echo "<center>";
        echo "<table border = '1'>\n";
        while ($stm->fetch()) {
echo"<center>";
echo "<tr>";
echo "<td>$bname<td>";
   echo"<td><div id='ck-button'><label><input type='checkbox' name = 'bname[]' value=".$bname."><span>Fan</span></label></div>
   <p>&nbsp;</p></td><br/>";


	        echo "</tr>\n";
		echo "</center>";
        }

        echo "</table>\n";
        }

	echo"<input type='submit' name='submit2' id = 'submit2' >";
	echo "</center>";
    echo "</form>";


        $stmt->close();

	$mysqli->close();
	}

}
       }
       if(isset($_POST['submit2']))
            {
              $int = $_POST['subgenre'];
              $bn = $_POST['bname'];
              $gn = $_POST['genre'];

              for ($i = 0 ; $i<sizeof($int) ; $i++)
              {
                $query = $mysqli->prepare("Insert into taste values('".$userid."','".$gn[$i]."','".$int[$i]."',now())");
                $query->execute();
              }
               for ($i = 0 ; $i<sizeof($bn) ; $i++)
              {
                $que = $mysqli->prepare("Insert into fan values('".$userid."','".$bn[$i]."',now())");
                $que->execute();
              }
              header("location:profile.php");
            }
       ?>
</body>

</html>