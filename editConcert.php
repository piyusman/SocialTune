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

</head>

<body>
<div align="center">
  <p align="center"><font size = '36' color = 'red'>MUSICALA</font></p>
  <p>&nbsp;</p>
  <p align="center"><font size = "36" color = 'white'>Edit/Delete Concert</font> </p>
  <div align="center">
    <table width="285" height="168" border="1">
      <tbody>
        <tr>
        <form name ='form' method = 'POST'>
          <td><label for="search">
            <div align="center">Give concert cid</div>
          </label>
            <div align="center">  <form Method = Post>
              <p>
                <input name="text" type="text" id="text" placeholder="concert number">
              </p>
              <p>
                <input type="submit" name="submit1" id="submit1" value="Edit">
              </p>
              <p>
               <input type="submit" name="submit2" id="submit2" value="Delete">

              </p>
                               </form>
          </div></td>
          </form>
        </tr>
      </tbody>
      </table>
  </div>


  <p>&nbsp;</p>
       <?php
       $userid = $_SESSION['login_user'];

      if(isset($_POST['submit1'])){

        if (!empty($_REQUEST['text'])) {

$value = $mysqli->real_escape_string($_REQUEST['text']);
    if ($stmt =$mysqli->prepare("Select cid from concert where added_by = '$userid' and cid = '$value'"))

     {

//execute SQL query
        $stmt->execute();
        $stmt->bind_result($cid);
        $stmt->fetch();
        echo $cid;
       header("location:editcon.php?id=$cid ");
        }
                    else {
    echo "Error: " . $stmt . "<br>" . $mysqli->error;
}
                            }
                            else
                            {
                              echo "Please give a number";
                            }
                            }


          if(isset($_POST['submit2'])){

        if (!empty($_REQUEST['text'])) {

$value = $mysqli->real_escape_string($_REQUEST['text']);
    if ($stmt =$mysqli->prepare("Select cid from concert where added_by = '$userid' and cid = '$value'"))

     {

//execute SQL query
        $stmt->execute();
        $stmt->bind_result($cid);
$stmt->fetch();

$stmt->store_result();
     $stmt->close();
     }
        if($query = $mysqli->prepare("Delete from concert where cid ='$cid'"))
        {
        $query->execute();
        echo "Concert successfully Deleted";
        }
         else {
    echo "Error: " . $query . "<br>" . $mysqli->error;
}
        }
         else {
    echo "Error: " . $query . "<br>" . $mysqli->error;
}
        }
         else
                            {
                              echo "Please give a number";
                            }


       ?>
</body>

</html>