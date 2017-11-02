<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Publisher Details</title>
</head>

<body>
<div id="wrapper">
<a href="bookstore.html"><img id="home" src="images/home.png" alt="Home Button" width="60px" height="60px" align="left"></a>

<?php
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
	if(isset($_GET['auth'])) {
		$auth = $_GET['auth'];
		$sql2 = "SELECT authorFname, authorLname FROM tblauthors WHERE authorId = $auth";
		$result2 = mysqli_query($connection, $sql2);
		if(mysqli_num_rows($result2) > 0){
			while($row=mysqli_fetch_assoc($result2)){
				echo"<h1>$row[authorFname] $row[authorLname]</h1>";
			}
		}
	}
?>
<?php
	if(isset($_GET['auth'])) {
		$auth = $_GET['auth'];
		$sql = "select bookTitle, LEFT(bookDescription, 600) as bookDescriptionShort, bookISBN from tblbooks where bookISBN in(select bookISBN from tblbookauthors where authorID = $auth) order by bookISBN asc";
		$result = mysqli_query($connection, $sql);
		if(mysqli_num_rows($result) > 0){
			echo "<table class=\"maintable\">";
			while($row=mysqli_fetch_assoc($result)){
				echo"<tr>";
				echo"<th id=\"book\"><a href=\"bookdetails.php?isbn=$row[bookISBN]\"><h2>$row[bookTitle]</h2></th>";
				echo"</tr>";
				echo"<tr>";
				echo"<th id=\"book\">$row[bookDescriptionShort] ...</th>";
				echo"</tr>";
			}
			echo "</table>";
		}
		else {
		echo"<h1>No author found by that id</h1>";
		}
	}
	else {
		echo"<h1>No author id set</h1>";
	}
?>
</div>
</body>

<style>
h1 {
	text-align:center;
}
#book {
	border:solid thin;
}
a {
	color:#000;
}
.maintable {
	table-layout: fixed;
	width: 100%;
}
#wrapper {
	width:940px;
	margin-left:auto;
	margin-right:auto;
	padding-left:20px;
	padding-right:20px;
	background-image:url(images/background.png);
}
</style>