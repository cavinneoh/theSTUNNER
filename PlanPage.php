<html>
    <head>
        <title>STUNNER Plan</title>
        <link rel="stylesheet" type="text/css" href="style.css" />
    </head>
    <?php
    include 'functions.php';

    $top = "<br><hr>";
    $msg = "<br><hr><br>";
    $btm = "<hr><br>";

    if ( isset( $_GET['mail'] ) )
    {   //code starts here after attempt to send mail, otherwise starts in ELSE
        if ( $_GET['mail'] === 'sent' )
        {   
            $top = "<h4 style ='font-size:25px; color:limegreen'>E-mail <u>sent</u>!<h4>";
            $btm = "Recipient: " . $_SESSION['addr'];
            unset( $_SESSION['addr'] );
        }
        else
        {
            $top = "<h4 style ='font-size:25px; color:red'>ERROR!<h4>";
            $btm = $_GET['mail'];
        }
    }
    else
    {
        if ( isset( $_SESSION['ICP'] ) )
        {   //if plan has been generated
            $top = "<h4 style='font-size:25px'>E-mail plan"
                    . "<img style='height:60px;width:60px;float:right;margin:10px' src='img/email2.png' alt='email'></h4>"
                    . " <form action = 'PlanPage.php' method = 'POST' >Recipient: <br><input type='text' name='addr' /><br>";
            $msg = "";
            $btm = "<br><input type='submit' value='Send plan' name='submit'></form>";
        }
        if ( isset( $_POST['submit'] ) )
        {
            if ( empty( $_POST['addr'] ) )//check for input in field
            {
                $msg = "<span class='error'>Please enter e-mail address</span>";
            }
            else
            {
                $email = $_POST['addr'];
                if ( !filter_var( $email, FILTER_VALIDATE_EMAIL ) )
                {   //check for valid email address
                    $msg = "<span class='error'>Invalid e-mail format</span>";
                }
                else if ( !strpos( $email, "@gmail.com" ) !== false )//check if NOT gmail
                {   
                    $msg = "<span class='error'>Sorry, only GMAIL is supported</span>";
                }
                else
                {   //direct to another page for mailing
                    $_SESSION['addr'] = $email;
                    header( "Location: http://localhost/PROject/mail.php" );
                    exit();
                }
            }
        }
    }
    ?>

    <body class="color">
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
                <h2>Logout</h2></a>            <!--Logout-->																  <!--top bar content-->

        </div>        
        <div style="margin-left:22%;margin-top:7%;"><img src="img/Logo2.png" alt="Study Planner" style="width:50%;height:15%;" ></img></div>  <!--Logo-->

        <div class="left"> 																												   <!--side bar-->
            <?php
            echo $top;
            echo $msg;
            echo $btm;
            ?>       
        </div>

        <div class="big">
            <!--Big container-->
            <?php
            if ( isset( $_GET['student'] ) )
            {
                $_SESSION['student'] = $_GET['student'];
                $_SESSION['month'] = $_POST["month"];
                $_SESSION['year'] = $_POST["year"];
                $_SESSION['ICP'] = $_SESSION['incomplete'];
                $_SESSION['new'] = true;
                header( "Refresh:0; url=http://localhost/PROject/processing.php" );
                exit();
            }
            if ( !isset( $_SESSION['ICP'] ) )
            {   //no plans generated yet
                echo "<h1>Current session has no generated plans</h1>";
            }
            else
            {
                $title = "Study plan for " . $_SESSION['student'];
                echo "<h1>" . $title . "</h1>";

                if ( $_SESSION['new'] )
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
//run SQL statement
                    $incomplete = $_SESSION['ICP'];
                    $sql = "SELECT * FROM `subjects_prereq`";
                    $sql .= "WHERE `COURSE CODE` = '" . $incomplete[0] . " ' ";
                    for ( $i = 1; $i < count( $incomplete ); $i++ )
                    {
                        $sql .= "OR `COURSE CODE` = '" . $incomplete[$i] . " ' ";
                    }

                    $result = $conn->query( $sql );
                    $subjects = array();

                    while ( $row = $result->fetch_assoc() )
                    {//while getting results from SQL statement    
                        $newdata = array($row["COURSE CODE"], $row["PREREQUISITE1"],
                            $row["PREREQUISITE2"], $row["PREREQUISITE3"]);
                        array_push( $subjects, $newdata );
                    }

                    for ( $i = 0; $i < count( $subjects ); $i++ )
                    {
                        if ( $subjects[$i][2] !== 'None' )
                        {   //check if pre requisites are before subject and rearrange
                            checkPrereq( $i );
                        }
                    }
                    checkPrevious();

                    $semMonth = $_SESSION['month'];
                    $year = $_SESSION['year'];
                    $semesters = array();
                    setSem( $semMonth );//start planning with user sent data month and year
                    checkSem();
                    $plan = array();
                    //echo "<ul>";
                    for ( $row = 0; $row < count( $semesters ); $row++ )
                    {
                        $time = $semMonth . " " . $year . " Semester";
                        $output = array();
                        array_push( $output, $time );

                        for ( $col = 0; $col < sizeOf( $semesters[$row] ); $col++ )
                        {
                            $sub = getName( $semesters[$row][$col] );
                            array_push( $output, $sub );
                        }
                        array_push( $plan, $output );
                        $semMonth = changeMonth( $semMonth, true );

                        if ( $row == count( $semesters ) - 1 )
                        {   //place internship at last semester
                            $output = array();
                            $time = $semMonth . " " . $year . " Semester";
                            array_push( $output, $time, "INTERNSHIP" );
                            array_push( $plan, $output );
                        }
                    }
                    //echo "</ul>";                    
                    $_SESSION['plan'] = $plan;
                    $_SESSION['title'] = $title;
                    $_SESSION['new'] = false;
                }
                $plan = $_SESSION['plan'];
                echo "<ul>";
                for ( $row = 0; $row < count( $plan ); $row++ )
                {
                    if ( isset( $plan[$row][1] ) )
                    {
                        echo "<li><p><b>" . $plan[$row][0] . "</b></p> <ul>";
                        for ( $col = 1; $col < sizeOf( $plan[$row] ); $col++ )
                        {
                            if ( strpos( $plan[$row][$col], 'INTERNSHIP' ) !== false )
                            {
                                echo "<li style ='font-size:15px'>" . $plan[$row][$col] . "</li>";
                            }
                            else
                            {
                                echo "<li>" . $plan[$row][$col] . "</li>";
                            }
                        }
                        echo "</ul></li>";
                    }
                }
                echo "</ul><a href='http://localhost/PROject/edit.php'><button> Edit plan </button></a>";
                echo "<a href='PlanPDF.php' target='_blank' ><button>Save plan</button></a>";
            }
            $conn->close();
            ?>

        </div>	
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

                document.getElementById("demo").innerHTML = program;
            }

            function newSubject() {
                var subject = prompt("Please enter a program name");

            }
        </script>

    </body>
</html>