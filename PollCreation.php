<?php
session_start();
if(!isset($_SESSION["uid"]))
{
    header("Location: MainPage.php");
    exit();
}
$validate = true;
$topic = "";
$open_date = "";
$close_date = "";
$answer1 = "";
$answer2 = "";
$answer3 = "";
$answer4 = "";
$answer5 = "";
$user_id = $_SESSION["uid"];
$username = $_SESSION["user_uname"];
$image = $_SESSION["user_image"];

if(isset($_POST["Create"]) && $_POST["Create"])
{
    $topic = trim($_POST["pollcreation"]);
    $open_date = trim($_POST["opdate"]);
    $close_date = trim($_POST["exdate"]);
    $answer1 = trim($_POST["answer1"]);
    $answer2 = trim($_POST["answer2"]);
    $answer3 = trim($_POST["answer3"]);
    $answer4 = trim($_POST["answer4"]);
    $answer5 = trim($_POST["answer5"]);
    $current_date = date("Y-m-d");


    $db = new mysqli("localhost", "username", "password", "database");
    if ($db->connect_error)
    {
        die ("Connection failed: " . $db->connect_error);
    }


    $questionLen = strlen ($topic);
    if($topic == null || $topic == "" || $questionLen > 100)
    {
        $validate = false;
    }
    if($open_date == null || $open_date == "")
    {
        $validate = false;
    }
    if($close_date == null || $close_date == "")
    {
        $validate = false;
    }

    if(strlen ($answer1) > 50 || strlen ($answer2) > 50 || strlen ($answer3) > 50 || strlen ($answer4) > 50 || strlen ($answer5) > 50)
    {
        $validate = false;
    }
    if($validate == true)
    {
        $q1 = "INSERT INTO Polls( uid, poll_question, poll_opendate, poll_expiredate, poll_createdate, poll_lastdate) VALUES ( '$user_id' , '$topic', '$open_date', '$close_date', '$current_date', '$current_date')";
        $r1 = $db->query($q1);
        
        $pollID = $db->insert_id;
        
        
        if($answer1 != null && $answer1 != "")
        {
            $q2 = "INSERT INTO Answers( pid, answer_answer) VALUES ( '$pollID', '$answer1')";
            $r2 = $db->query($q2);            
        }

        if($answer2 != null && $answer2 != "")
        {
            $q3 = "INSERT INTO Answers( pid, answer_answer) VALUES ( '$pollID', '$answer2')";
            $r3 = $db->query($q3);            
        }
       
        if($answer3 != null && $answer3 != "")
        {
            $q4 = "INSERT INTO Answers( pid, answer_answer) VALUES ( '$pollID', '$answer3')";
            $r4 = $db->query($q4);            
        }

        if($answer4 != null && $answer4 != "")
        {
            $q5 = "INSERT INTO Answers( pid, answer_answer) VALUES ( '$pollID', '$answer4')";
            $r5 = $db->query($q5);            
        }

        if($answer5 != null && $answer5 != "")
        {
            $q6 = "INSERT INTO Answers( pid, answer_answer) VALUES ( '$pollID', '$answer5')";
            $r6 = $db->query($q6);            
        }


        if ($r1 === true)
        {
            header("Location: PollManagement.php");
            $db->close();
            exit();
        }
    }
    else
    {
        $error = "Create failed.";
        echo "<script type='text/javascript'>alert('$error');</script>";
        $db->close();
    }
}
?>

<!DOCTYPE html>
<html>
<head>

<title> Poll Creation Page </title>
<link rel="stylesheet" type="text/css" href="Poll.css">
<script type="text/javascript" src="V.js"> </script>
<script>
  function textCounter(field,field2,maxlimit)
  {
   var countfield = document.getElementById(field2);
   if ( field.value.length > maxlimit ) {
    field.value = field.value.substring( 0, maxlimit );
    return false;
   } else {
    countfield.value = maxlimit - field.value.length;
   }
  }
</script>
</head>

<body>
<header id="localstyle_para">
<img class="welcome_img" src="logo.jpg" alt="Welcome Image">
<div class="caption">
<img class="logininfo" src="<?=$image?>" alt="login">
<p><?=$username?></p><a href="LogOut.php">log out</a>
</div>        
<h1> Welcome To We-Poll </h1>
<h3>Easily make your poll here</h3>
</header>

<section>
<p style="font-size: 120%">Create a new poll here:</p>

<form id="Create" action="PollCreation.php" method="post">
<table id="createtable">
  <tr><td colspan="5"><label id="topic_msg" class="err_msg"></label></td></tr>
  <tr><td colspan="5"><input id="pollcreation"  type="text" name="pollcreation" size="100" onkeyup="textCounter(this,'counter',100)" />
  <input disabled maxlength="4" size="3" value="100"  id="counter"/></td></tr>
           
  <tr>
    <td>Open date:</td>
    <td><input id="opdate" name="opdate" size="30" type="date"/></td>
    <td>Expiry date:</td>
    <td><input id="exdate" name="exdate" size="30" type="date"/></td></tr>
  <tr><td></td><td><label id="open_msg" class="err_msg"></label></td><td></td><td><label id="close_msg" class="err_msg"></label></td></tr> 

  <tr><td></td><td></td><td><label id="ans_msg" class="err_msg"></label></td></tr>
  <tr>
    <td><input class="answers" id="answer1" type="text" placeholder="answer1, can be blank" name="answer1" onkeyup="textCounter(this,'counter1',50)"/>
    <input disabled  maxlength="4" size="3" value="50"  id="counter1"/></td>
    <td><input class="answers" id="answer2" type="text" placeholder="answer2, can be blank" name="answer2" onkeyup="textCounter(this,'counter2',50)"/>
    <input disabled  maxlength="4" size="3" value="50"  id="counter2"/></td>
    <td><input class="answers" id="answer3" type="text" placeholder="answer3, can be blank" name="answer3" onkeyup="textCounter(this,'counter3',50)"/>
    <input disabled  maxlength="4" size="3" value="50"  id="counter3"/></td>
    <td><input class="answers" id="answer4" type="text" placeholder="answer4, can be blank" name="answer4" onkeyup="textCounter(this,'counter4',50)"/>
    <input disabled  maxlength="4" size="3" value="50"  id="counter4"/></td>
    <td><input class="answers" id="answer5" type="text" placeholder="answer5, can be blank" name="answer5" onkeyup="textCounter(this,'counter5',50)"/>
    <input disabled  maxlength="4" size="3" value="50"  id="counter5"/></td>
  </tr>
</table>

<p><input type="submit" id="pollsubmit" name="Create" value="Create"/><input type="reset" name="Reset" value="Reset" /></p>

<a href="PollManagement.php">Back to list page</a>
</form >
</section>
<script type = "text/javascript"  src = "Creation-r.js" ></script>
</body>

</html>