<!DOCTYPE html>
<body>
<div class="text-center">Already have an account? <a href="login.php">Sign in</a></div>
<?php
extract($_POST);
$servername = "sql306.hstn.me";
$username = "mseet_30688027";
$password = "JJJJJJJJJJ";
$dbname = "mseet_30688027_user";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql=mysqli_query($conn,"SELECT  * FROM users where email='$email'");
if($pass!=$cpass){echo "password inserted does not match"; 
	exit;}
elseif(mysqli_num_rows($sql)>0)
{
    echo "Email Id Already Exists<br>"; 
    echo "Log on your existing account<br>"; 
    
	exit;
}else{
$query="INSERT INTO users(First_Name, Last_Name, email, password ) VALUES ('$first_name', '$last_name', '$email', 'md5($pass)')";
        $sql=mysqli_query($conn,$query)or die("Could Not Perform the Query");
        header ("Location: index.php?status=success");
        
}


$conn->close();
?>

</body>
</html>