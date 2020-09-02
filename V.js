function SignUpForm(event){ 
    var elements = event.currentTarget;
    var a = elements[0].value;
    var b = elements[1].value;
    var c = elements[2].value;
    var d = elements[3].value;
	var e = elements[4].value;
	var f = elements[5].value;
	var ext = e.substring(e.lastIndexOf('.') + 1);

    var result = true;
    var email_v = /^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/; 
	
	var uname_v = /^[a-zA-Z0-9_-]+$/;

	
	var pswd_v = /(?=.*\d)(?=.*[a-zA-Z0-9]).{8}/;
	
	
  // initialize email_msg, uname_msg, password_msg and pswdr_msg

    document.getElementById("email_msg").innerHTML ="";
	
	document.getElementById("uname_msg").innerHTML ="";
	document.getElementById("pswd_msg").innerHTML ="";
	 
	document.getElementById("pswdr_msg").innerHTML ="";
	document.getElementById("birthday_msg").innerHTML ="";
	document.getElementById("photo_msg").innerHTML ="";	
	
  
   	// if email is left empty or email format is wrong, error message displays above email field in red color   
	if (a==null || a =="" || email_v.test(a) == false){
			
		document.getElementById("email_msg").innerHTML="Email address empty or wrong format. \n";
		result = false;
		}
		
	// add code here to validate username
	if (b==null || b=="" ||uname_v.test(b) == false){  
	    document.getElementById("uname_msg").innerHTML="Please enter the correct format for Username. (no spaces or other non-word characters)\n";
	    result = false;
    }
	
	
	//add code here to validate password
	
	if (c==null || c=="" || pswd_v.test(c) == false){
	    	document.getElementById("pswd_msg").innerHTML="Password should be 8 charcters long and at least one non-letter character \n";
	    result = false;
   }	


	// add code here to confirm password
	
	if (c!=d){
	     document.getElementById("pswdr_msg").innerHTML ="The confirmed password should be the same as the password above \n";
		result = false;
	}
	if (e==null || e==""){
		document.getElementById("birthday_msg").innerHTML="Please enter your birthday \n";
		result = false;
	}	
	 if (f==null || f==""){
		document.getElementById("photo_msg").innerHTML="Please select a image \n";
	result = false;
	}	
	
	if(result == false )
        {    
            event.preventDefault();
        }
																
}

function SignUpResetForm(event)
{
    document.getElementById("email_msg").innerHTML ="";
    document.getElementById("uname_msg").innerHTML ="";
    document.getElementById("pswd_msg").innerHTML ="";
	document.getElementById("pswdr_msg").innerHTML ="";
	document.getElementById("birthday_msg").innerHTML ="";
    document.getElementById("photo_msg").innerHTML ="";
}

function LoginForm(event){ 

    var elements = event.currentTarget;
  
    var a = elements[0].value;
    var b = elements[1].value;
 
    var result = true;    

	var uname_v = /^[a-zA-Z0-9_-]+$/;
    var pswd_v =  /^(?=.*\d)(?=.*\W)[a-zA-Z].{8,}$/;
   
   
    document.getElementById("uname_msg").innerHTML ="";
    document.getElementById("pswd_msg").innerHTML ="";

 
    if (a==null || a==""|| !email_v.test(a))
        {	   
	    document.getElementById("uname_msg").innerHTML="Please enter the correct username";
           result = false;
        }
	
    if (b==null || b=="" || !pswd_v.test(b))
    {
        document.getElementById("pswd_msg").innerHTML="Please enter the correct format for password";
        result = false;
    }

    if(result == false )
    {    
        event.preventDefault();
    }

	if (result == true)
	{
		alert("Login successfully!");
	}
}

function LoginResetForm(event)
{
    document.getElementById("uname_msg").innerHTML ="";
    document.getElementById("pswd_msg").innerHTML ="";
}

function CreationForm(event)
{

    var elements = event.currentTarget;
  
    var a = elements[0].value;
	var b = elements[2].value;
	var c = elements[3].value;
	var d = elements[4].value;
	var e = elements[6].value;
	var f = elements[8].value;
	var g = elements[10].value;
	var h = elements[12].value;



	document.getElementById("topic_msg").innerHTML ="";
	document.getElementById("open_msg").innerHTML ="";
	document.getElementById("close_msg").innerHTML ="";
	document.getElementById("ans_msg").innerHTML ="";
	
	var result = true;
	if (a==null || a=="") {
		document.getElementById("topic_msg").innerHTML="Question can not be blank \n";
		result = false;
	}
	else if (a.length > 100) {
		document.getElementById("topic_msg").innerHTML="Question must be shorter than 100 words \n";
		result = false;
	}

	if (b==null || b=="") {
		document.getElementById("open_msg").innerHTML="Open date is empty \n";
		result = false;
	}
	
	if (c==null || c=="") {
		document.getElementById("close_msg").innerHTML="Close date is empty \n";
		result = false;
	}

	if (d.length > 50 || e.length > 50 || f.length > 50 || g.length > 50 || h.length > 50 ){
		document.getElementById("ans_msg").innerHTML="Answer must be shorter than 50 words \n";
		result = false;		
	}
    if(result == false )
    {    
        event.preventDefault();
	}
	

}

function CreationResetForm(event)
{
	document.getElementById("topic_msg").innerHTML ="";
	document.getElementById("open_msg").innerHTML ="";
	document.getElementById("close_msg").innerHTML ="";
	document.getElementById("ans_msg").innerHTML ="";
}