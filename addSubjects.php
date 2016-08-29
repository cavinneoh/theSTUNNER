<html><head>
        <link rel="stylesheet" type="text/css" href="style.css" />
    </head>
    <body>

        <?php
        include 'functions.php';

        if ( isset( $_POST['submit'] ) )
        {//to run PHP script on submit
            $id = $_GET['sID'];            
            $name = $_GET["nama"];
            $query = "INSERT INTO `student_subjects`(`STUDENT ID`,`COURSE CODE`,`COMPLETED`) VALUES ";
            $subList = $_SESSION['sublist'];

            if ( !empty( $_POST['completed'] ) )
            {
// Loop to store and display values of individual checked checkbox.
                foreach ( $_POST['completed'] as $complete )
                {
                    $query .= "('$id', '$complete', 1),";
                }
                $incomplete = array_diff( $subList, $_POST['completed'] );
                foreach ( $incomplete as $z )
                {
                    $query .= "('$id', '$z', 0),";
                }
            }
            else
            {
                foreach ( $subList as $z )
                {
                    $query .= "('$id', '$z', 0),";
                }
            }
            $sql = substr( $query, 0, -1 );

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
            if ( $conn->query( $sql ) === TRUE )//if SQL is successful  
            {   $msg = "[$name] subjects record added." ;
                ?>
                <script>
                    alert("<?php echo $msg; ?>");
                </script>
                <?php 
            }
            else
            {   $msg = "ERROR! Query failed! [$name] subjects record NOT added." ;
                ?>
                <script>
                    alert("<?php echo $msg; ?>");
                </script>
                <?php
            }
            unset( $_SESSION['prog'] );
            $conn->close();
            ?>
            <script>
                window.top.location.href = 'http://localhost/PROject/StudentPage.php';/* Redirect browser */
            </script>
            <?php
            exit();
        }
        else
        {
            $pro = $_GET["PRO"];
            $id = $_GET["ID"];
            $name = $_GET["NAME"];

            echo "<h3>Please check completed subjects of <u>" . $name . " (" . $id . ") </u> :"
            . "<br><span class='error'>*LEAVE IT BLANK IF <u>" . $name . "</u> IS A NEW STUDENT*</span></h3><ol>";

            echo "<form action ='addSubjects.php?sID=" . $id . "&nama=" . $name . "' method ='post'>";

            $subList = array();
            for ( $i = 0; $i < count( $GLOBALS['subName'] ); $i++ )
            {
                if ( $GLOBALS['subName'][$i][2] === $pro )
                {
                    echo "<input type = 'checkbox' name = 'completed[]' value = '" . $GLOBALS['subName'][$i][0]
                    . "'>" . $GLOBALS['subName'][$i][0] . " " . $GLOBALS['subName'][$i][1] . "</input></br>";
                    array_push( $subList, $GLOBALS['subName'][$i][0] );
                }
            }
            $_SESSION['sublist'] = $subList;
            echo "<input type='submit' value='Enter into database' name='submit'/>";
        }
        ?>

    </form>
</body></html>