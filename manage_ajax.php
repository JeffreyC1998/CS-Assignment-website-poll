<?php

	$db = mysqli_connect("localhost", "username", "password", "database");
	if (!$db) {
		exit ();
    }

    $today_date = date("Y-m-d");
    $q2 = "SELECT * FROM Polls ORDER BY poll_lastdate DESC, poll_createdate DESC";
    if ($result = mysqli_query ($db, $q2)) 
    {
        $o = 0;
        while ($row2 = $result->fetch_assoc()) 
        {
               
            if ($today_date >= $row2["poll_opendate"] && $today_date <= $row2["poll_expiredate"])
            {
                $order[$o] = $o;
                
                if ($order[$o] > $old[$o] && $old[$o] != "")
                {
                    $row2['change'] = "Yes";
                }
                else{ $row2['change'] = "No";}
                $old[$o] = $order[$o];

                //$row2['old'] = $old[$o];
                //$row2['new'] = $order[$o];


                $o++;

                $userID = $row2['uid'];
                $q3 = "SELECT user_uname FROM Users WHERE uid = '$userID'";
                $r3 = $db->query($q3); 
                $row3 = $r3->fetch_assoc();
                $row2['user_uname'] = $row3['user_uname'];

                $poll_id = $row2['pid'];
                $q4 = "SELECT * FROM Answers WHERE pid = '$poll_id'";
                $r4 = $db->query($q4);
                $countVote = 0;
                $i = 0;
                while ($row4 = $r4->fetch_assoc())
                {
                    
                    $answer_id = $row4['aid'];
                    $q5 = "SELECT * FROM Votes WHERE aid = '$answer_id'";
                    $r5 = $db->query($q5);
                
                    while ($row5 = $r5->fetch_assoc())
                    {
                        $countVote = $countVote + 1;
                    }

                    $row2['answer'][$i] = array($row4['answer_answer']);
                    $i++;
                } 
                $row2['vote'] = $countVote;                 
                $q6 = "SELECT * FROM Answers WHERE pid = '$poll_id'";
                $r6 = $db->query($q6);
                $colorX = 0;
                $colorY = 0;
                $colorZ = 0;
                $j = 0;
                while ($row6 = $r6->fetch_assoc())
                {
                    $countAnswer = 0; 
                    $answer_id = $row6['aid'];
                    $q7 = "SELECT * FROM Votes WHERE aid = '$answer_id'";
                    $r7 = $db->query($q7);
                    while ($row7 = $r7->fetch_assoc())
                    {
                        $countAnswer = $countAnswer + 1;                
                    }
                    $countPercent = $countAnswer / $countVote * 100;
                    $colorX = $colorX + 40;
                    $colorY = $colorY + 40;
                    $colorZ = $colorZ + 40;

                    $row2['vnum'][$j] = $countAnswer;
                    $row2['colorx'][$j] = $colorX;
                    $row2['colory'][$j] = $colorY;
                    $row2['colorz'][$j] = $colorZ;
                    $row2['percent'][$j] = $countPercent;
                    $j++;  
                }
            $json[] = $row2;                
            }

 
        }
        print json_encode($json);
        mysqli_free_result($result);
    } 
    mysqli_close($db);

?>