<?php
session_start();
if(!isset($_SESSION["uid"]))
{
    header("Location: MainPage.php");
    exit();
}
else{
    $user_id = $_SESSION["uid"];
    $username = $_SESSION["user_uname"];
    $image = $_SESSION["user_image"];

    $db = new mysqli("localhost", "username", "password", "database");
    if ($db->connect_error) {
        die ("Connection failed: " . $db->connect_error);
    }
    $current_date = date("Y-m-d");
}
?>
<!DOCTYPE html>
<html>
<head>
<title> Poll Management Page </title>
<style>
    td, th {
    border: 1px solid #dddddd;
    text-align: center;
    padding: 8px;
  }

  table {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100%;
  }
</style>
<link rel="stylesheet" type="text/css" href="Poll.css">
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
<a href="PollCreation.php"><p style="text-align: center">Wants to make a poll?</p></a>
</section>

<footer class="postedpoll">

<p>Polls you post:</p>
<table>
<tr>
    <th style="width: 12%">date/time of creation</th>
    <th style="width: 22%">poll topics</th>
    <th style="width: 18%">answers</th>
    <th style="width: 31%">Poll distribution</th>
    <th style="width: 6%">number of votes</th>
    <th style="width: 6%"> date/time of the most recent vote</th>
    <th style="width: 5%">go to vote</th>
</tr>
    <?php 

        $q2 = "SELECT * FROM Polls WHERE uid = $user_id;";
        $r2 = $db->query($q2);
        

        while ($row = $r2->fetch_assoc()) {  
            if ($current_date >= $row["poll_opendate"] && $current_date <= $row["poll_expiredate"])
            {    
    ?>
<tr>
    <td><?=$row["poll_createdate"]?></td>
    <td><a href="PollResult.php?pid=<?=$row["pid"]?>"><?=$row["poll_question"]?></a></td>
    <td><?php    
        $poll_id = $row['pid'];
        $q3 = "SELECT * FROM Answers WHERE pid = '$poll_id'";
        $r3 = $db->query($q3);
        $countVote = 0;
        while ($row2 = $r3->fetch_assoc()){
            $answer_id = $row2['aid'];
            $q4 = "SELECT * FROM Votes WHERE aid = '$answer_id'";
            $r4 = $db->query($q4);

            while ($row3 = $r4->fetch_assoc())
            {
                $countVote = $countVote + 1;
            }

        ?>
    <?=$row2["answer_answer"]?> 
    <?php
    }
    ?> 
    </td>
    <td class="resultMaP"><?php
        $poll_id = $row['pid'];
        $q5 = "SELECT * FROM Answers WHERE pid = '$poll_id'";
        $r5 = $db->query($q5);
        $colorX = 0;
        $colorY = 0;
        $colorZ = 0;
        while ($row4 = $r5->fetch_assoc()){
        $countAnswer = 0; 
            $answer_id = $row4['aid'];
            $q6 = "SELECT * FROM Votes WHERE aid = '$answer_id'";
            $r6 = $db->query($q6);
            while ($row5 = $r6->fetch_assoc())
            {
                $countAnswer = $countAnswer + 1;                
            }
            $countPercent = $countAnswer / $countVote * 100;
            $colorX = $colorX + 40;
            $colorY = $colorY + 40;
            $colorZ = $colorZ + 40;
            if ($countPercent != 0){
        ?>
                <div style="background-color: rgb(<?=$colorX?>, <?=$colorY?>, <?=$colorZ?>); width: <?=$countPercent?>%;"> <?=$row4["answer_answer"]?></div>
    <?php
            }
    }
    ?> 
     </td>

    <td><?=$countVote?></td>
    <td><?=$row["poll_lastdate"]?></td>
   
    <td><a href="PollVote.php?pid=<?=$row["pid"]?>">vote</a></td>	
</tr>
<?php    
}
        }
        $db->close();
?>
</table>
<hr>
<p>Polls people posted:</p>
<table>
<tr>
    <th style="width: 12%">date/time of creation</th>
    <th style="width: 6%">poster</th>
    <th style="width: 22%">poll topics</th>
    <th style="width: 18%">answers</th>
    <th style="width: 25%">Poll distribution</th>
    <th style="width: 6%">number of votes</th>
    <th style="width: 6%"> date/time of the most recent vote</th>
    <th style="width: 5%">go to vote</th>
</tr>

</table>
<table id="loadManage">
</table>
</footer>
<script type = "text/javascript"  src = "manage_ajax.js" ></script>
</body>

</html>