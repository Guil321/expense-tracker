<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <style>
    @import url('https://fonts.googleapis.com/css?family=Lato&display=swap');

:root {
  --box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12), 0 1px 2px rgba(0, 0, 0, 0.24);
}

* {
  box-sizing: border-box;
}

body {
  background-color: #f7f7f7;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  min-height: 100vh;
  margin: 0;
  font-family: 'Lato', sans-serif;
}

.container {
  margin: 30px auto;
  width: 350px;
}

h1 {
  letter-spacing: 1px;
  margin: 0;
}

h3 {
  border-bottom: 1px solid #bbb;
  padding-bottom: 10px;
  margin: 40px 0 10px;
}

h4 {
  margin: 0;
  text-transform: uppercase;
}

.inc-exp-container {
  background-color: #fff;
  box-shadow: var(--box-shadow);
  padding: 20px;
  display: flex;
  justify-content: space-between;
  margin: 20px 0;
}

.inc-exp-container > div {
  flex: 1;
  text-align: center;
}

.inc-exp-container > div:first-of-type {
  border-right: 1px solid #dedede;
}

.money {
  font-size: 20px;
  letter-spacing: 1px;
  margin: 5px 0;
}

.money.plus {
  color: #2ecc71;
}

.money.minus {
  color: #c0392b;
}

label {
  display: inline-block;
  margin: 10px 0;
}

input[type='text'],
input[type='number'] {
  border: 1px solid #dedede;
  border-radius: 2px;
  display: block;
  font-size: 16px;
  padding: 10px;
  width: 100%;
}

.btn {
  cursor: pointer;
  background-color: #9c88ff;
  box-shadow: var(--box-shadow);
  color: #fff;
  border: 0;
  display: block;
  font-size: 16px;
  margin: 10px 0 30px;
  padding: 10px;
  width: 100%;
}

.btn:focus,
.delete-btn:focus {
  outline: 0;
}

.list {
  list-style-type: none;
  padding: 0;
  margin-bottom: 40px;
}

.list li {
  background-color: #fff;
  box-shadow: var(--box-shadow);
  color: #333;
  display: flex;
  justify-content: space-between;
  position: relative;
  padding: 10px;
  margin: 10px 0;
}

.list li.plus {
  border-right: 5px solid #2ecc71;
}

.list li.minus {
  border-right: 5px solid #c0392b;
}

.delete-btn {
  cursor: pointer;
  background-color: #e74c3c;
  border: 0;
  color: #fff;
  font-size: 20px;
  line-height: 20px;
  padding: 2px 5px;
  position: absolute;
  top: 50%;
  left: 0;
  transform: translate(-100%, -50%);
  opacity: 0;
  transition: opacity 0.3s ease;
}

.list li:hover .delete-btn {
  opacity: 1;
}
    </style>
    <title>Expense Tracker</title>
  </head>
  <body>
      
  <div class="signup-form">

    <form action="home.php" method="post" enctype="multipart/form-data">

        <br>

            <?php
				session_start();
				$servername = "sql305.iceiy.com";
                $username = "icei_30494184";
                $password = "JJJJJJJJJJ";
                $dbname = "icei_30494184_user";

                $conn = new mysqli($servername, $username, $password, $dbname);
                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }
				$ID= $_SESSION["id"];
				$sql=mysqli_query($conn,"SELECT * FROM users where id='$ID' ");
				$row  = mysqli_fetch_array($sql);
            ?>
            	<h2 class="hint-text"><br><b>Welcome </b><?php echo $_SESSION["First_Name"] ?> <?php echo $_SESSION["Last_Name"] ?></h2>
</div>
    <h2>Expense Tracker</h2>

    <div class="container">

    

      <h3>Add new transaction</h3>
      <form id="form" form action="home.php" method="post" enctype="multipart/form-data">
        <div class="form-control">
          <label for="text">Text</label>
          <input type="text" id="text" name="text" required="required" placeholder="Enter text..." />
        </div>
        <div class="form-control">
          <label for="income"
            >Amount <br />
            (positive - income)</label
          >
          <input type="number" id="income" name="income" placeholder="Enter amount..." />
          <label for="expens"
            >Amount <br />
            (negative - expense)</label
          >
          <input type="number" id="expens" name="expens" placeholder="Enter amount..." />
        </div>
        <button class="btn">Add transaction</button>
      </form>
    </div>
    
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
$ID= $_SESSION["id"];

//$sql=mysqli_query($conn,"SELECT * FROM expense where eid='$ID' LIMIT 1");
$sqll = "SELECT balance FROM expense where eid='$ID'";
$result = $conn->query($sqll);

if ($result->num_rows > 0) {  
         // while($row = $result->fetch_assoc())
                       $row=mysqli_fetch_array($result,MYSQLI_ASSOC);
                        $BAL = $row["balance"];
                        //echo $BAL[0]."<br>";
                            

                       }
global $income;
global $expens;
global $text;

if($expens<1){ $expens = 0;}
if($income<1){ $income = 0;}

$query="INSERT INTO expense(income, expens, details, eid ) VALUES ('$income', '$expens', '$text', '$ID')";
        $sql=mysqli_query($conn,$query)or die("Could Not Perform the Query yo");

        $sql = "SELECT details, expens, income FROM expense where eid='$ID'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {if($row["expens"]>0 OR $row["income"]>0 ){
    echo "<h4>details: </h4>" . $row["details"]. " - Expense/Income: -" . $row["expens"]. "/+ " . $row["income"]. "<br>";
  }
}
} else {
  echo "0 results";
}
global $BAL;
$income=(int)$income;
$expens=(int)$expens;
$BAL=$BAL+$income-$expens;
echo "<h4>Your Balance</h4>";
echo "<h1>".$BAL."</h1>";
$query="UPDATE expense SET balance=$BAL where eid='$ID'";
        $sql=mysqli_query($conn,$query)or die("Could Not Perform the Query");
       
?>
            

	
        <div class="text-center">Want to Leave the Page? <br><a href="logout.php">Logout</a></div>
    </form>
	
</body>
</html>