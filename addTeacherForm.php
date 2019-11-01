<!DOCTYPE html>
<html>
<head>
	<title>Add a New Professor</title>
	<link rel="stylesheet" type="text/css" href="adTeachForm.css">
	
</head>
<body>
	<a href="home.html">Home</a>
	<h1>Add a New Professor!</h1>
	
	<?php
// define variables and set to empty values
$fnameErr = $lnameErr = $deptErr = $schoolNameErr = "";
$fname = $lname = $dept = $schoolName = $option = "";

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
First Name: <input type="text" name="fname">
<span class="error">* <?php echo $fnameErr;?></span>
<br><br>
Last Name: <input type="text" name="lname">
<span class="error">* <?php echo $lnameErr;?></span>
<br><br>
Name of School:    
<input type="text" name="schoolName">
<span class="error"><?php echo $schoolNameErr;?></span>
<br><br>

Department:  
<input type="radio" name="dept" value="biology">Biology
<input type="radio" name="dept" value="businessAdmin">Business Administration
<input type="radio" name="dept" value="communication">Communications
<input type="radio" name="dept" value="compScience">Computer Science
<input type="radio" name="dept" value="crimJustice">Criminal Justice
<input type="radio" name="dept" value="education">Education
<input type="radio" name="dept" value="marketing">Marketing
<input type="radio" name="dept" value="nursing">Nursing
<input type="radio" name="dept" value="psychology">Phychology
<input type="radio" name="dept" value="poliScience">Political Science

<span class="error">* <?php echo $deptErr;?></span>
<br><br>

<input type="submit" name="submit" value="Submit">
</form>

<?php
echo "<h2>Your Input:</h2>";
echo $fname;
echo "<br>";
echo $lname;
echo "<br>";
echo $schoolName;
echo "<br>";
echo $dept;
echo "<br>";
echo $option;
?>
</body>
</html>