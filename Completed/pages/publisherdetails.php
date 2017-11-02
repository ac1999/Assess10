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
	$counter = 4;
	if(isset($_GET['pub'])) {
		$publisher = $_GET['pub'];
		$sql = "select bookTitle, LEFT(bookDescription, 600) as bookDescriptionShort, bookISBN from tblbooks where bookPublisher = \"$publisher\" order by bookISBN asc";
		$result = mysqli_query($connection, $sql);
		if(mysqli_num_rows($result) > 0){
			echo "<table class=\"maintable\">";
			while($row=mysqli_fetch_assoc($result)){
				if($counter == 4) {
					echo"<h1>$publisher</h1>";
					$counter = 0;
				}
				echo"<tr>";
				echo"<th id=\"book\"><a href=\"bookdetails.php?isbn=$row[bookISBN]\"><h2>$row[bookTitle]</h2></th>";
				echo"</tr>";
				echo"<tr>";
				echo"<th id=\"book\">$row[bookDescriptionShort] ...</th>";
				echo"</tr>";
			}
			echo "</table>";
		}
	}
	else {
		echo"<h1>No Publisher found by that name</h1>";
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