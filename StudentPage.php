<html>
    <head>
        <title>STUNNER Students</title>
        <link rel="stylesheet" type="text/css" href="style.css" />
    </head>



    <body class="color">
        <form>			
            <div class="top">																												  <!--top bar-->
                <a class="ex" href="ProgramPage.php"><div class="choice">																	  <!--top bar content-->
                        <h2>Programs</h2>
                    </div></a>

                <a class="ex" href="StudentPage.php"><div class="choice"> 																	  <!--top bar content-->
                        <h2>Students</h2>
                    </div></a>

                <a class="ex" href="PlanPage.php"><div class="choice"> 																	  <!--top bar content-->
                        <h2>Plan</h2>
                    </div></a>

                <a class="logout" href='http://localhost/PROject/Loginpage.php?logout=true'>
                     <h2>Logout</h2></a>                    <!--Logout-->
            </div>
			
            <div class="imgDiv""><img src="img/Logo2.png" alt="Study Planner" class="logo"></div>  <!--Logo-->

            <div class="left"> 																												   <!--side bar-->
                <h4 class="click" onclick="myFunction()" style="font-size:25px;">Students</h4>													   <!-- side bar content-->
                <ul id="myDIV">
                    <?php

                    $host = "localhost";
                    $id = "root";
                    $pass = "";
                    $db = "dcsmy";
                    
// Create connection to database
                    $conn = new mysqli( $host, $id, $pass, $db );

                    if ( $conn->connect_error )
                    {
                        die( "Connection failed: " . $conn->connect_error );
                    }
//run SQL statement
                    $sql = "SELECT * FROM `student_info` ORDER BY `STUDENT NAME`  ";
                    $result = $conn->query( $sql );
                    while ( $row = $result->fetch_assoc() )
                    {//while getting results from SQL statement    
                        echo "<li class='text'><a class='text2' href = 'StudentFrame.php?id=" . $row["STUDENT ID"] . "&name=" . $row["STUDENT NAME"]
                         . "&prog=" . $row["PROGRAM"]. "' target = 'frame'>" . $row["STUDENT NAME"] . "</a></li>";
                    }
                    $conn->close();
                    ?>                    
                </ul>

                <a href ='addStudent.php' target ='frame' class="button2"> Add Student</a>
				<a href ='deleteStudent.php' target ='frame' class = 'button2'> Delete Student</a>
            </div>
            <iframe src="StudentFrame.php" class = "big" name ="frame" style="margin-left:30px;"></iframe>            
			

        </form>


        <script>
            function myFunction() {
                var x = document.getElementById('myDIV');
                if ( x.style.visibility === 'hidden' ) {
                    x.style.visibility = 'visible';
                } else {
                    x.style.visibility = 'hidden';
                }
            }

            function add() {
                var program = prompt("Please enter a program name");
            }

            function gen() {
            }
        </script>

    </body>
</html>

