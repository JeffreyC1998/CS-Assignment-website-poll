<?php

$validate = true;
$error = "";
$uname = "";
$email = "";
$password = "";
$passwordr = "";
$uname_error ="";
$reg_Email = "/^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/";
$reg_Pswd = "/(?=.*\d)(?=.*[a-zA-Z0-9]).{8}/";
$reg_Uname = "/^[a-zA-Z0-9_-]+$/";

$target_dir = "images/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    
if (isset($_POST["SignUp"]) && $_POST["SignUp"])
{

    $email = trim($_POST["email"]);
    $uname = trim($_POST["uname"]);
    $password = trim($_POST["password"]);
    $passwordr = trim ($_POST["pwdr"]);
    $birthday = trim($_POST["bday"]);

    $db = new mysqli("localhost", "username", "password", "database");
    if ($db->connect_error)
    {
        die ("Connection failed: " . $db->connect_error);
    }

    if(isset($_POST["SignUp"])) 
    {
   	 $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
   	 if($check !== false) {
   	     //echo "File is an image - " . $check["mime"] . ".";
   	     $uploadOk = 1;
  	  } 
	else {
 	       echo "File is not an image.";
 	       $uploadOk = 0;
        }
    }
	// Check if file already exists

	// Check file size
	if ($_FILES["fileToUpload"]["size"] > 500000) {
  	  echo "Sorry, your file is too large.";
  	  $uploadOk = 0;
	}
	// Allow certain file formats
	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
	&& $imageFileType != "gif" ) {
	    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
 	   $uploadOk = 0;
	}
	// Check if $uploadOk is set to 0 by an error
	if ($uploadOk == 0) {
 	   //echo "Sorry, your file was not uploaded.";
	// if everything is ok, try to upload file
	} 
	else {
  	  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
 	       //echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
 	   } else {
 	       echo "Sorry, there was an error uploading your file.";
 	   }
	}
    $q1 = "SELECT * FROM Users WHERE user_uname = '$uname' OR user_email = '$email'";
    $r1 = $db->query($q1);


    // if the email address or username is already taken.
    if($r1->num_rows > 0)
    {
        $validate = false;
    }
    else
    {
        $emailMatch = preg_match($reg_Email, $email);
        if($email == null || $email == "" || $emailMatch == false)
        {

            $validate = false;
        }
        
        $passwordLen = strlen ($password);      
        $pswdMatch = preg_match($reg_Pswd, $password);
        if($password == null || $password == "" || $pswdMatch == false || $passwordLen != 8)
        {

            $validate = false;
        }

        $unameMatch = preg_match($reg_Uname, $uname);
        if($uname == null || $uname == "" || $unameMatch == false)
        {

            $validate = false;
        }

        if($password != $passwordr)
        {
            $validate = false;
        }
        
        if($birthday == null || $birthday == "")
        {
            $validate = false;
        }
    }

    if($validate == true && $check == true)
    {
        //add code here to insert a record into the table User;
        // table User attributes are: email, password, DOB
        // variables in the form are: email, password, dateFormat, 
        // start with 
	    $q2 = "INSERT INTO Users( user_uname, user_email, user_password, user_image, user_bday ) VALUES ('$uname', '$email', '$password', '$target_file', '$birthday')";
       
        $r2 = $db->query($q2);
        
        if ($r2 === true)
        {
            header("Location: MainPage.php");
            $db->close();
            exit();
        }
    }
    else
    {
        $error = "Signup failed.";
        echo "<script type='text/javascript'>alert('$error');</script>";
        $db->close();
    }

}

?>

<!DOCTYPE html>
<html>
<head>
<Title>Signup Page </Title>
<style> 

body {
  background-color: black;
}

.div1 {
    border: 1px solid rgb(85, 84, 84);
    width: 728px;
    height: 450px;
    position: absolute;
    left: 50%;
    top: 50%;
    transform: translate(-50%, -50%);
    padding: 30px;
    background-color:rgb(143, 203, 238);
}

.div2 {
    position: absolute;
    left: 80%;
    top: 10%;
}


b{
  position: absolute;
  margin-top: 10px;
  padding: 15px;
}

.image{
  position: absolute;
  width: 30px;
  height: 30px;
  left: 72%;
  top: 60%;
}

.err_msg{ color:red;}
</style>
<script type="text/javascript" src="V.js"> </script>  
</head>

<body>

<form id="SignUp" action="SignUp.php" method="POST" enctype = "multipart/form-data">

<div class="div1">
<h2> Create your account here </h2>
<img class="div2" src="logo.jpg" alt="logo" style="width:100px;height:100px;">


<table>
  <tr><td></td><td class="err_msg"><label id="email_msg" ></label><?php echo $uname_error ?></td></tr>
  <tr><td>Email: </td><td> <input type="text" name="email" size="30" /></td> </tr>
   
  <tr><td></td><td><label id="uname_msg" class="err_msg"></label></td></tr>          
  <tr><td>Username: </td><td> <input type="text" name="uname" size="30" /></td></tr>
  
  <tr><td></td><td><label id="pswd_msg" class="err_msg"></label></td></tr>
  <tr><td>Password: </td><td> <input type="password" name="password" size="30"/></td></tr>
  
  <tr><td></td><td><label id="pswdr_msg" class="err_msg"></label></td></tr>            
  <tr><td>Confirm Password: </td><td> <input type="password" name="pwdr" size="30" /></td></tr>    
  
  <tr><td></td><td><label id="birthday_msg" class="err_msg"></label></td></tr>            
  <tr><td>Birthday: </td><td> <input type="date" name="bday" size="30" /></td></tr>  

  <tr><td></td><td><label id="photo_msg" class="err_msg"></label></td></tr>            
  <tr><td>Avatar: </td><td> <input type="file" name="fileToUpload" id="fileToUpload" /></td></tr>  

</table>

<p><input value="SignUp" name="SignUp" type="submit"/> <input type="reset" name="Reset" value="Reset" /></p>

<a href="MainPage.php"> Go to Home Page</a>

</div>

</form>
<script type = "text/javascript"  src = "SignUp-r.js" ></script>
</body>
</html>