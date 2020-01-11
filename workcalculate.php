<!DOCTYPE html>
<html>
<head>
	<title>calculate</title>
</head>
<body>
	<?php
		session_start(); 
		$servername = "localhost";
		$username = "root";
		$password = "";
		$dbname ="db5b24";
		$loginName = $_SESSION['username']; //copy session username as id
		// Create connection
		$conn = new mysqli($servername, $username, $password,$dbname);

		// Check connection
		if ($conn->connect_error) {
		    die("Connection failed: " . $conn->connect_error);
		} 
		//echo "Connected successfully";
		if (isset($_POST['start'])) {
    		$sql = "INSERT into arubaito(id,username,datatype,time_start,status,date,time_stop)values('','$loginName','IN',NOW(),1,CURRENT_DATE(),'')";
			$result = $conn->query($sql);
			echo "Start working time successfully";
			header("Refresh:2; url=workdisplay.php");
		}
		if (isset($_POST['stop'])) {
			$sqlcheck = "SELECT id, datatype, time_stop FROM arubaito where time_stop > CURRENT_DATE() and datatype = 'OUT' and username='$loginName'";
			$resultcheck = $conn->query($sqlcheck);
			if ($resultcheck->num_rows > 0) {
				
				//calculate general payment and work time stop
				$sql = "UPDATE arubaito set time_stop = NOW(), datatype ='OUT', payment= round((cast(DATE_FORMAT(timediff(`time_stop`,`time_start`),'%k') as int)*1000)+ (cast(DATE_FORMAT(timediff(`time_stop`,`time_start`),'%i') as int)*16.66666666666667)) , workhour = DATE_FORMAT(timediff(`time_stop`,`time_start`),'%k:%i:%s'),status=2 where date = CURRENT_DATE() and username='$loginName'";
				
				//to calculate on overtime collumn sql
				$sqlovertime= "UPDATE arubaito set overtime= (DATE_FORMAT(time_stop,'%k')-19) where DATE_FORMAT(time_stop,'%k:%i:%s') > '19:00:00'and DATE_FORMAT(time_stop,'%k:%i:%s') < '23:59:59' and date = CURRENT_DATE() and DATE_FORMAT(time_start,'%k:%i:%s') < '19:00:00' and username='$loginName'";
				
				//while overtime from 19:00, this script will update 
				$sqlpaymentO= "UPDATE arubaito set overtimepayment= round(overtime*500)+ (DATE_FORMAT(time_stop,'%i')*8.333333333333333)where DATE_FORMAT(time_stop,'%k:%i:%s') > '19:00:00'and DATE_FORMAT(time_stop,'%k:%i:%s') < '23:59:59' and date = CURRENT_DATE() and username='$loginName'";
				//update resultpayment
				$sqlpaymenttotal="UPDATE arubaito set resultpayment= (payment+overtimepayment) where date = CURRENT_DATE() and username='$loginName'";

				$result = $conn->query($sql);
				$result = $conn->query($sqlovertime);
				$result = $conn->query($sqlpaymentO);
				$result = $conn->query($sqlpaymenttotal);
				echo "Stop working time successfully updated";
				header("Refresh:2; url=workdisplay.php");
			}
			else{
				$curr=1;
				$curr++;
				
				//calculate general payment and work time stop
				$sql = "UPDATE arubaito set time_stop = NOW(), datatype ='OUT', payment= round((cast(DATE_FORMAT(timediff(`time_stop`,`time_start`),'%k') as int)*1000)+ (cast(DATE_FORMAT(timediff(`time_stop`,`time_start`),'%i') as int)*16.66666666666667)) , workhour = DATE_FORMAT(timediff(`time_stop`,`time_start`),'%k:%i:%s') where date = CURRENT_DATE() and username='$loginName'";
				
				//to calculate on overtime collumn sql
				$sqlovertime= "UPDATE arubaito set overtime= (DATE_FORMAT(time_stop,'%k')-19) where DATE_FORMAT(time_stop,'%k:%i:%s') > '19:00:00'and DATE_FORMAT(time_stop,'%k:%i:%s') < '23:59:59' and date = CURRENT_DATE() and DATE_FORMAT(time_start,'%k:%i:%s') < '19:00:00' and username='$loginName' ";
				
				//while overtime from 19:00, this script will update 
				$sqlpaymentO= "UPDATE arubaito set overtimepayment= round(overtime*500)+ (DATE_FORMAT(time_stop,'%i')*8.333333333333333) where DATE_FORMAT(time_stop,'%k:%i:%s') > '19:00:00'and DATE_FORMAT(time_stop,'%k:%i:%s') < '23:59:59' and date = CURRENT_DATE() and username='$loginName'";
				
				//update resultpayment
				$sqlpaymenttotal="UPDATE arubaito set resultpayment= (payment+overtimepayment) where date = CURRENT_DATE() and username='$loginName'";

				$result = $conn->query($sql);
				$result = $conn->query($sqlovertime);
				$result = $conn->query($sqlpaymentO);
				$result = $conn->query($sqlpaymenttotal);
				echo "Stop working time successfully added";
				header("Refresh:2; url=workdisplay.php");
			}
    		
		}

		
	
	?>
	
	
</body>
</html>