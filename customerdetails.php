<!DOCTYPE html>
<html>
<head>

<?PHP
// Setup variables
	include "sqldata2.php";
// Create connection
	$connection = mysqli_connect($serverName, $username, $password, $database);
// Check connection
	if(!$connection) {
		die("Connection failed: " .mysqli_connect_error());
	}
	echo "Connected successfully";
?>
<title>Book Details</title>
<link rel="stylesheet" href="https://www.w3schools.com/lib/w3.css">
<meta charsheet="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
#wrapper {
	width:70%;
	margin:0 auto;
}
</style>
</head>
<body>
<div id="wrapper" class="w3-container">
<?php
if(isset($_GET['BID'])){
	$id = $_GET['BID'];
	$sql = "select * from customers where cust_no = '$id'";
	$result = mysqli_query($connection,$sql);
	if(mysqli_num_rows($result) > 0){
		while($row=mysqli_fetch_assoc($result)){
			echo"<h2>Customer Details for $row[cust_name]</h2>";
			echo"<table><tr><td>
			<b>Customer Number:</b> $row[cust_no]</br>
			<b>Customer Name:</b> $row[cust_name]</br>
			<b>Customer Address:</b> $row[street] $row[town]</br>
			<hr>
			<b>Credit Limit:</b> $$row[cr_limit]</br>
			<b>Current Balance:</b> $$row[curr_bal]</br>
			<b>Available Balance:</b> $".($row[cr_limit]-$row[curr_bal])."</td></tr></table>";
		}
	}
	$sql = "select count(*) as 'orders' from orders where cust_no = '$id' group by cust_no";
	$result = mysqli_query($connection,$sql);
	if(mysqli_num_rows($result) > 0){
		while($row=mysqli_fetch_assoc($result)){
			echo"<h2>Order Summary</h2>";
			echo"<table>";
			echo"<tr><td><b>Total Number of Orders:</b> $row[orders]</td></tr>";
			echo"</table>";
		}
	}
	$sql = "select sum(order_qty*order_price) as 'totalValue' from orders o, order_details od where o.order_no = od.order_no and o.cust_no = '$id' group by o.cust_no";
	$result = mysqli_query($connection,$sql);
	if(mysqli_num_rows($result) > 0){
		while($row=mysqli_fetch_assoc($result)){
			echo"<table>";
			echo"<tr><td><b>Total price of Orders: </b> $row[totalValue]</td></tr>";
			echo "</table>";
		}
	}
	$sql = "select sum(order_qty*order_price) as totalValue from orders o, order_details od where o.order_no = od.order_no and o.cust_no = '$id' group by o.cust_no";
	$result = mysqli_query($connection,$sql);
	if(mysqli_num_rows($result)>0){
		while($row=mysqli_fetch_assoc($result)){
			echo"<table>";
			echo"<tr><td>Total Value of Orders: $$row[totalValue]</td></tr>";
			echo"</table>";
		}
	}
	$sql = "select * from orders where cust_no = $id order by order_date asc";
	$result = mysqli_query($connection,$sql);
	if(mysqli_num_rows($result)>0){
		echo "<h2>Order History</h2>";
		echo "<table>";
		echo "<tr><th>Order Date</th><th>Order No</th></tr>";
		while($row=mysqli_fetch_assoc($result)){
			echo "<tr><td>$row[order_date]</td><td><a href=order_details.php?customer=$id&order=$row[order_no]>$row[order_no]</a></td></tr>";
		}
		echo "</table>";
	}
	else{
		echo"<h2>No orders made yet</h2>";
	}
	echo"<p>Back to <a href=customers.php>Customers</a></p>";
}
else{
	echo "<h2>No details available</h2>";
}


$connection.close();
?>
</div>
</body>
</html>
