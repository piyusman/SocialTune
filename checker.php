<?php

//
// DEFINE SOME KEY VARIABLES //
//

$stars = array("Terrible","Bad","Average","Good","Excellent"); // Array of the ratings' names (0-4)
$var = "id"; // field in table to match against $id, default "id" as it is set to this in the table creation below
$table = "ratings"; // the table to select ratings from, default "ratings" as in the table creation below
$star_width = 30; // width of each star in pixels (default 30px)
	
//
// ---------- END ---------- //
//

// YOU NEED TO CONNECT TO A MYSQL DATABASE //
//
// -- Start MySQL Connection -- //

$host = "localhost";
$db_username = "root";
$db_password = "";
$db_name = "test";
 
mysql_connect($host,$db_username,$db_password) or die(mysql_error());

mysql_select_db($db_name) or die("Could not connect to database: ".$db_name."");

// -- End MySQL Connection -- //

// *************************** //
// MySQL database table structure for Star Rating Script
// Run the following SQL code in PhpMyAdmin to create the ratings table
//
// CREATE TABLE IF NOT EXISTS `ratings` (				// Name of the table 'ratings'
//   `id` smallint(25) NOT NULL AUTO_INCREMENT,			// ID of the rate
//   `video_id` smallint(25) NOT NULL,					// ID of the thing being rated, in this case 'videoId'
//   `rating` smallint(15) NOT NULL,					// The rating submitted
//   `total_votes` int(11) NOT NULL,					// The total votes
//   `user_ip` varchar(35) NOT NULL,						// User's IP
//   PRIMARY KEY (`id`)
// ) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=93 ;
//
// ************************** //

// Gather user's IP function -- DO NOT EDIT -- //
function userIp(){
	if(getenv('HTTP_CLIENT_IP')) {
		$ip = getenv('HTTP_CLIENT_IP');
	}
	elseif(getenv('HTTP_X_FORWARDED_FOR')) {
		$ip = getenv('HTTP_X_FORWARDED_FOR');
	}
	elseif(getenv('HTTP_X_FORWARDED')) {
		$ip = getenv('HTTP_X_FORWARDED');
	}
	elseif(getenv('HTTP_FORWARDED_FOR')) {
		$ip = getenv('HTTP_FORWARDED_FOR');
	}
	elseif(getenv('HTTP_FORWARDED')) {
		$ip = getenv('HTTP_FORWARDED');
	}
	else {
		$ip = $_SERVER['REMOTE_ADDR'];
	}
	return $ip;
}
// ---------- EDIT BELOW HERE IF NECESSARY -- //


