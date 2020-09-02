function mainPageUpdate()
{
    var xhr = new XMLHttpRequest();
    document.getElementById("load").innerHTML = "";
    xhr.onreadystatechange = function()
    {
      if(this.readyState==4 && this.status==200)
      {
        var responseObj = JSON.parse(xhr.responseText);

        for(var i = 0; i < 5; i++)
        {
          document.getElementById("load").innerHTML += "<p><a href='PollVote.php?pid=" + responseObj[i].pid + "'>" + responseObj[i].poll_question + "</a></p>";
        }
  
      }

    }
    xhr.open("GET","main_ajax.php" ,true);
	xhr.send();
}
mainPageUpdate();
setInterval(mainPageUpdate, 90000);
