<html>
    <head>
        <link rel="stylesheet" type="text/css" href="style.css" />
    </head>
    <body>        
        <?php
        include 'functions.php';
        
        if ( isset( $_GET["program"] ) )
        {
            $_SESSION['program'] = $_GET["program"];
        }
        if ( !isset( $_SESSION['program'] ) )
        {
            echo "<h1>Click on a program to view its subjects</h1>";
        }
        else
        {
            echo "<h1>" . $_SESSION['program'] . " subjects </h1>";
            echo "<table class='program'>" .
            "<tr><th class='program'>COURSE CODE</th><th class='program'>COURSE NAME</th><th>CREDIT HOURS</th><th class='program'>PREREQUISITE(S)</th></tr>";

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
            $sql = "SELECT * FROM `subjects_all` WHERE `PROGRAM` = '" . $_SESSION['program'] . "'";
            $result = $conn->query( $sql );

            while ( $row = $result->fetch_assoc() )
            {
                echo ("<tr><td class='program'>" . $row["COURSE CODE"] . "</td><td class='program'>" . $row["COURSE NAME"] . "</td><td class='program'>"
                . $row["CREDIT HOURS"] . "</td><td class='program'>" . $row["PREREQUISITE(S)"] . "</td></tr>");
            }

            echo "</table>" .
            "<button style='float:right;font-size:15px;padding:5px;margin-top:10px;margin-right:10px' onclick='newSubject()'>
            New Subject</button>";
        }
        $conn->close();
        ?>

    </body>
</html>