<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Book Details</title>
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
	if(isset($_GET['isbn'])) {
		$isbn = $_GET['isbn'];
		$imagepath = "images/books/$isbn".".jpg";
		
		echo "<aside>";
		echo "<img id=\"bookimage\" src=\"$imagepath\">";
		echo "</aside>";
	}
?>

<?php
	if(isset($_GET['isbn'])) {
		$sql = "select bookRRP, bookPages, bookEdition, bookInventory, bookPublishDate, bookPublisher, bookISBN, bookTitle, bookDescription from tblbooks where bookISBN = $isbn";
		$result = mysqli_query($connection, $sql);
		if(mysqli_num_rows($result) > 0){
			while($row=mysqli_fetch_assoc($result)){
				echo "<h1>$row[bookTitle]</h1>";
				echo "<p>$row[bookDescription]</p>";
				echo "<p>Publisher: <a href=\"publisherdetails.php?pub=$row[bookPublisher]\">$row[bookPublisher]</a></p>";
			}
		}
		else{
			echo "<h1>No book found with that isbn</h1>";
		}
		$sql2 = "select authorFName, authorLName from tblauthors where authorId IN(select authorID from tblbookauthors where $isbn = tblbookauthors.bookISBN)";
		$result2 = mysqli_query($connection, $sql2);
			if(mysqli_num_rows($result2) > 0){
				echo"<p>Author: ";
				while($row=mysqli_fetch_assoc($result2)){
					if ($counter > 0) {
						echo ", ";
					}
					echo "$row[authorFName] $row[authorLName]";
					$counter++;
				}
				echo"</p>";
			}
		$sql = "select bookRRP, bookPages, bookEdition, bookInventory, bookPublishDate, bookPublisher, bookISBN, bookTitle, bookDescription from tblbooks where bookISBN = $isbn";
		$result = mysqli_query($connection, $sql);
		if(mysqli_num_rows($result) > 0){
			while($row=mysqli_fetch_assoc($result)){
				echo "<p>Published on: $row[bookPublishDate]</p>";
				echo "<p>Edition: $row[bookEdition]</p>";
				echo "<p>Stock: $row[bookInventory]</p>";
				echo "<p>Pages: $row[bookPages]</p>";
				echo "<p>ISBN: $row[bookISBN]</p>";
				echo "<p>Price: $$row[bookRRP]</p>";
			}
		}
		else{
			echo "<h1>No book found with that isbn</h1>";
		}
	}
?>
</body>
</div>
<style>
h1 {
	text-align:center;
}
#Tab {
	border:solid thin;	
}
#Purchase {
	text-align:center;
	border:solid thin;
}
#wrapper {
	width:940px;
	margin-left:auto;
	margin-right:auto;
	padding-left:20px;
	padding-right:20px;
	background-image:url(images/background.png);
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
aside {
	float:left;
	background-color:#030;
	width:330px;
	hight: 420px;
	margin-top:10px;
	margin-bottom:10px;
	margin-right:5px;
	margin-left:2px;
	border-radius:5px;
	padding:2px;
}
#bookimage {
	width: 320px;
	height: 430px;
	display: block;
    margin: 0 auto;
}
</style>