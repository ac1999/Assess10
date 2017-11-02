<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Publisher Details</title>
</head>

<body>
<div id="wrapper">
<header>
<img src="images/bookss.png" width="940" height="138" alt="Books"/>
</header>
<nav>
<ul id="nav">
    <li><a href="bookstore.html">Home</a></li>
	<li><a href="allbooks.php">All Books</a></li>
    <li><a href="categories.html">Categories</a></li>
    <li><a href="allpublishers.php">Publishers</a></li>
    <li><a href="allauthors.php">Authors</a></li>
</ul>
</nav>
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
<div id="wrapper2">
<div id="wrapper3">
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
				echo"<th id=\"bookdesc\">$row[bookDescriptionShort] ...</th>";
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
</div>
</div>
</body>

<style>
h1 {
	color: #fff;
	text-align:center;
}
#book {
	width: 30%;
	border-top-left-radius: 5px;
	border-top-right-radius: 5px;
	background-color: white;
	padding: 5px;
}
#bookdesc {
	width: 30%;
	border-bottom-left-radius: 5px;
	border-bottom-right-radius: 5px;
	background-color: white;
	padding: 5px;
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
table {
	margin:auto;
}
#wrapper {
	width:940px;
	margin-left:auto;
	margin-right:auto;
	padding-left:20px;
	padding-right:20px;
	background-image:url(images/background.png);
}
ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
    overflow: hidden;
    background-color: #030;
}
li {
    float:left;
}
li a {
    display: block;
    color: white;
    text-align: center;
	padding: 14px 16px;
    text-decoration: none;
}
li a:hover {
	background-color:#090;
}
#wrapper2 {
	background-color:#030;
	width:100%;
	margin-top:10px;
	margin-bottom:10px;
	margin-right:2px;
	margin-left:2px;
	border-radius:5px;
	padding:2px;
}
#wrapper3 {
	margin-top:5px;
	margin-bottom:5px;
	margin-right:2px;
	margin-left:2px;
	border-radius:5px;
	padding:2px;
}
</style>