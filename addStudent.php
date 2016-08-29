<html><head>
        <link rel="stylesheet" type="text/css" href="style.css" />
    </head>
    <body>
        <?php
        include 'functions.php';

        $error1 = "";
        $error2 = "";
        if ( isset( $_POST["submit"] ) )//if student data is posted over
        {
            if ( empty( $_POST["name"] ) )
            {
                $error1 = "please enter student name";
            }
            else
            {
                $clear1 = true;
                $name = strtoupper( $_POST["name"] );
                if ( !ctype_alpha( str_replace( ' ', '', $name ) ) )
                {
                    $clear1 = false;
                }
                if ( !$clear1 )
                {
                    $error1 = "name must consist of letters only";
                }
            }
            if ( empty( $_POST["id"] ) )
            {
                $error2 = "please enter student ID";
            }
            else
            {
                $clear2 = true;
                $noDupes = true;
                $ID = strtoupper( $_POST["id"] );
                if ( strlen( $ID ) !== 8 )
                {
                    $clear2 = false;
                }
                else
                {
                    for ( $i = 1; $i < strlen( $ID ); $i++ )
                    {
                        if ( $ID[0] !== 'C' || $ID[$i] < '0' || $ID[$i] > '9' )
                        {
                            $clear2 = false;
                        }
                    }
                }
                if ( !$clear2 )
                {
                    $error2 = "student ID must be 8 characters ('C' followed by 7 numbers, eg C1234567)";
                }
                else
                {
                    foreach ( $_SESSION['existing'] as $z )
                    {
                        if ( $ID === $z )
                        {
                            $noDupes = false;
                        }
                    }
                    if ( !$noDupes )
                    {
                        $error2 = "ERROR! student ID already exists in database.";
                    }
                }
            }
            if ( isset( $clear1 ) && isset( $clear2 ) && isset( $noDupes ) )
            {
                if ( $clear1 && $clear2 && $noDupes )
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
                    $sql = "INSERT INTO `student_info`(`STUDENT ID`, `STUDENT NAME`, `PROGRAM`) "
                            . "VALUES ('$ID', '$name', '" . $_POST["program"] . "')";

                    $next = "http://localhost/PROject/AddSubjects.php?NAME="
                            . $name . "&ID=" . $ID . "&PRO=" . $_POST["program"]
                            . "&SQL=" . $sql;
                    if ( $conn->query( $sql ) === TRUE )
                    {   //if SQL is successful
                        $next = "http://localhost/PROject/AddSubjects.php?NAME="
                                . $name . "&ID=" . $ID . "&PRO=" . $_POST["program"];
                        ?>
                        <script>
                            window.location = "<?php echo $next ?>";
                        </script>
                        <?php
                        exit();
                    }
                    else
                    {
                        ?>
                        <script>
                            alert("ERROR! Query failed! Student not registered");
                        </script>
                        <?php
                    }
                }
            }
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

//run SQL statement
            $sql = "SELECT `STUDENT ID` FROM `student_info` ";
            $result = $conn->query( $sql );
            $existingID = array();
            while ( $row = $result->fetch_assoc() )
            {//while getting results from SQL statement  
                array_push( $existingID, $row["STUDENT ID"] );
            }
            $_SESSION['existing'] = $existingID;
        }
        $conn->close();
        ?>
        <h1> Adding a new student</h1>
        <form action ='addStudent.php' method ='post'>
            <table >
                <tr>
                <tr>
                    <td>Program:</td>
                    <td><select name ='program'>
                            <option value = 'DCSMY'> DCSMY </option>
                        </select>
                    </td>
                </tr>
                </tr>
                <tr>			
                    <td>Student Name :</td>
                    <td><input type="text" name="name"></td> 
                    <td><span class="error"><?php echo $error1; ?></span></td>
                </tr>
                <tr>
                    <td>Student ID :</td>
                    <td><input type="text" name="id"></td> 
                    <td><span class="error"><?php echo $error2; ?></span></td>
                </tr>

                <tr>							
                    <td>
                        <input type="submit" value="Submit" name="submit">
                    </td>
                </tr>
            </table>
        </form>
    </body>
</html>
