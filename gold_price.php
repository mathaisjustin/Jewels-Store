<!DOCTYPE html>
<html>
<head>
	<title>Update Gold Price</title>
</head>
<body>
	<h1>Update Gold Price</h1>
	<form method="post">
		<label for="price">Price per Gram:</label>
		<input type="number" id="price" name="price" required>
		<input type="submit" name="submit" value="Update">
	</form>

	<?php
		// Connect to the database
		$servername = "localhost";
		$username = "root";
		$password = "";
		$dbname = "shop_db";

		$conn = new mysqli($servername, $username, $password, $dbname);

		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}

		// Check if form has been submitted
		if(isset($_POST["submit"])) {
			// Get current date
			$date = date("Y-m-d");
			echo $date;

			// Get price from input field
			$price = $_POST["price"];

			// Update the database
			$sql = "INSERT INTO gold_price (price_per_gram,date) VALUES($price, '$date')";
			if ($conn->query($sql) === TRUE) {
				echo "Price updated successfully.";
			} else {
				echo "Error updating price: " . $conn->error;
			}
		}

		// Close the database connection
		$conn->close();
	?>
</body>
</html>
