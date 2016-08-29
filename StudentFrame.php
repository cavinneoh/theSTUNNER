<html>
    <head>
        <link rel="stylesheet" type="text/css" href="style.css" />
    </head>
    <body >
        <ol>
            <?php
            include 'functions.php';//include functions file, also starts session

            if ( isset( $_GET["id"] ) )
            {
                $_SESSION['id'] = $_GET["id"];
                $_SESSION['name'] = $_GET["name"];
                $_SESSION['prog'] = $_GET["prog"];
            }
            if ( !isset( $_SESSION['prog'] ) )
            {
                echo "<h1>Click on a student to view subjects remaining</h1>";
            }
            else
            {
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
                $sql = "SELECT * FROM `student_subjects` WHERE `COMPLETED` = 0 AND `STUDENT ID` ='" . $_SESSION['id'] . "'";
                $result = $conn->query( $sql );

                echo "<h3> Student ID: " . $_SESSION['id'] . "<br>Name: " . $_SESSION['name']
                . "<br>Program: " . $_SESSION['prog'] . "</h3>";

                if ( mysqli_num_rows( $result ) > 0 )//if query returns results
                {
                    $incomplete = array();
                    echo "<h1>Subjects remaining: </h1>";

                    while ( $row = $result->fetch_assoc() )
                    {//while getting results from SQL statement    
                        $name = getName( $row["COURSE CODE"] );
                        echo "<li>$name</li>";
                        array_push( $incomplete, $row["COURSE CODE"] );
                    }
                    $_SESSION['incomplete'] = $incomplete;

                    echo "</ol><h4>Start plan at:</h4>"
                    . "<form action='PlanPage.php?student=" . $_SESSION['name'] . " (" . $_SESSION['id'] . ")'"
                    . " method='post' target ='_parent'>"
                    . "<select style='float:left; font-size:15px; padding:5px; bottom:0' name='month' >"
                    . "<option value='January'>January</option>"
                    . "<option value='April'>April</option>"
                    . "<option value='August'>August</option>"
                    . "</select>"
                    . "<select style='float:left; font-size:15px; padding:5px; bottom:0' name='year' >"
                    . "<option value='2016'>2016</option>"
                    . "<option value='2017'>2017</option>"
                    . "<option value='2018'>2018</option>"
                    . "</select>"
                    . "<input style='float:left; font-size:15px; padding:5px; bottom:0' type='submit' value='Generate plan'>"
                    . "</form>";
                }
                else
                {
                    echo "<h1>NO SUBJECT RECORD FOUND</h1>";
                }
            }
            $conn->close();
            ?>
    </body>
</html>