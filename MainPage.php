<?php

$username = "";
$password = "";
$error = "";
if (isset($_POST["Login"]) && $_POST["Login"])
{
    $username = trim($_POST["uname"]);
    $password = trim($_POST["password"]);

    $db = new mysqli("localhost", "username", "password", "database");
    if ($db->connect_error) {
        die ("Connection failed: " . $db->connect_error);
    }

    $q2 = "SELECT uid, user_uname, user_image FROM Users WHERE user_uname = '$username' AND user_password = '$password';";
    $result2 = $db->query($q2);

    		  
    if ($row2 = $result2->fetch_assoc()) {
        // login successful
        session_start();
        $_SESSION["uid"] = $row2["uid"];
        $_SESSION["user_uname"] = $row2["user_uname"];
        $_SESSION["user_image"] = $row2["user_image"];
        header("Location: PollManagement.php");
        $db->close();
        exit();
    } 
    else 
    {
      // login unsuccessful
      $error = ("The username/password combination was incorrect.");
      $db->close();
    }
} 
else {
    $error = "";
}
?>

<!DOCTYPE html>
<html>
<head>
<title> Main Page </title>
<link rel="stylesheet" type="text/css" href="Poll.css">
<script type="text/javascript" src="V.js"> </script>
</head>

<body>

<header id="localstyle_para">
<img class="welcome_img" src="logo.jpg" alt="Welcome Image">
<h1> Welcome To We-Poll </h1>
<h3>Easily make your poll here</h3>
</header>

<section>
<h4 class="messbelog">Login in before you post a poll.</h4>

<form  action="MainPage.php" id="Login" method="post">
        <table id="maintable">
            <tr><td></td><td class="err_msg"><label id="uname_msg"></label><?=$error?></td></tr>
            <tr><td>Username: </td><td> <input type="text" name="uname" size="30" /></td> </tr>
            
            <tr><td></td><td><label id="pswd_msg" class="err_msg"></label></td></tr>
            <tr><td>Password: </td><td> <input type="password" name="password" size="30"/></td></tr>
        </table>
        <p><input type="submit" name="Login" value="Login" />
        <input type="reset" name="Reset" value="Reset" /></p>
<p>Don't have an account yet? click <a href="SignUp.php">here</a> to sign up.</p>        
</form>

</section>
<footer class="footbackground"></footer>

<footer class="footer2">
<p class="cen">Five most recent polls:</p>
<div class="mainpoststyle" id="load">

</div>
<p class="cen">login to see more</p>
</footer>
<script type = "text/javascript"  src = "Main-r.js" ></script>
<script type = "text/javascript"  src = "main_ajax.js" ></script>
</body>

</html>