function rating_bar($id){
	
	global $stars, $var, $table, $star_width;
	
	$id = (int)$id;
	$pos = strpos($_SERVER["REQUEST_URI"],"?")-1;
	if($pos > 0){
		$page = substr($_SERVER["REQUEST_URI"],1,$pos);
	} else {
		$page = substr($_SERVER["REQUEST_URI"],1);
	}
	$total_votes = 0;
	$rating = 0;
	$avg = 0;
	$ip_num = userIp();
	$userip = array();
	$voted = false;
		
	if($id && $table){
		$sql = mysql_query("SELECT * FROM ".$table." WHERE ".$var." = '$id' LIMIT 1") or die(mysql_error());
		if(mysql_num_rows($sql) > 0){
			$row = mysql_fetch_assoc($sql);
			$total_votes = $row['total_votes'];
			$rating = $row['rating'];
			//$avg = number_format($total_votes/$rating,1);
			if(!empty($row['user_ip'])){
				$userip = unserialize($row['user_ip']);
				if(!$userip){
					$userip = array();
				}
			}
		} else {
			$insert = mysql_query("INSERT INTO ".$table." (".$var.") VALUES ('$id')") or die(mysql_error());
		}
		if(is_array($userip) && !in_array($ip_num,$userip)){
			((is_array($userip)) ? array_push($userip,$ip_num) : $userip=array($ip_num));
			$insertip=serialize($userip);
			if(isset($_GET['r'])){
				$rate = (int)$_GET['r'];
				if($rate){
					$total_votes+=1;
					$rating += $rate;
					$update = mysql_query("UPDATE ".$table." SET total_votes = '$total_votes', rating = '$rating', user_ip = '".$insertip."' WHERE ".$var." = '$id'") or die(mysql_error());
					$voted = true;
				}
			}
		} else {
			$voted = true;
		}
		if($total_votes > 0){
			$star_count = round($rating / $total_votes);
			$rating_text = $stars[$star_count-1];
		} else {
			$star_count = 0;
			$rating_text = "Rate Me...";	
		}
		echo 'Item ' . $id . '';
		echo '<div id="rateMe" title="'.$rating_text.'"';
		if(!$voted){ echo 'onmouseover="alterDisplay(\'rate_overlay\')" onmouseout="alterDisplay(\'rate_overlay\')"'; }
		echo '>';
		if($star_count > 0){
			$width = $star_count * $star_width;
			echo '<div id="rate_overlay" style="width:'.$width.'px"></div>';
		}
		if($voted){
		echo '
					<a id="_1" class="grey"></a>
					<a id="_2" class="grey"></a>
					<a id="_3" class="grey"></a>
					<a id="_4" class="grey"></a>
					<a id="_5" class="grey"></a>';
		} else {
		echo '
					<a onclick="insertParam(\'r\',1)" id="_1" title="Terrible" onmouseover="rating(this)" onmouseout="off(this)"></a>
					<a onclick="insertParam(\'r\',2)" id="_2" title="Bad" onmouseover="rating(this)" onmouseout="off(this)"></a>
					<a onclick="insertParam(\'r\',3)" id="_3" title="Average" onmouseover="rating(this)" onmouseout="off(this)"></a>
					<a onclick="insertParam(\'r\',4)" id="_4" title="Good" onmouseover="rating(this)" onmouseout="off(this)"></a>
					<a onclick="insertParam(\'r\',5)" id="_5" title="Excellent" onmouseover="rating(this)" onmouseout="off(this)"></a>';
		}
		echo '<div id="rateStatus">'.$rating_text.'';
		echo '</div>';
		if($star_count > 0){
			echo '<div id="rateVotes">'.$star_count.'/5 from '.$total_votes.' votes</div>';
		}
		echo '</div>';
	}
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Javascript &amp; PHP Star Rating Script Demo - bgallz.org</title>
<script type="text/javascript">
function insertParam(key, value)
{
key = escape(key); value = escape(value);
var kvp = document.location.search.substr(1).split("&");
var i=kvp.length; var x; while(i--)
{
x = kvp[i].split("=");
if (x[0]==key)
{
x[1] = value;
kvp[i] = x.join("=");
break;
}
}
if(i<0) {kvp[kvp.length] = [key,value].join("=");}
//this will reload the page, it's likely better to store this until finished
document.location.search = kvp.join("&");
}
function alterDisplay(id){
var dropdown = document.getElementById(id);
if(dropdown.style.display == "none"){
dropdown.style.display = "";
} else {
dropdown.style.display = "none";
}
}
</script>
<script type="text/javascript" language="javascript" src="./scripts/ratingsys.js"></script>
<link type="text/css" href="./sty.css" rel="stylesheet" />
</head>
<body>
<h1>Star Rating Script from <a href="http://bgallz.org/988/javascript-php-star-rating-script/" target="_blank" title="Permalink for Javascript &amp; PHP Star Rating Script">bgallz.org</a></h1>
<p>In order to use this Star Rating Script you will need to be connected to a MySQL database.</p>
<p>Check the source code for the global variables you should edit (not all are necessary) as well as the MySQL database connection definitions.</p>
<p>&nbsp;</p>
<p>
<?php
if(isset($_GET['id'])){
	$id = (int)$_GET['id'];	
} else { $id = 1; }
rating_bar($id);
?>
<p>&nbsp;</p>
<p style="font-size:11px; clear:both">Check out this great free script and many others at <a href="http://bgallz.org/" target="_blank">bgallz.org</a> now!</p>
<p align="center">
<div class="rate_on_button"><a href="./index.php?id=1">Rate on Item 1</a></div>
<div class="rate_on_button"><a href="./index.php?id=2">Rate on Item 2</a></div>
<div class="rate_on_button"><a href="./index.php?id=3">Rate on Item 3</a></div>
<div class="rate_on_button"><a href="./index.php?id=4">Rate on Item 4</a></div>
</p>
</body>
</html>