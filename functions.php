<?php

session_start();

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
$sql = "SELECT * FROM `subjects_name` ";
$result = $conn->query( $sql );
$subName = array();

while ( $row = $result->fetch_assoc() )
{//while getting results from SQL statement    
    $newdata = array($row["COURSE CODE"], $row["COURSE NAME"], $row["PROGRAM"]);
    array_push( $subName, $newdata );
}

function swapPos( $a, $b )
{
    $buffer = array();
    $sub = $GLOBALS['subjects'];
    for ( $i = 0; $i < sizeOf( $sub[$a] ); $i++ )
    {
        $buffer[$i] = $sub[$a][$i];
        $sub[$a][$i] = $sub[$b][$i];
        $sub[$b][$i] = $buffer[$i];
    }
    $GLOBALS['subjects'] = $sub;
    checkPrereq( $a );
    //repeat checking after swap, stops when swapping ends
}

function checkPrereq( $i )
{   //check if pre-requisite is directly before subject
    $sub = $GLOBALS['subjects'];

    for ( $j = $i + 1; $j < count( $sub ); $j++ )
    {
        if ( $sub[$i][1] === $sub[$j][0] )
        {
            //j is a bigger index than i. This code check if prerequisite is behind subject targeted.
            swapPos( $i, $j );
        }
    }
}

function checkPrevious()
{   //function to check if pre-requisite is directly before subject
    //if found create swap a subject in between the two;
    for ( $v = count( $GLOBALS['subjects'] ) - 1; $v > 0; $v-- )
    {
        if ( $GLOBALS['subjects'][$v][1] === $GLOBALS['subjects'][$v - 1][0] )
        {
            if ( $v == count( $GLOBALS['subjects'] ) - 1 )
            {
                swapPos( $v - 1, $v - 2 );
            }
            else
            {
                swapPos( $v, $v + 1 );
            }
        }
    }
}

function changeMonth( $m, $changeYear )
{
    if ( $m === 'January' )
    {
        $m = 'April';
    }
    else if ( $m === 'April' )
    {
        $m = 'August';
    }
    else
    {
        $m = 'January';
        if ( $changeYear )
        {
            $GLOBALS['year'] ++;
        }
    }
    return $m;
}

function setSem( $month )
{
    $sub = $GLOBALS['subjects'];
    $sem = $GLOBALS['semesters'];
    $buffer = array();
    $subCount = 0;

    for ( $i = 0; $i < sizeOf( $sub ); $i++ )
    {
        switch ($month)
        {
            case 'January':
                $limit = 3;
                $spc = 'ENL';
                break;
            default:
                $limit = 5;
                $spc = 'MPU';
        }
        if ( $subCount == 0 ) //subfunction to split MPU and ENL subjects between semesters
        {
            for ( $j = $i; $j < sizeOf( $sub ); $j++ )
            {
                if ( strpos( $sub[$j][0], $spc ) !== false )//if array position contains substring 'MPU' OR 'ENL'
                {
                    array_push( $buffer, $sub[$j][0] );
                    $subCount ++;
                    $sub[$j][0] = null;
                    break;
                }
            }
        }
        if ( $sub[$i][0] !== null )
        {
            array_push( $buffer, $sub[$i][0] );
            $subCount ++;
        }
        if ( $subCount == 4 ) //subfunction to push MTH subjects in front
        {
            for ( $j = $i; $j < sizeOf( $sub ); $j++ )
            {
                if ( strpos( $sub[$j][0], 'MTH' ) !== false )//if array position contains substring 'MPU'
                {
                    array_push( $buffer, $sub[$j][0] );
                    $subCount ++;
                    $sub[$j][0] = null;
                    break;
                }
            }
        }
        if ( $subCount == $limit || $i == sizeOf( $sub ) - 1 )
        {
            if ( sizeOf( $buffer ) > 0 )
            {
                array_push( $sem, $buffer );
                $buffer = array();
                $month = changeMonth( $month, false );
                $subCount = 0;
            }
        }
    }
    $GLOBALS['semesters'] = $sem;
}

