<head>
    <title>STUNNER Programs</title>
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
                     <h2>Logout</h2></a>		  <!--Logout-->
        </div>
		
        <div class="imgDiv""><img src="img/Logo2.png" alt="Study Planner" class="logo"></div>  <!--Logo-->

        <div class="left"> 																												   <!--side bar-->
            <h4 class="click" onclick="myFunction()" style="font-size:25px;">Programs</h4>													   <!-- side bar content-->
            <ul id="myDIV">																													   
                <li class="text"><a class="text2" href = "ProgramFrame.php?program=DCSMY" target = "frame">DCSMY</a></li>
                <li>DBIS</li>
            </ul>

            <button style="font-size:15px;padding:5px;margin-top:10px;margin-right:10px;float:left" onclick="add()"> Add </button>
        </div>

        <iframe class="big" src="ProgramFrame.php" name = "frame" style="margin-left:30px;"></iframe>	

            
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
                var subeject = prompt("Please enter a subject name");

            }
        </script>

</body>
</html>