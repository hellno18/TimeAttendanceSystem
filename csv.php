<?php
	session_start(); 
	 $dsn = 'mysql:host=localhost;dbname=db5b24';
	 $id = 'root';
	 $pw = '';
	 $loginName = $_SESSION['username']; //copy session username as id
	 $val = filter_input(INPUT_POST, "busyo_cd");
	 //if (isset($_POST["dlbtn"])) {
	   try {
	     //DB検索処理
	     $pdo = new PDO($dsn, $id, $pw,
	              array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
	     $sql = "SELECT date, datatype, DATE_FORMAT(time_start,'%k:%i:%s')as time_start , DATE_FORMAT(time_stop,'%k:%i:%s') as time_stop,DATE_FORMAT(timediff(`time_stop`,`time_start`),'%k:%i:%s') as workhour,overtime,payment,overtimepayment,resultpayment  FROM arubaito where username='$loginName' ORDER BY id";
	     //$sqlresult="SELECT monthNAME(date) as MonthName,concat('￥',sum(resultpayment),'円') as Monthly FROM `arubaito` group by MONTH(date)";
	     $stmt = $pdo->prepare($sql);

	     $stmt->bindParam(':busyoco', $val, PDO::PARAM_STR);
	     $stmt->execute();
	 	 // 
	     //CSV文字列生成
	     $csvstr = "date".","."datatype".","."time_start".","."time_stop".","."work hour".","."overtime".","."payment".","."overtimepayment".","."resultpayment".","."\r\n";
	     while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
	       $csvstr .= $row['date'] . ",";
	       $csvstr .= $row['datatype'] . ",";
	       $csvstr .= $row['time_start'] . ",";
	       $csvstr .= $row['time_stop'] . ",";
	       $csvstr .= $row['workhour'] . ",";
	       $csvstr .= $row['overtime'] . ",";
	       $csvstr .= $row['payment'] . ",";
	       $csvstr .= $row['overtimepayment'] . ",";
	       $csvstr .= $row['resultpayment'] . "\r\n";
	     }

		/*
	     //per month
	     $sqlresult="SELECT monthNAME(date) as MonthName,concat('￥',sum(resultpayment),'円') as Monthly FROM `arubaito` group by MONTH(date)";
	     $stmt = $pdo->prepare($sqlkekka);
	     $stmt->bindParam(':busyoco', $val, PDO::PARAM_STR);
	     $stmt->execute();
	 
	 	 $csvstr1 = "Month".","."Monthly Payment"."\r\n";
	     while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
	       $csvstr1 .= $row['Monthly'] . ",";
	       //$csvstr .= $row['resultpayment'] . "\r\n";
	     }
	     */

	     //CSV出力
	     $fileNm = "workinghours.csv";
	     header('Content-Type: text/csv');
	     header('Content-Disposition: attachment; filename='.$fileNm);
	     echo mb_convert_encoding($csvstr, "SJIS", "UTF-8"); //Shift-JISに変換したい場合のみ
	     exit();
	 
	   }catch(ErrorException $ex){
	     print('ErrorException:' . $ex->getMessage());
	   }catch(PDOException $ex){
	     print('PDOException:' . $ex->getMessage());
	   }
	 //}
?>