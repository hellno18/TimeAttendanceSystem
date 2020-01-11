<html>
<title>check_login</title>
<body>
<?php 
session_start(); 
$id=$_POST["uname"]; // get from name
$pwd=$_POST["pwd"]; // get from password
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db5b24"; // name of database
$_SESSION["username"] = $id; //copy session username as id
// Create connection
$conn = new mysqli($servername, $username, $password,$dbname);




// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
//check dbconnect
//echo $_SESSION["username"];
//echo "<br>";

//sql query
$sql_u = "SELECT * FROM login WHERE username like '$id'";

$res_u = mysqli_query($conn, $sql_u);


if (mysqli_num_rows($res_u) > 0) {
    echo "YOUR USERNAME=".$id;
    $sql_p = "SELECT password FROM login WHERE username like '$id'";
    $result = $conn->query($sql_p);
    $row = $result->fetch_array(MYSQLI_ASSOC);
    $db_password= $row["password"];

    if (password_verify($pwd, $db_password)) {
        mysqli_close($conn);
        echo "<script> alert('ログイン確認した'); 
        window.location.href='workdisplay.php';</script>";   
        
        
    }
    else{
        //close connection
        mysqli_close($conn);
        //give alert message
        echo "<script> alert('パスワードは違います'); 
        window.location.href='login.php';</script>";   
    }

}
else
{
    //close connection
    mysqli_close($conn);
    //give alert message
    echo "<script> alert('ユーザーが見つかりません'); 
    window.location.href='login.php';</script>";    
}


?>

</body>
</html>