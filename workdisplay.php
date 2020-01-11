<!DOCTYPE html>
<html>
<head>
	<title>WorkDisplay</title>
</head>
<link href="style.css" type="text/css" rel="stylesheet">
<body>
	<?php
		session_start();
		$servername = "localhost";
		$username = "root";//username database
		$password = "";   // password database
		$dbname ="db5b24"; // database name
		$loginName = $_SESSION['username']; //copy session username as id
	?>
	<div class=container>
		<p align="center">Welcome <?php echo $loginName."," ?></p>
		<p align="right"><a href="login.php" onclick="return confirm('Do you want to logout')">Logout</a></p>
	</div>
	<?php
		
		// Create connection
		$conn = new mysqli($servername, $username, $password,$dbname);

		// Check connection
		if ($conn->connect_error) {
		    die("Connection failed: " . $conn->connect_error);
		} 

		//echo $loginName; // print username from session
		//echo "Connected successfully";
		$sql = "SELECT date, datatype, DATE_FORMAT(time_start,'%k:%i:%s') as time_start,DATE_FORMAT(time_stop,'%k:%i:%s') as time_stop FROM arubaito where date = CURRENT_DATE() and username ='$loginName' ORDER BY id";
		$result = $conn->query($sql);

		//if data is exist
		if ($result->num_rows > 0) {
	?>
		<form action="workcalculate.php" method="post">
		 	<button name="stop" type="submit">stop</button>
		</form> 
	<?php
	    // output data of each row
	    while($row = $result->fetch_assoc()) {
	        echo "date: " . $row["date"]. " - datatype: " . $row["datatype"]. " " . ">>".$row["time_start"]. ">>".$row["time_stop"]. "<br>";
		    }
		} else {
	?>
		<form action="workcalculate.php" method="post">
		 	<button name="start" type="submit">start</button>
		</form> 
	<?php
		}
		//close connection from  database
		$conn->close();
	?>

	<div class=month>
		<br>
		<a href="workdisplaymonth.php">view</a> >> per month (月額)<br>
	</div>
	

</body>
</html>