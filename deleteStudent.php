<?php
session_start();//enable retrieving of session data
if ( isset( $_GET['Dname'] ) )
{   //if data is sent over
    $D = $_GET['Dname'];
    $sql = "DELETE FROM `student_info` WHERE `STUDENT NAME` = '$D' ;";
    echo "deleting $D ...";
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
    {
        $msg = $D . " removed from database.";
        ?>
        <script>
            alert("<?php echo $msg; ?>");
        </script>
        <?php
    }
    else
    {
        $msg = "ERROR! Deleting query failed.";
        ?>
        <script>
            alert("<?php echo $msg; ?>");
        </script>
        <?php
    }
    unset( $_SESSION['prog'] );//clear session data so that 
                                //old student data is cleared
    $conn->close();
    ?>
    <script>
        window.top.location.href = 'http://localhost/PROject/StudentPage.php';/* Redirect browser */
    </script>
    <?php
    exit();//prevent running remaining codes
}
if ( isset( $_POST['submit'] ) )
{
    if ( !empty( $_POST['delete'] ) )
    {
        $deleting = $_POST['delete'];
        foreach ( $deleting as $d )
        {
            $delID = $d;
            $delName = $_POST["$d"];
        }
        $sql = "DELETE FROM `student_subjects` WHERE `STUDENT ID` = '$delID' ;";
    }
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
    {
        $page = "location:deleteStudent.php?Dname=" . $delName;
        header( $page );
    }
    else
    {
        $msg = "ERROR! Unable to delete.";
        ?>
        <script>
            alert("<?php echo $msg; ?>");
        </script>
        <?php
    }
    $conn->close();
}
else
{
    echo "<h1>Deleting student, one at a time</h1>";
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
    echo "<form action ='deleteStudent.php' method ='post'>";
    while ( $row = $result->fetch_assoc() )
    {//while getting results from SQL statement   
        echo "<input type = 'radio' name = 'delete[]' value = '" . $row["STUDENT ID"] . "'>";
        echo $row["STUDENT NAME"] . " (" . $row["STUDENT ID"] . ")<br>";
        echo "<input type = 'hidden' name = '" . $row["STUDENT ID"] . "' value = '" . $row["STUDENT NAME"] . "'>";
    }
    echo "<input type='submit' value='Delete selected student' name='submit'/>";
    $conn->close();
}
?>