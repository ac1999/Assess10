<!doctype html>
<html lang="en">
<head>

<meta charset="utf-8">
<title>Authors</title>
</head>
<body>
<div id="wrapper">
<header>
<img src="images/allauths.png" width="940" height="138" alt="Books"/>
</header>
<nav>
<ul id="nav">
    <li><a href="bookstore.html">Home</a></li>
	<li><a href="allbooks.php">All Books</a></li>
    <li><a href="categories.html">Categories</a></li>
    <li><a href="allpublishers.php">Publishers</a></li>
    <li><a href="#">Authors</a></li>
</ul>
</nav>
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
<div id="wrapper2">
<div id="wrapper3">
<?php
	$sql = "SELECT authorId, authorFname, authorLname FROM tblauthors";
	$result = mysqli_query($connection, $sql);
	if(mysqli_num_rows($result) > 0){
		echo "<table class=\"maintable\">";
		while($row=mysqli_fetch_assoc($result)){
			echo "<tr><th id=\"book\"><a href=\"authordetails.php?auth=$row[authorId]\">$row[authorFname] $row[authorLname]</th></tr>";
		}
	}		
?>
</div>
</div>
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
	width: 100%;
	border-radius: 5px;
	background-color: white;
	padding: 5px;
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
tr {
	font-size: 30px;
}
#nav {
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
</style>