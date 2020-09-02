<?php
session_start();
$poll_id = $_SESSION["pid"]; 

$vote = $_REQUEST['vote'];
$db = new mysqli("localhost", "username", "password", "database");
if ($db->connect_error)
{
    die ("Connection failed: " . $db->connect_error);
}
$validate = true;
$current_date = date("Y-m-d");

$q1 = "SELECT aid, answer_answer FROM Answers WHERE pid = '$poll_id'";
$r1 = $db->query($q1);

while ($row1 = $r1->fetch_assoc())
{
    $answer_id = $row1["aid"];

    if ($vote == $row1["answer_answer"])
    {
        $AID = $answer_id;
    }
    
}


if ($vote == null || $vote == "") 
{
    $validate = false;
}
if ($validate == true)
{
    $q2 = "INSERT INTO Votes (aid, vote_date) VALUES ( '$AID', '$current_date')";
    $r2 = $db->query($q2);
}

if ($r2 === true)
{   
    $q3 = "UPDATE Polls SET poll_lastdate = '$current_date' WHERE pid = '$poll_id'";
    $r3 = $db->query($q3);
    $db->close();
    exit();
}
else
{
    $error = "Vote failed.";
    echo "<script type='text/javascript'>alert('$error');</script>";
    $db->close();
}
?>