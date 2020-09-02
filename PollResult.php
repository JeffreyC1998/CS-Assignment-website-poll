<?php
session_start();
$poll_id = $_GET["pid"];    
$db = new mysqli("localhost", "username", "password", "database");
if ($db->connect_error) {
    die ("Connection failed: " . $db->connect_error);
}
$q1 = "SELECT uid, poll_createdate, poll_question FROM Polls WHERE pid = '$poll_id'";
$r1 = $db->query($q1);
$row1 = $r1->fetch_assoc();
$poster_id = $row1["uid"];
$poll_dateC = $row1["poll_createdate"];
$poll_topic = $row1["poll_question"];
?>

<!DOCTYPE html>
<html>
<head>
<title> Poll Result Page </title>
<link rel="stylesheet" type="text/css" href="Poll.css">
</head>

<body>

<header id="localstyle_para">
<img class="welcome_img" src="logo.jpg" alt="Welcome Image">
<?php
if (isset($_SESSION["uid"])){
    $username = $_SESSION["user_uname"];
    $image = $_SESSION["user_image"];
?>
<div class="caption">
<img class="logininfo" src="<?=$image?>" alt="login">
<p><?=$username?></p><a href="LogOut.php">log out</a>
</div>
<?php
}
?>


<h1> Welcome To We-Poll </h1>
<h3>Easily make your poll here</h3>
</header>

<section class="vote">
<div class="posterinfo">
<?php
    $q2 = "SELECT user_image, user_uname FROM Users WHERE uid = '$poster_id'";
    $r2 = $db->query($q2);
    $row2 = $r2->fetch_assoc();
    $poster_img = $row2["user_image"];
    $poster_name = $row2["user_uname"];
?>
<img class="posterimg" src="<?=$poster_img?>" alt="poster">
<p class="poster1"><?=$poster_name?></p><?=$poll_dateC?>
</div>

<h4 class="posttopic">
<?=$poll_topic?>
</h4>
<div class="result">
<?php   

$q3 = "SELECT * FROM Answers WHERE pid = '$poll_id'";
$r3 = $db->query($q3);
$countVote = 0;
while ($row3 = $r3->fetch_assoc()){
    $answer_id = $row3['aid'];
    $q4 = "SELECT * FROM Votes WHERE aid = '$answer_id'";
    $r4 = $db->query($q4);

    while ($row4 = $r4->fetch_assoc())
    {
        $countVote = $countVote + 1;
    }
}

$q5 = "SELECT * FROM Answers WHERE pid = '$poll_id'";
$r5 = $db->query($q5);
$colorX = 0;
$colorY = 0;
$colorZ = 0;
while ($row5 = $r5->fetch_assoc()){
    $countAnswer = 0; 
    $answer_id = $row5['aid'];
    $q6 = "SELECT * FROM Votes WHERE aid = '$answer_id'";
    $r6 = $db->query($q6);
    while ($row6 = $r6->fetch_assoc())
    {
        $countAnswer = $countAnswer + 1;               
    }
$countPercent = $countAnswer / $countVote * 100;
$colorX = $colorX + 40;
$colorY = $colorY + 40;
$colorZ = $colorZ + 40;
if ($countPercent != 0){
?>
<div style="background-color: rgb(<?=$colorX?>, <?=$colorY?>, <?=$colorZ?>); width: <?=$countPercent?>%;"> <?=$row5["answer_answer"]?></div>
<?php
}
}
?> 
</div>
<div class="back">
<a href="PollManagement.php">Back to list page</a>        
</div>
</section>



</body>

</html>