<!DOCTYPE html>
<body>
<div class="text-center">Don't have an account? <a href="index.php">Register Here</a></div>
<?php
session_start();
$servername = "sql306.hstn.me";
$username = "mseet_30688027";
$password = "JJJJJJJJJJ";
$dbname = "mseet_30688027_user";

$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}


if(isset($_POST['save']))
{
    extract($_POST);

    $sql=mysqli_query($conn,"SELECT * FROM users where Email='$email' and Password='md5($pass)'");
    $row  = mysqli_fetch_array($sql);
    if(is_array($row))
    {
        $_SESSION["id"] = $row['id'];
        $_SESSION["email"]=$row['email'];
        $_SESSION["First_Name"]=$row['First_Name'];
        $_SESSION["Last_Name"]=$row['Last_Name']; 
        header("Location: home.php"); 
    }
    else
    {
        echo "Invalid Email ID/Password<br>";
        echo "Create an account if you do not have one yet";
    }
}
?>
</body>
</html>