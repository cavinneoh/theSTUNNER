<html>
    <head>
        <title>Processing plan...</title>
        <link rel="stylesheet" type="text/css" href="style.css" />
        <style type="text/css">
            #container { width:600px; margin:0 auto; }
            #myCanvas { background:white; /*border:1px solid #cbcbcb*/; float:left }
        </style>
    </head>
    <script type="text/javascript">
        var context;
        var dx = 4;
        var dy = 4;
        var y = 30;
        var x = 30;
        var color = 'greenyellow';

        function draw() {
            context = myCanvas.getContext('2d');
            context.clearRect(0, 0, 350, 300);
            context.beginPath();
            context.fillStyle = color;
            context.arc(x, y, 20, 0, Math.PI * 2, true);
            context.closePath();
            context.fill();
            if ( x < 30 || x > 330 )
            {
                dx = -dx;
                color = changeColor();
                document.getElementById('txt').style.color = color;
            }
            x += dx;
        }
        function changeColor()
        {
            var a = Math.floor(Math.random() * 255);
            var b = Math.floor(Math.random() * 255);
            var c = Math.floor(Math.random() * 255);
            return 'rgb(' + a + ',' + b + ',' + c + ')';
        }
        setInterval(draw, 10);
    </script>

    <body class="color">
        <div class="top">

        </div>

        <div style="margin-left:22%;margin-top:7%;"><img src="img/Logo2.png" alt="Study Planner" style="width:50%;height:15%;" ></img></div>  <!--Logo-->

        <div class="big">
            <span class ='balltext' id = 'txt'>Generating plan</span>
            <canvas id="myCanvas" width="350" height="300"></canvas>   
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
        <?php header( "Refresh:3; url=http://localhost/PROject/PlanPage.php" );
        exit() ?>
    </body>
</html>
