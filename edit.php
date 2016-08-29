<!DOCTYPE html>
<html>
    <head>
        <title>Editing Plan</title>
        <link rel="stylesheet" type="text/css" href="style.css" />
    </head>
    <style>

        li{
            list-style:none;
        }            

    </style>
    <script src="jQuery.js"></script>
</head>
<body class = 'color'>
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
    <div class="imgDiv">
        <img src="img/Logo2.png" alt="Study Planner" style="width:50%;height:15%;" ></img></div>
    <div class="bigger">
        <?php
        include 'functions.php';    ;//include functions file, also starts session
        $plan = $_SESSION['plan'];
        $title = $_SESSION['title'];
        echo "<h1>" . $title . "<br><span class ='error'>To edit plan, drag and drop subjects</span></h1>";

        for ( $row = 0; $row < count( $plan ); $row++ )
        {
            if ( strpos( $plan[$row][0], 'January' ) !== false )
            {
                $boxes = 4;
            }
            else
            {
                $boxes = 6;
            }
            echo "<div id = 'columns' class = 'edit'><b><li>" . $plan[$row][0] . "</li></b>";
            if ( sizeOf( $plan[$row] ) < 2 )
            {
                $cols = 0;
            }
            else
            {
                for ( $col = 1; $col < sizeOf( $plan[$row] ); $col++ )
                {
                    echo "<li class='column' draggable='true'>" . $plan[$row][$col] . "</li>";
                    $cols = $col;
                }
            }
            while ( $cols++ < $boxes )
            {
                echo "<li class='column' draggable='true' style = 'height:12px' > </li>";
            }
            echo "</div>";

            if ( ($row + 1) % 3 == 0 )
            {
                echo "<div style = 'clear:both'></div>";
            }
        }
        ?>
        <button class="button3" style="clear:both" onclick="save()">Save and close</button>
        <button class="button3" onclick="goBack()">Exit without saving</button>
    </div>
    <script>
        function save() {
            var x = document.getElementsByTagName("LI");
            var i = 0;
            var arr = [ ];

            for ( i = 0; i < x.length; i++ ) {
                var a = x[i].innerHTML;
                arr.push(a + ", ");
            }
            var str = JSON.stringify(arr);

            $.ajax({
                type: "POST",
                url: "edit2.php",
                data: { data: str },
                success: function (data) {
                    //window.alert(data);
                    window.alert("Changes to plan saved!");
                    window.location = 'planPage.php';
                },
                error: function () {
                    window.alert("Oops, something went wrong");
                }
            });
        }
        function goBack()
        {
            window.location = 'planPage.php';
        }
        var dragSrcEl = null;

        function handleDragStart(e) {

            dragSrcEl = this;

            e.dataTransfer.effectAllowed = 'move';
            e.dataTransfer.setData('text/html', this.innerHTML);
        }
        function handleDragOver(e) {
            if ( e.preventDefault ) {
                e.preventDefault(); // Necessary. Allows us to drop.
            }

            e.dataTransfer.dropEffect = 'move';  // See the section on the DataTransfer object.

            return false;
        }

        function handleDragEnter(e) {
            // this / e.target is the current hover target.
            this.classList.add('over');
        }

        function handleDragLeave(e) {
            this.classList.remove('over');  // this / e.target is previous target element.
        }

        var cols = document.querySelectorAll('#columns .column');
        [ ].forEach.call(cols, function (col) {
            col.addEventListener('', handleDragStart, false);
            col.addEventListener('dragenter', handleDragEnter, false);
            col.addEventListener('dragover', handleDragOver, false);
            col.addEventListener('dragleave', handleDragLeave, false);
        });

        function handleDrop(e) {
            // this/e.target is current target element.

            if ( e.stopPropagation ) {
                e.stopPropagation(); // Stops some browsers from redirecting.
            }

            // Don't do anything if dropping the same column we're dragging.
            if ( dragSrcEl != this ) {
                // Set the source column's HTML to the HTML of the column we dropped on.
                dragSrcEl.innerHTML = this.innerHTML;
                this.innerHTML = e.dataTransfer.getData('text/html');
            }

            return false;
        }

        function handleDragEnd(e) {
            // this/e.target is the source node.

            [ ].forEach.call(cols, function (col) {
                col.classList.remove('over');
            });
        }

        var cols = document.querySelectorAll('#columns .column');
        [ ].forEach.call(cols, function (col) {
            col.addEventListener('dragstart', handleDragStart, false);
            col.addEventListener('dragenter', handleDragEnter, false)
            col.addEventListener('dragover', handleDragOver, false);
            col.addEventListener('dragleave', handleDragLeave, false);
            col.addEventListener('drop', handleDrop, false);
            col.addEventListener('dragend', handleDragEnd, false);
        });
    </script>
</body>
</html>

<!--function myFunction() {
    var x = document.getElementsByTagName("LI");   
    var i=0;
    var arry =[];

for(i=0; i<x.length; i++){
var a=x[i].innerHTML;
if(i==0 || i==5 || i==12 || i==19 || i==24 || i==31)
arry.push(a);
}

document.getElementById("demo").innerHTML = arry;

}-->
