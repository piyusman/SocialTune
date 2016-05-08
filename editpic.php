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
</style>
</head>

<body>
<span style="font-family: 'Comic Sans MS', cursive, sans-serif">
<div align="center">
  <p>&nbsp;</p>
  <p><font size = '36' color = 'red'>SOCIAL TUNE</font></p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>

  <p><font size = "36" color = 'white'>Edit Your Profile</font>
  </p>
  <form name = 'form' enctype="multipart/form-data" form method="POST" id = "reg" >
  <p>&nbsp;</p>
  <table width="396" height="289" border="0">
    <tbody>
      <tr>
        <td width="386"><p><font color = 'white'>Upload Picture:</font>
          </p>
          <p>
            <input type="file" name="image" id="image">
          </p>
        <p>&nbsp;</p>
        <p align="left"><font color = 'white'>Right Some thing ABOUT YOU:</font></p>
        <p>
  <textarea name="about" cols="50" rows="10" maxlength="100" wrap="soft" id="about"></textarea>
        </p>
        <p align="center">
          <input type="submit" name="submit" id="submit" value="Submit">
        </p></td>
      </tr>
    </tbody>
  </table>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp; </p>
</div>
</form>

<?php
 $id = $_SESSION['login_user'];
  echo $id;
if (isset($_POST['submit']))
{

          $about=$_POST['about'];
          $image=$mysqli->real_escape_string($_FILES["image"]["name"]);
          $data =$mysqli->real_escape_string(file_get_contents($_FILES["image"]["tmp_name"]));
          $type = $mysqli->real_escape_string($_FILES["image"]["type"]);

	if($stmt = $mysqli->prepare("UPDATE user_info SET picture='$image',about_me='$about' where userid='$id'"))
		{
            $stmt->execute();
            echo "Successful" ;

		}
		else
		{
			echo "Please refill the form";
		}


          if(substr($type,0,5) =="image")
          {
	      if($stm = $mysqli->prepare("UPDATE images SET name = '$image' , image='$data' where userid = '$id'"))
		{
            $stm->execute();
            echo "Successful" ;
            header("location:profile.php");
		}
		else
		{
			echo "Please refill the form";
		}
}
                        }
?>
</body>

</html>