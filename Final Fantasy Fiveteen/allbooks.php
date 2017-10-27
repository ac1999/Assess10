<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>All Books</title>
</head>

<body>
<a href="index.html"><img id="home" src="images/home.png" alt="Home Button" width="60px" height="60px" align="left"></a>

<h1>All Books</h1>
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
	$counter = 0;
	$desc1;
	$desc2;
	$desc3;
	$sql = "select bookTitle, LEFT(bookDescription, 100) as bookDescriptionShort, bookISBN from tblbooks order by bookISBN asc";
	$result = mysqli_query($connection, $sql);
	if(mysqli_num_rows($result) > 0){
		echo "<table class=\"maintable\">";
		while($row=mysqli_fetch_assoc($result)){
			if($counter == 3) {
				echo"</tr>";
				$counter = 0;
				echo"<tr>";
				echo"<th id=\"book\">$desc1 ...</th>";
				echo"<th id=\"book\">$desc2 ...</th>";
				echo"<th id=\"book\">$desc3 ...</th>";
				echo"</tr>";
			}
			if($counter == 0) {
				echo"<tr>";
				$desc1 = $row[bookDescriptionShort];
			}
			if($counter == 1) {
				$desc2 = $row[bookDescriptionShort];
			}
			if($counter == 2) {
				$desc3 = $row[bookDescriptionShort];
			}
			echo"<th id=\"book\"><a href=\"bookdetails.php?isbn=$row[bookISBN]\"><h2>$row[bookTitle]</h2></th>";
			$counter++;
		}
		echo "</table>";
	}
?>
<style>
h1 {
	text-align:center;
	font-size:50px;
	text-transform:uppercase;
	font-family:Verdana, Geneva, sans-serif;
}
#book {
	border:solid thin #780116;
	width: 33%;
}
.maintable {
	table-layout: fixed;
	width: 100%;
}
a {
	color:#000000;
	text-decoration:none;
	font-style:normal;
	font-family:Verdana, Geneva, sans-serif;
}
a:hover {
	color:#C32F27;
}
table {
	margin:auto;
}
html {
	background-color:#F2AF29;
}
</style>
