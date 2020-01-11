<?php 
session_start(); 
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "shop";



// Create connection
$conn = new mysqli($servername, $username, $password,$dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

if(isset($_SESSION['username'])) {
        $loginsession = $_SESSION['username'];
}

// echo "Connected successfully";


$sql = "SELECT id, name ,location,count FROM product where name like'$productName' and username like '$loginsession'";


if($result = mysqli_query($conn, $sql)){
    //no row
    if(mysqli_num_rows($result) == 0){
        $sqlInsert = "INSERT INTO product (id,name,location,count,username) VALUES('','$productName','$imageLocation',1,'$loginsession')";
        if ($conn->query($sqlInsert) == TRUE) {
             echo "New record created successfully";
        }
    }
    //if table have a row
    else if(mysqli_num_rows($result) > 0){
        $sql_count = "SELECT count FROM product WHERE name like '$productName'";
        $result1 = $conn->query($sql_count);
        $row = $result1->fetch_array(MYSQLI_ASSOC);
        $count= $row["count"];
        $count+=1;
        $sqlUpdate = "UPDATE product SET count='$count' WHERE name like'$productName'";
        if ($conn->query($sqlUpdate) === TRUE) {
            echo "updated!!";
        }
    }
}
header('Location: cart.php');
mysqli_close($conn);


    // 

    



// if($result = mysqli_query($conn, $sql)){
//     if(mysqli_num_rows($result) > 0){
//         echo "<table>";
//             echo "<tr>";
//                 echo "<th>id</th>";
//                 echo "<th>name</th>";
//                 echo "<th>age</th>";
//             echo "</tr>";
//         while($row = mysqli_fetch_array($result)){
//             echo "<tr>";
//                 echo "<td>" . $row['id'] . "</td>";
//                 echo "<td>" . $row['name'] . "</td>";
//                 echo "<td>" . $row['location'] . "</td>";
//             echo "</tr>";
//         }
//         echo "</table>";
//         // Free result set
//         mysqli_free_result($result);
//      }
//    } 

?>
