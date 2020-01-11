<!DOCTYPE html>
<html>
<head>
	<title>Monthly Statement</title>
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
		//echo "Connected successfully";
		$sql = "SELECT date, datatype, DATE_FORMAT(time_start,'%k:%i:%s')as time_start,DATE_FORMAT(time_stop,'%k:%i:%s') as time_stop, DATE_FORMAT(timediff(`time_stop`,`time_start`),'%k:%i:%s') as workhour, round((cast(DATE_FORMAT(timediff(`time_stop`,`time_start`),'%k') as int)*1000)+ (cast(DATE_FORMAT(timediff(`time_stop`,`time_start`),'%i') as int)*16.66666666666667))  as payment FROM arubaito where username='$loginName' and DATE_FORMAT(time_stop,'%k:%i:%s') > '0:00:00' ORDER BY id";
		$result = $conn->query($sql);

		if ($result->num_rows > 0) {

	    // output data of each row
	    while($row = $result->fetch_assoc()) {
	        echo "date: " . $row["date"]. " - datatype: " . $row["datatype"]. " " . ">>time start : ".$row["time_start"]. ">> time end : ".$row["time_stop"]. ">> work hour : ".$row["workhour"]."<br>";
		    }
		} 
		//display payment per month
		$sqlresult="SELECT monthNAME(date) as MonthName,concat('￥',sum(resultpayment),'円') as Monthly FROM `arubaito` where username='$loginName' group by MONTH(date)";
		$montlyResult = $conn->query($sqlresult);
		if ($montlyResult->num_rows > 0) {
			echo "<br>"."Monthly Payment"."<br>";
			while($row = $montlyResult->fetch_assoc()) {
				echo $row["MonthName"].">>".$row["Monthly"]."<br>";
			}
		}

		$conn->close();
	?>
	<!-- download csv excel -->
	<h1>CSV Download</h1>
	<p><a href="csv.php">Download</a></p><br>

	<div class=mail>
		<br>
		<a href="mail.php">Sent to Email</a>
	</div>
</body>
</html>