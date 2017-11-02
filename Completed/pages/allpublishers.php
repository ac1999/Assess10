<!doctype html>
<html lang="en">
<head>

<meta charset="utf-8">
<title>Publishers</title>
</head>
<body>
<div id="wrapper">
<a href="bookstore.html"><img id="home" src="images/home.png" alt="Home Button" width="60px" height="60px" align="left"></a>
<h1>All Publishers</h1>
<?PHP
// Setup variables
	include "sqldata.php";
// Create connection
	$connection = mysqli_connect($serverName, $username, $password, $database);
// Check connection
	if(!$connection) {
		die("Connection failed: " .mysqli_connect_error());
	}
?>
<?php
	$sql = "SELECT DISTINCT bookPublisher FROM tblbooks";
	$result = mysqli_query($connection, $sql);
	if(mysqli_num_rows($result) > 0){
		echo "<table class=\"maintable\">";
		while($row=mysqli_fetch_assoc($result)){
			echo "<tr><th id=\"book\"><a href=\"publisherdetails.php?pub=$row[bookPublisher]\">$row[bookPublisher]</th></tr>";
		}
	}		
?>
</div>
</body>
</html>
<style>
h1 {
	text-align:center;
	font-size:50px;
	text-transform:uppercase;
	font-family:Verdana, Geneva, sans-serif;
}
#book {
	border:solid thin #780116;
	width: 100%;
}
.maintable {
	table-layout: fixed;
	width: 100%;
}
table {
	margin:auto;
}
a {
	color:#000000;
	text-decoration:none;
	font-style:normal;
	font-family:Verdana, Geneva, sans-serif;
}
#wrapper {
	width:940px;
	margin-left:auto;
	margin-right:auto;
	padding-left:20px;
	padding-right:20px;
	background-image:url(images/background.png);
}
tr {
	font-size: 30px;
}
</style>