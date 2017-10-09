<!DOCTYPE html>
<html>
<head>

<?PHP
// Setup variables
	include "sqldata.php";
// Create connection
	$connection = mysqli_connect($serverName, $username, $password, $database);
// Check connection
	if(!$connection) {
		die("Connection failed: " .mysqli_connect_error());
	}
	echo "Connected successfully";
?>
<style>
table {
	border:1px solid black;
	border-collapse: collapse;
}
th{
	text.align:left;
	border:1px solid black;
}
tr{
	text.align:left;
	border:1px solid black;
}
td{
	text.align:left;
	border:1px solid black;
}
</style>
</head>

<body>
<h1>Boook store products</h1>

<?php
// Query Database
	$sql = "select bookISBN, bookTitle, LEFT(bookDescription , 40) AS bookDescriptionShort, bookPublisher, bookPublishDate, bookRRP
			from tblbooks
			order by bookISBN asc";
	$result = mysqli_query($connection, $sql);
//output data from each row
if(mysqli_num_rows($result) > 0){
	echo "<table>";
	echo "<tr><th>Title</th><th>Description</th><th>Publisher</th><th>Published On</th><th>RRP</th><th>ISBN</th></tr>";
	while($row=mysqli_fetch_assoc($result)){
		echo"<tr><td>$row[bookTitle]</td><td>$row[bookDescriptionShort]...</td><td>$row[bookPublisher]</td><td>$row[bookPublishDate]</td><td>$row[bookRRP]</td><td>$row[bookISBN]</td></tr>";
	}
	echo "</table>";
}
?>
</body>
</html>
