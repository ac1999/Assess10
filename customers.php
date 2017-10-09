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
</head>

<body>
<h1>Boook store products</h1>

<?php
// Query Database
	$sql = "select bookISBN, bookTitle, LEFT(bookDescription , 100) AS bookDescriptionShort, bookPublisher, bookPublishDate, bookRRP
			from tblbooks
			order by bookISBN asc";
	$result = mysqli_query($connection, $sql);
//output data from each row
if(mysqli_num_rows($result) > 0){
	echo "<table style=\"border:1px solid black; border-collapse: collapse;\">";
	echo "<tr style=\"border:1px solid black;\"><th  style=\"border:1px solid black;\">Title</th><th style=\"border:1px solid black;\">Description</th><th style=\"border:1px solid black;\">Publisher</th><th style=\"border:1px solid black;\">Published On</th><th>RRP</th style=\"border:1px solid black;\"><th style=\"border:1px solid black;\">ISBN</th></tr>";
	while($row=mysqli_fetch_assoc($result)){
		echo"<tr style=\"border:1px solid black;\"><td style=\"border:1px solid black;\">$row[bookTitle]</td><td style=\"border:1px solid black;\">$row[bookDescriptionShort]</td><td  style=\"border:1px solid black;\">$row[bookPublisher]</td><td>$row[bookPublishDate]</td><td  style=\"border:1px solid black;\">$row[bookRRP]</td><td>$row[bookISBN]</td></tr>";
	}
	echo "</table>";
}
?>
</body>
</html>
