<?php
//seperate file to catch edited plan
session_start();

$data = json_decode( stripslashes( $_POST['data'] ) );
$PLAN = array();
$pusher = array();
$a = 0;
$b = 0;
foreach ( $data as $d )
{
    $e = str_replace(',', '', $d);
    if ( (strpos( $d, 'Semester' ) !== false) && $b > 0 )
    {
        $a++;
        $b = 0;
    }
    if ( trim($e) !== '' )
    {
        $PLAN[$a][$b] = $e;
        $b++;
    }
}
$_SESSION['plan'] = $PLAN;//update plan after editing
/*
for ( $count= 0; $count < count( $_SESSION['plan'] ); $count++ )
{
    foreach ($_SESSION['plan'][$count] as $c)
    {
        echo "<br>" . $c;
    }
}*/
