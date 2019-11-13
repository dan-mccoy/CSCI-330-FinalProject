<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <meta name="description" content="Rate Your Professor">
    <meta name="keywords" content="Professor ratings, rate your prof, pick a good one">
    <meta name="author" content="Chris Kosminsky">
    <title>Rate Your Professor | Display</title>
    <link rel = "stylesheet"
        type = "text/css"
        href = "display.css" />
</head>
<body>

<?php

$name = "";
$ID='1';  //***can change ID hard code here to change teacher in database***

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

    //***sql query into ProfEval DataBase for Name, School, Department
    $sql = "SELECT Name, SchoolName, Department FROM ProfEval WHERE ID =$ID"; //could put different number here for professor looking for
    //$result = mysqli_query($con, $sql); //gets result
    //$info = mysqli_fetch_all($result, MYSQLI_ASSOC);
    //print_r($info);

    
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_all($result, MYSQLI_NUM);
    
    //saving querys into variables to be used in page.
    $name =  $row[0][0];
    $school = $row[0][1];
    $dept = $row[0][2];
    //***End of first sql query


    //Gets AVG ratings in the Ratings Collumn
    $sql = "SELECT CAST(AVG(Rating) AS DECIMAL(10,1)) FROM Rating WHERE Pid =$ID";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_all($result, MYSQLI_NUM);
    //print_r($row[0][0]);
    $AVGOfRatings = $row[0][0];

  
  $con->close();
//}


?>

    <header>
        <div class="container">
            <div id="branding">
                <!--Logo goes here, replace h1-->
                <h1><span class="highlight">Rate</span> Your Professor</h1>
                <!--<img src="logo.png" width="100px" height="100px">-->
            </div>
            <nav>
                <ul>
                    <!--Home page linked here-->
                    <li><a href="Home.html">Home</a></li>
                    <!--Rate page linked here-->
                    <li><a href="ProfScore.html">Rate a Professor</a></li>
                    <!--Professor linked here-->
                    <li class="current"><a href="display.html">Professors</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <section id="showcase">
        <div class="container">
            <h1>Professors</h1>
            <p>Going into a class blind could be the difference between an A and an F. Do everyone a favor and rate your professors!</p>
        </div>
    </section>

    <section id="professorDisplay">
        <div id="container">

            <!--Placeholder, will grab prof name from database ProfEval and print-->
            <h1><?php print_r($name); echo " - "; print_r($school); echo "<br>";   print_r($dept);?></h1> <!-- This line puts in what $name isfrom php code -->

            <!--Placeholders, numeric review and comments below grab from Rating table-->
            <!-- Will Grab Average Score in Rating Collumn -->
            <h2><?php echo "OverAll Rating: "; print_r($AVGOfRatings);?>/5</h2>

            <!--comment section wil grab from Rating Table print in while loop? --> 
            <!--<h3>Gary is a nice professor. Easier classes than Kevins.</h3>-->
            <h3><?php //could make this part into function call??
                //RatingCom($ID);
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
                

            //Comment Section in a loop to print all comments
            $sql = "SELECT Section, Rating, Comment FROM Rating WHERE Pid =$ID"; 
            $result = mysqli_query($con, $sql); //gets result
            $info = mysqli_fetch_all($result, MYSQLI_ASSOC);

            $result = mysqli_query($con, $sql);

            if ($result->num_rows > 0) 
            {
            // output data of each row
                while($row = $result->fetch_assoc()) 
                { //Can Change what comment section says here..
                echo "Section: " . $row["Section"]. " - Rating: " . $row["Rating"]. "/5 - Comment: " . $row["Comment"]. "<br>";
                }
            }   
            else 
            {
            echo "0 results for Comments.";
            }
            $con->close();
                
            ?></h3>
        </div>
    </section>

    <section id="relatedProfessors">
        <div class="container">
            <div class="box">
                <h3>Related Professor</h3>
                <p>1/5</p>
            </div>
            <div class="box">
                <h3>Related Professor</h3>
                <p>3/5</p>
            </div>
            <div class="box">
                <h3>Related Professor</h3>
                <p>5/5</p>
            </div>
        </div>
    </section>

    <footer>
        <p>Rate Your Professor, Copyright &copy; 2019</p>
    </footer>


</body>
</html>