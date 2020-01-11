<html>
<title>create user</title>
<body>
<?php 

$id=$_POST["uname"];
$pwd=$_POST["pwd"];
$hashed_password = password_hash($pwd, PASSWORD_DEFAULT); // hash password
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db5b24";

// Create connection
$conn = new mysqli($servername, $username, $password,$dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
//echo "Connected successfully"."<br>";


// insert to database 
$sql = "INSERT INTO login (username,password) VALUES('$id', '$hashed_password')";

if ($conn->query($sql) === TRUE) {
    //give alert message
    echo "<script> alert('ユーザー登録した'); 
        window.location.href='login.php';</script>";   
}

?>

</body>
</html>