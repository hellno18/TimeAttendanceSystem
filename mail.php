<?php
	session_start();
	$servername = "localhost";
	$username = "root";//username database
	$password = "";   // password database
	$dbname ="db5b24"; // database name
	$loginName = $_SESSION['username']; //copy session username as id

	// Create connection
	$conn = new mysqli($servername, $username, $password,$dbname);

	// Check connection
	if ($conn->connect_error) {
		    die("Connection failed: " . $conn->connect_error);
	} 

	$sql = "SELECT date, datatype, DATE_FORMAT(time_start,'%k:%i:%s')as time_start,DATE_FORMAT(time_stop,'%k:%i:%s') as time_stop, DATE_FORMAT(timediff(`time_stop`,`time_start`),'%k:%i:%s') as workhour, round((cast(DATE_FORMAT(timediff(`time_stop`,`time_start`),'%k') as int)*1000)+ (cast(DATE_FORMAT(timediff(`time_stop`,`time_start`),'%i') as int)*16.66666666666667))  as payment FROM arubaito where username='$loginName' and DATE_FORMAT(time_stop,'%k:%i:%s') > '0:00:00' ORDER BY id";
		$result = $conn->query($sql);

	if ($result->num_rows > 0) {

	    // output data of each row
	    while($row = $result->fetch_assoc()) {
	        $msg1 =  "date: " . $row["date"]. " - datatype: " . $row["datatype"]. " " . ">>time start : ".$row["time_start"]. ">> time end : ".$row["time_stop"]. ">> work hour : ".$row["workhour"]."<br>";
		    }
		} 
		//display payment per month
		$sqlresult="SELECT monthNAME(date) as MonthName,concat('￥',sum(resultpayment),'円') as Monthly FROM `arubaito` where username='$loginName' group by MONTH(date)";
		$montlyResult = $conn->query($sqlresult);
		if ($montlyResult->num_rows > 0) {
			while($row = $montlyResult->fetch_assoc()) {
				$msg2 = $row["MonthName"].">>".$row["Monthly"]."<br>";
			}
		}

		
		require 'phpmailer/PHPMailerAutoload.php';
		$name = "Report Monthly Payment System";
		$msg0 = "Mr / Mrs ".$loginName.", it's your report please check it on below!<br> Monthly Report:";
		$email = "example@example.com";
		$mail = new PHPMailer(); // create a new object
		$mail->IsSMTP(); // enable SMTP
		$mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
		$mail->SMTPAuth = true; // authentication enabled
		$mail->SMTPSecure = 'tls'; // secure transfer enabled REQUIRED for Gmail
		$mail->Host = "smtp.gmail.com";
		$mail->Port = 587; // or 587
		$mail->IsHTML(true);
		$mail->Username = "hellno18tnw@gmail.com";
		$mail->Password = "hell@w3n";
		$mail->SetFrom($email);
		$mail->Subject = "Report Monthly Payment System";
		$mail->Body = "From ".$name.",<br>".$msg0."<br>".$msg1."<br>".$msg2."<br> Sincerely, <br> Report Monthly Payment System";
		$mail->AddAddress("michaeljack255@gmail.com");
		 if(!$mail->Send()) {
		    echo "Mailer Error: " . $mail->ErrorInfo;
		 } else {
		    echo '<script type="text/javascript"> sentFunc(); </script>';
	   		header('Location: workdisplaymonth.php');
		    exit();
		 }	
		 $conn->close();
	?>
		<script type="text/javascript">
			function sentFunc(){
				alert("Your message has been sent!");
				return false;
			}
	</script>