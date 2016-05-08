<?php
 session_start();
include "connectdb.php";
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
<link href="styl.css" rel="stylesheet" type="text/css">
<style type="text/css">
body {
	background-image: url(b10.jpg);
}
div label input {
   margin-right:100px;
}
body {
    font-family:sans-serif;
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
<span style="font-family: 'Comic Sans MS', cursive, sans-serif">
<div align="center">
  <p align="center"><font size = '36' color = 'red'>SOCIAL TUNE</font></p>
  <p>&nbsp;</p>
  <p align="center"><font size = "36" color = 'white'>Search For Your Favourite Band</font> </p>
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
                <input name="text" type="text" id="text" placeholder="fan">
              </p>
              <p>
                <input type="submit" name="submit" id="submit" value="Search">
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
    if ($stmt =$mysqli->prepare("Select alogin_id,bname
    FROM
    artist
WHERE
    bname LIKE CONCAT('%".$value."%')"))

     {

//execute SQL query
        $stmt->execute();
        $stmt->bind_result($aid,$bname);
        echo "<center>";
        echo "<table border = '1'>\n";
        while ($stmt->fetch()) {

echo"<center>";
echo "<tr>";
echo"<form name = 'form1' Method = 'Post'>";
echo "<td><img src='aimg.php?id=".$aid."' height='70' width='100'>";
echo "<input type ='hidden' name ='genre[]' value =".$aid.">";
echo "<td><div id ='button-link'><a href='fband.php?id=".$aid."'>$bname</a></div></td><br/>";
echo"<td><div id='ck-button'><label><input type='checkbox' name='bname[]' value=".$bname."><span>FAN</span></label></div>
   </td>";
                     echo "</tr>\n";
		echo "</center>";
        }

        echo "</table>\n";
        	echo"<input type='submit' name='submit2' id = 'submit2' >";
	echo "</center>";
    echo "</form>";


        $stmt->close();

	$mysqli->close();
	}
    }
    else
    {
    if ($stmt =$mysqli->prepare("Select alogin_id,bname
    FROM
    artist"))

     {

//execute SQL query
        $stmt->execute();
        $stmt->bind_result($aid,$bname);
        $stmt->store_result();
        echo "<center>";
        echo "<table border = '1'>\n";
        while ($stmt->fetch()) {

echo"<center>";
echo "<tr>";
echo"<form name = 'form1' Method = 'Post'>";
echo "<input type ='hidden' name ='genre[]' value =".$aid.">";
echo "<td><div id ='button-link'><a href='fband.php?id=".$aid."'>$bname</a></div></td><br/>";
echo"<td><div id='ck-button'><label><input type='checkbox' name='bname[]' value=".$bname."><span>FAN</span></label></div>
   </td>";
                     echo "</tr>\n";
		echo "</center>";
        }

        echo "</table>\n";
        	echo"<input type='submit' name='submit2' id = 'submit2' >";
	echo "</center>";
    echo "</form>";
    }
    }

    }

       if(isset($_POST['submit2']))
            {

              $int = $_POST['bname'];


              for ($i = 0 ; $i<sizeof($int) ; $i++)
              {
                $query = $mysqli->prepare("Insert into fan values('".$userid."','".$int[$i]."',now())");
                $query->execute();
              }
              // header("location:profile.php");
            }
       ?>
       <a href="profile.php">HOME></a>
</body>

</html>