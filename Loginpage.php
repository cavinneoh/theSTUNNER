<html>
    <head>
        <title>The STUNNER</title>
        <link rel="stylesheet" type="text/css" href="style.css" />
    </head>			
    <body class="color"><?php
        if ( isset( $_GET['logout'] ) )
        {
            ?><script>
                alert("You have successfully logged out. Thank you for using the STUNNER.")
            </script><?php
            session_start();
            session_destroy();
        }
        if ( isset( $_POST["submit"] ) )
        {
            $uname = strtolower( $_POST['username'] );
            $passwd = crypt( $_POST['password'], '$1$getREKT!$' );

            $host = "localhost";
            $id = "root";
            $pass = "";
            $db = "dcsmy";

// Create connection to database
            $conn = new mysqli( $host, $id, $pass, $db );

            if ( $conn->connect_error )
            {   //if connection failed
                die( "Connection failed: " . $conn->connect_error );
            }
            $sql = "SELECT * FROM `admin_login` WHERE `USERNAME` = '$uname' AND `PASSWORD` = '$passwd' ";
            $result = $conn->query( $sql );
            if ( mysqli_num_rows( $result ) > 0 )//if query returns results
            {
                ?><script>
                    alert("<h3>Welcome to the STUNNER!<h3>");
                </script><?php
                header( 'Location:http://localhost/PROject/ProgramPage.php' );
                exit();
            }
            else
            {
                ?><script>
                    alert("Access denied! Incorrect username or password.")
                </script><?php
            }
            $conn->close();//close database connection
        }
        ?>
			<h1 class="textDIV">The STUNNER</h1>
        <form action='Loginpage.php' method ='post'>
            <div class="center"> 						<!-- Set the input field to the center -->		
                <table class="one"> 					<!-- Arrange input feild for id and password-->
					<tr>
						<th style="color:white"colspan="2">Admin Login</th>
					</tr>
                    <tr>
                        <td>Username: </td> 
                        <td><input type="text" name="username" required></td>
                    </tr>

                    <tr>
                        <td>Password: </td> 
                        <td><input type="password" name="password" required></td>	
                    </tr>

                    <tr>
                        <td colspan="2" style="text-align:right" ><input type="submit" name ='submit' value="Login"></td>
                    </tr>

                </table>
            </div>
        </form>
		<div class="logoGIF"><img src="img/Logo.gif" alt="Study Planner" class="logoGIF"></div>
    </body>
</html>