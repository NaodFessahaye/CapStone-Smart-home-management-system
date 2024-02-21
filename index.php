<!DOCTYPE html>
<html>
<head>
	<title>Smart Home System</title>
	<style>
		body {
			font-family: Arial, sans-serif;
			background-color: #f7f7f7;
			display: flex;
			flex-direction: column;
			align-items: center;
			justify-content: center;
			height: 100vh;
			margin: 0;
			margin-left: 400px;
		}
		h1 {
			background-color: #0077b6;
			color: #fff;
			padding: 20px;
			margin: 0;
			text-align: center;
			width: 100%;
			position: absolute;
			top: 0;
			left: 0;
			border-bottom: 1px solid #004365;
		}
		h2 {
			color: #004365;
			margin-top: 30px;
			margin-right: 400px;
			font-size: 24px;
			font-weight: bold;
			text-align: center;
			
		}
		.container {
			display: flex;
			flex-direction: column;
			align-items: center;
			margin-top: 30px;
			background-color: #fff;
			padding: 10px;
			box-shadow: 0px 0px 0px 0px rgba(0,0,0,0.2);
			border-radius: 5px;
		}
		table {
			border-collapse: collapse;
			width: 100%;
			margin-top: 20px;
			margin-left:100px;
		}
		th, td {
			padding: 12px;
			text-align: left;
			border-bottom: 1px solid #ddd;
		}
		tr:hover {
			background-color: #f5f5f5;
		}
		table.powerused {
			border-collapse: collapse;
			
			margin-top: 20px;
			margin-right: 100px;
		}
		table.powerused th, table.powerused td {
			padding: 12px;
			text-align: left;
			border-bottom: 1px solid #ddd;
		}
		table.powerused tr:hover {
			background-color: #f5f5f5;
		}
		button {
			background-color: #004365;
			color: #fff;
			padding: 12px 20px;
			border: none;
			border-radius: 5px;
			font-size: 16px;
			cursor: pointer;
			position: absolute;
			top: 5%;
			left: 10%;
			transform: translate(-50%, -50%);
		}
	</style>
</head>
<body>
	<h1>Smart Home System Data</h1>
	<button onclick="location.reload();">Refresh</button>
	<img src="image.jpg" alt="Smart Home System Image" style="display: block; margin: 550px 400px 0px 0px;">
	<?php
		// Establish a connection to the MySQL database
		$servername = "fdb1030.awardspace.net";
		$username = "4280936_smarthomedata";
		$password = "Hiwet#2000";
		$dbname = "4280936_smarthomedata";
		$conn = new mysqli($servername, $username, $password, $dbname);
		if ($conn->connect_error) {
		    die("Connection failed: " . $conn->connect_error);
		}

		// Retrieve data from the MySQL database
		$sql = "SELECT * FROM data ORDER BY date DESC LIMIT 10";
		$result = $conn->query($sql);

		// Display the data in an HTML table
		if ($result->num_rows > 0) {
			echo "<h2>Light State</h2>";
			echo "<table>";
			echo "<tr><th>state</th><th>date</th></tr>";
		    while($row = $result->fetch_assoc()) {
		        echo "<tr><td>" . $row["state"] . "</td><td>" . $row["date"] . "</td></tr>";
		    }
		    echo "</table>";
		} else {
		    echo "No data found.";
		}

		// Retrieve power usage data from the MySQL database
		$sql = "SELECT * FROM data2 ORDER BY date DESC LIMIT 1";
		$result = $conn->query($sql);
	
		// Display the power usage data in an HTML table
		if ($result->num_rows > 0) {
			echo "<h2>Power Usage and time ON</h2>";
			echo "<table class ='powerused'>";
			echo "<tr><th>time ON(Min)</th><th>Power Used(W)</th></tr>";
			while($row = $result->fetch_assoc()) {
				echo "<tr><td>" . $row["time"] . "</td><td>" . $row["powerused"] . "</td></tr>";
			}
			echo "</table>";
		} else {
			echo "No power usage data found.";
		}

		$conn->close();
	?>
</body>
</html>