function checkLast( $code )//check if subject is a prerequisite of another subject
{
    $sub = $GLOBALS['subjects'];
    $last = true;
    if ( strpos( $code, 'CSC' ) !== false )//if code is a CSC subject
    {
        for ( $i = 0; $i < count( $sub ); $i++ )
        {
            if ( $sub[$i][1] === $code || $sub[$i][2] === $code || $sub[$i][3] === $code )
            {
                $last = false;
                break;
            }
        }
    }
    else
    {
        $last = false;
    }
    return $last;
}

function checkFirst( $code )
{
    $sub = $GLOBALS['subjects'];
    $first = false;

    if ( !(strpos( $code, 'MPU' ) !== false) )//if code is NOT MPU subject
    {
        for ( $i = 0; $i < count( $sub ); $i++ )
        {
            if ( $sub[$i][0] == $code && $sub[$i][1] == 'None' )
            {
                $first = true;
                break;
            }
        }
    }
    return $first;
}

function swapSem( $y, $w, $x )
{
    $sub = $GLOBALS['subjects'];
    $sem = $GLOBALS['semesters'];

    if ( $y == count( $sem ) - 1 ) //if clash in last semester
    {
        for ( $row = $y - 1; $row >= 0; $row -- )
        {
            for ( $col = 0; $col < sizeOf( $sem[$row] ); $col++ )
            {
                $last = checkLast( $sem[$row][$col] );
                //put subject not acting as any prerequisite
                if ( $last )
                {
                    $buffer = $sem[$y][$w];
                    $sem[$y][$w] = $sem[$row][$col];
                    $sem [$row][$col] = $buffer;
                    break 2;
                }
            }
        }
    }
    else if ( $y == 0 && count( $sem ) > 4 ) //if clash in first semester && number of semesters > 4
    {                                       
        for ( $row = $y + 1; $row < count( $sem ); $row ++ )
        {
            for ( $col = 0; $col < sizeOf( $sem[$row] ); $col++ )
            {
                $first = checkFirst( $sem[$row][$col] );
                //put subject without pre-requisite
                if ( $first )
                {
                    $buffer = $sem[$y][$x];
                    $sem[$y][$x] = $sem[$row][$col];
                    $sem [$row][$col] = $buffer;
                    break 2;
                }
            }
        }
    }
    else
    {
        $buffer = $sem[$y][$x];
        $sem[$y][$x] = $sem[$y + 1][0];
        $sem[$y + 1][0] = $buffer;
    }
    $GLOBALS['semesters'] = $sem;
}

function checkSem()
{
    $sub = $GLOBALS['subjects'];

    for ( $y = count( $GLOBALS['semesters'] ) - 1; $y >= 0; $y-- )
    {
        for ( $x = sizeOf( $GLOBALS['semesters'][$y] ) - 1; $x >= 0; $x-- )
        {
            $code = $GLOBALS['semesters'][$y][$x];
            $z = 0;
            $prereq;
            while ( $z++ < count( $sub ) - 1 )
            {
                if ( $sub[$z][0] === $code )
                {
                    $prereq = $sub[$z][1];
                    break;
                }
            }
            if ( $prereq !== 'None' )
            {
                for ( $w = $x - 1; $w >= 0; $w-- )
                {
                    if ( $GLOBALS['semesters'][$y][$w] === $prereq )
                    {
                        swapSem( $y, $w, $x );
                    }
                }
            }
        }
    }
}

function getName( $code )
{
    $sub = $GLOBALS['subName'];
    //echo "finding name for [" . $code . "]";
    for ( $i = 0; $i < count( $sub ); $i++ )
    {
        //echo "<br>checking " . $sub[$i][0];
        if ( $sub[$i][0] === $code )
        {
            //echo "<br>subject is ".$GLOBALS['subName'][$i]."while name is ".$GLOBALS['subName'][$i+1];
            return $sub[$i][1];
            break;
        }
    }
}
