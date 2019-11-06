<!DOCTYPE html>
<html>
<head>
	<title>Add a New Professor</title>
	<link rel="stylesheet" type="text/css" href="adTeachForm.css">
	
</head>
<body>
	<a href="home.html">Home</a>
	<h1 align="center">Add a New Professor!</h1>
	
	<?php
// define variables and set to empty values
$fnameErr = $lnameErr = $deptErr = $schoolNameErr = "";
$fname = $lname = $dept = $schoolName = $name = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  
  if (empty($_POST["fname"])) {
    $fnameErr = "First Name is required";
  } else {
    $fname = test_input($_POST["fname"]);
  }
  if (empty($_POST["lname"])) {
    $lnameErr = "Last Name is required";
  } else {
    $lname = test_input($_POST["lname"]);
  }
  if (empty($_POST["schoolName"])) {
    $schoolName = "";
  } else {
    $schoolName = test_input($_POST["schoolName"]);
  }

  if (empty($_POST["dept"])) {
    $deptErr = "Department taught is required";
  } else {
    $dept = test_input($_POST["dept"]);
  }
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>


<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">  
<u>First Name:</u> <input type="text" name="fname">
<span class="error">* <?php echo $fnameErr;?></span>
<br><br>
<u>Last Name:</u> <input type="text" name="lname">
<span class="error">* <?php echo $lnameErr;?></span>
<br><br>
<u>Name of School:</u>   
<input type="text" name="schoolName">
<span class="error"><?php echo $schoolNameErr;?></span>
<br><br>

<u>Department:</u>  
<input type="radio" name="dept" value="Biology">Biology
<input type="radio" name="dept" value="BusinessAdministration">Business Administration
<input type="radio" name="dept" value="Communication">Communications
<input type="radio" name="dept" value="ComputerScience">Computer Science
<br>
<input type="radio" name="dept" value="CriminalJustice">Criminal Justice
<input type="radio" name="dept" value="Education">Education
<input type="radio" name="dept" value="Marketing">Marketing
<input type="radio" name="dept" value="Nursing">Nursing
<input type="radio" name="dept" value="Psychology">Psychology
<input type="radio" name="dept" value="PoliticalScience">Political Science

<span class="error">* <?php echo $deptErr;?></span>
<br><br>

<input type="submit" name="submit" value="Submit">
</form>


<?php
$name = "$fname $lname";

//function that inputs the values into database
function inputData($name, $schoolName, $dept)
{
  $servername= "localhost";
  $username= "root";
  $password= "";
  //create Connection to DataBase
  $con= new mysqli($servername, $username, $password);
  //check connection..
    if($con->connect_error){
      die("Connection failed:" .$con->connect_error);
    }
    if(!mysqli_select_db($con, 'ProfEval')){
      echo 'Database not Selected';
    }

  //insert info from from. 
  $sql = "INSERT INTO `ProfEval` (`ID`, `Name`, `SchoolName`, `Department`) VALUES (NULL, '$name', '$schoolName', '$dept')";

  if(mysqli_query($con, $sql)){
    echo "<br>";
    echo 'Inserted';
    echo "<br>";
  }
  else{
    echo "<br>";
    echo 'Not Inserted';
    echo "<br>";
  }
  //resends back to HomePage on submit.
  header("refresh:5; url=home.html");
  $con->close();
}
//checks that submit button pressed and executes funtion to insert Data. 
if(isset($_POST['submit'])){
    if($name<>' '&& $dept<> '')
    {
    inputData($name, $schoolName, $dept);
  }
}

echo "<br>";
echo "<b>Uploaded Input:</b>";
echo "<br>";
echo $name;
echo "<br>";
echo $schoolName;
echo "<br>";
echo $dept;
echo "<br>";
echo "<br>";

?>

</body>
</html>
