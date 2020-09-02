function managePageUpdate()
{
    var xhr = new XMLHttpRequest();
    document.getElementById("loadManage").innerHTML = "";
    var to_show = "";
    xhr.onreadystatechange = function()
    {
        if (this.readyState==4 && this.status==200)
        {
            var Obj = JSON.parse(xhr.responseText);
            /*to_show = xhr.responseText;*/
            
            for (var i = 0; i < Obj.length; i++)
            {              
                
                if(Obj[i].change == "Yes")
                {
                    document.getElementById("changeC").style.backgroundColor = "yellow";
                function setDefault()
                {
                    document.getElementById("changeC").style.backgroundColor = "rgb(143, 203, 238)";
                }
                setTimeout(setDefault,5000);                    
                }

                
                
                to_show += "<tr id='changeC'>";
                to_show += "<td style='width: 12%'>"; to_show += Obj[i].poll_createdate; to_show += "</td>";
                to_show += "<td style='width: 6%'>"; to_show += Obj[i].user_uname; to_show += "</td>";
                to_show += "<td style='width: 22%'><a href='PollResult.php?pid="; to_show += Obj[i].pid; to_show += "'>"; to_show += Obj[i].poll_question; to_show += "</a></td>";
                to_show += "<td style='width: 18%'>";
                for (var j = 0; j < Obj[i].answer.length; j++)
                {
                    to_show += Obj[i].answer[j]; 
                    to_show += " ";                   
                }
                to_show += "</td>";
                to_show += "<td class='resultMaP'>"; 
                
                for (var k = 0; k < Obj[i].answer.length; k++)
                {
                    to_show += "<div style='background-color: rgb(" + Obj[i].colorx[k] + "," + Obj[i].colory[k] + "," + Obj[i].colorz[k] + "); width: " + Obj[i].percent[k] + "%;'>"; 
                    if(Obj[i].percent[k] != 0)
                    {
                        to_show += Obj[i].answer[k];
                    }
                    to_show += "</div>";
                }
                

                to_show += "</td>";
                to_show += "<td style='width: 6%'>"; to_show += Obj[i].vote; to_show += "</td>";
                to_show += "<td style='width: 6%'>"; to_show += Obj[i].poll_lastdate; to_show += "</td>";
                to_show += "<td style='width: 5%'><a href='PollVote.php?pid="; to_show += Obj[i].pid; to_show += "'>"; to_show += "vote"; to_show += "</a></td>";
                to_show += "</tr>";
            }
            document.getElementById("loadManage").innerHTML = to_show;
        }    
    }

    xhr.open("GET","manage_ajax.php" ,true);
    xhr.send();
}
managePageUpdate();
setInterval(managePageUpdate, 600000);
