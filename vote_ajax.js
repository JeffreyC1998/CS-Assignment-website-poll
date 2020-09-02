function getVote(x) 
{   

  
  var xhr = new XMLHttpRequest();
    
  xhr.onreadystatechange = function() 
  {
    if (this.readyState==4 && this.status==200) 
    {      
      document.getElementById("Vote").style.visibility = "hidden";
      document.getElementById("afterVote").style.visibility = "visible";
    }
  }
  xhr.open("GET","vote_ajax.php?vote="+x,true);
  xhr.send();

}
