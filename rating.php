<?php
session_start();
include "connectdb.php";
$id = $_SESSION['login_user'];
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8(no BOM)">
<title>Untitled Document</title>

<style type="text/css">
body {
	background-image: url(bg5.jpg);
}
.donate-now {
     list-style-type:none;
     margin:25px 0 0 0;
     padding:0;
}

.donate-now li {
     float:left;
     margin:0 5px 0 0;
    width:100px;
    height:40px;
    position:relative;
}

.donate-now label, .donate-now input {
    display:block;
    position:absolute;
    top:0;
    left:0;
    right:0;
    bottom:0;
}

.donate-now input[type="radio"] {
    opacity:0.01;
    z-index:100;
}

.donate-now input[type="radio"]:checked + label,
.Checked + label {
    background:yellow;
}

.donate-now label {
     padding:5px;
     border:1px solid #CCC;
     cursor:pointer;
    z-index:90;
}

.donate-now label:hover {
     background:#DDD;
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

.star-rating{
  font-size:0;
  white-space:nowrap;
  display:inline-block;
  width:250px;
  height:50px;
  overflow:hidden;
  position:relative;
  background:
      url('data:image/svg+xml;utf-8,<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="20px" height="20px" viewBox="0 0 20 20" enable-background="new 0 0 20 20" xml:space="preserve"><polygon fill="#DDDDDD" points="10,0 13.09,6.583 20,7.639 15,12.764 16.18,20 10,16.583 3.82,20 5,12.764 0,7.639 6.91,6.583 "/></svg>');
  background-size: contain;
  i{
    opacity: 0;
    position: absolute;
    left: 0;
    top: 0;
    height: 100%;
    width: 20%;
    z-index: 1;
    background:
        url('data:image/svg+xml;utf-8,<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="20px" height="20px" viewBox="0 0 20 20" enable-background="new 0 0 20 20" xml:space="preserve"><polygon fill="#FFDF88" points="10,0 13.09,6.583 20,7.639 15,12.764 16.18,20 10,16.583 3.82,20 5,12.764 0,7.639 6.91,6.583 "/></svg>');
    background-size: contain;
  }
  input{
    -moz-appearance:none;
    -webkit-appearance:none;
    opacity: 0;
    display:inline-block;
    width: 20%;
    height: 100%;
    margin:0;
    padding:0;
    z-index: 2;
    position: relative;
    &:hover + i,
    &:checked + i{
      opacity:1;
    }
  }
  i ~ i{
    width: 40%;
  }
  i ~ i ~ i{
    width: 60%;
  }
  i ~ i ~ i ~ i{
    width: 80%;
  }
  i ~ i ~ i ~ i ~ i{
    width: 100%;
  }
}

//JUST COSMETIC STUFF FROM HERE ON. THESE AREN'T THE DROIDS YOU ARE LOOKING FOR: MOVE ALONG.

//just styling for the number
.choice{
  position: fixed;
  top: 0;
  left:0;
  right:0;
  text-align: center;
  padding: 20px;
  display:block;
}

//reset, center n shiz (don't mind this stuff)
*, ::after, ::before{
  height: 100%;
  padding:0;
  margin:0;
  box-sizing: border-box;
  text-align: center;
  vertical-align: middle;
}
body{
  font-family: "HelveticaNeue-Light", "Helvetica Neue Light", "Helvetica Neue",
  Helvetica, Arial, "Lucida Grande", sans-serif;
  &::before{
    height: 100%;
    content:'';
    width:0;
    background:red;
    vertical-align: middle;
    display:inline-block;
  }
}
</style>
</head>

<body>
<strong class="choice">Choose a rating</strong>

<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<?php
if($query = $mysqli->prepare("select rsvp.cid,cname,bname,vname,concert_date
from test.concert,test.login,test.rsvp
where rsvp.cid = concert.cid
AND rsvp.userid = '$id'
AND
rsvp.userid = login.userid
AND DATEDIFF(concert.concert_date,login.logout)>0 AND DATEDIFF(now(),concert.concert_date)>0"))
{
                    $i = 0;
$query->execute();
$query->bind_result($cid,$cname,$bname,$vname,$date);
while($query->fetch())
{
echo $id;
echo "<form name = 'form5'  method = 'POST'>";
echo "<input type ='hidden' name ='cid[]' value =".$cid.">";
echo "  How was ".$cname." played by ".$bname." at ".$vname." on ".$date;
echo" <align = 'center'>
<ul class='donate-now'>
<li>
    <input type='radio' id='a1[".$i."]' name='rate[".$i."]' value = '1' />
    <label for='a1[".$i."]'>1 Star</label>
</li>
<li>
    <input type='radio' id='a2[".$i."]' name='rate[".$i."]' value = '2' />
    <label for='a2[".$i."]'>2 Star</label>
</li>
<li>
    <input type='radio' id='a3[".$i."]' name='rate[".$i."]' value = '3'/>
    <label for='a3[".$i."]'>3 Star</label>
</li>
<li>
    <input type='radio' id='a4[".$i."]' name='rate[".$i."]' value = '4' />
    <label for='a4[".$i."]'>4 Star</label>
</li>
<li>
    <input type='radio' id='a5[".$i."]' name='rate[".$i."]' value = '5' />

    <label for='a5[".$i."]'>5 Star</label>
</li>

<li>

</li>
</ul>";
 echo "<p>&nbsp;</p>   <br><br>
             <p>
               <label for='textarea[".$i."]'>Tell us about the Concert:<br>
               </label>
               <textarea name='review[]' cols='50' rows='3' id='textarea[".$i."]'></textarea>
             </p>";

$i = $i+1;
echo "<p>&nbsp;</p>
<p>&nbsp;</p>";


       }
       }

echo"<input type='submit' name='submit' id = 'submit' >";
echo "</form>";

if(isset ($_POST['submit']))
   {
     $id=$_SESSION['login_user'];
$int = $_POST['rate'];
$re = $_POST['review'];
$ci = $_POST['cid'];
 if($scor = $mysqli->prepare("SELECT score from user_info where userid ='$id' "))
                {
                $scor->execute();
                $scor->bind_result($sco) ;
                $scor->store_result();
                $scor->fetch();
                echo $sco;
             }
for ($i = 0 ; $i<sizeof($int) ; $i++)
{
            if($stm=$mysqli->prepare("insert into review (cid,userid,rating,review,date) values ('$ci[$i]','$id','$int[$i]','$re[$i]',now())"))
            {
            $stm->execute();
            echo $ci[$i];
            echo $int[$i];
            echo "successfull";
            }
 }
 for ($i = 0 ; $i<sizeof($int) ; $i++)
{
  if($scor = $mysqli->prepare("SELECT score from user_info where userid ='$id' "))
                {
                $scor->execute();
                $scor->bind_result($sco) ;
                $scor->store_result();
                $scor->fetch();
                echo $sco;
             }
            if($stmr=$mysqli->prepare("UPDATE user_info SET score = '$sco' +1 where userid = '$id'"))
            {
            $stmr->execute();
            $stmr->store_result();
            }
 }
      // header("location:profile.php");
 }
 // header("location:profile.php");
?>
   <a href = "profile.php">Back</a href>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>



</body>
</html>