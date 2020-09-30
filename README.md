# cs-assignment-website-poll

## url:
http://www2.cs.uregina.ca/~zheng32j/poll/MainPage.php <br/>

## Files Description
MainPage.php: This is the main page of the poll website. User can login, vote the five recent polls or go to sign up page here. The log in information will be searched in the database to see if thereis a match.<br/>
SignUp.php: This is a sign up page which user make their account here, it requires the user make username, image, email birthday and password. All these information will be saved in database.<br/>
PollManagement.php: This is a management page for all the polls after a user login or sign up. All the polls in the database is loaded in this page. Users can go to create a new poll, view the poll result or go to vote here.<br/>
PollCreation.php: This is a creation page for a poll. Users can make a poll here and decide its open and expire date, topic and up to five answers. The Topic, open and expire date and the answers are saved in the database. <br/>
PollResult.php: This is a poll result page which users can access by clicking any poll topic. Users can view the result and who post the poll here. The topic, answers and answers number is load from the database. Answers number distribution is presented as different colour. <br/>
PollVote.php: This is a vote page which users can make their votes for a topic here. The votes are saved in database.<br/>
Poll.css: The css file to determind the page style for MainPage.php, PollManagement.php, PollCreation.php, PollResult.php and PollVote.php.<br/>
V.js: This is a validation JavaScript file to validate log in form in MainPage.php, sign up form in SignUp.php and creation form in PollCreation.php.<br/>
Main-r.js: This is a JavaScript file for MainPage.php DOM2 Event Registration.<br/>
SignUp-r.js: This is a JavaScript file for SignUp.php DOM2 Event Registration.<br/>
Creation-r.js: This is a JavaScript file for PollCreation.php DOM2 Event Registration.<br/>
LogOut.php: This is a php file that when user click log out and call this file to end the session.<br/>
main_ajax.js: This is a Javascript file to process the response and complete the partial reload function every 90 seconds for main page.<br/>
main_ajax.php: This is a php file to generate the response and retrieve data from database for main page.<br/>
manage_ajax.js: This is a Javascript file to process the response and complete the partial reload function every 60 seconds. And the JavaScript funtion updateManage also check if there is new vote after update the polls, and highlight it for 5 seconds for poll manage page.<br/>
main_ajax.php: This is a php file to generate the response and retrieve data from database for poll manage page.<br/>
vote_ajax.js: This is a JavaScript file to process the response and complete the function that set the result distribution visible and the vote option hidden after user click any vote option.<br/>
vote_ajax.php: This is a php to generate the response and action that when user click vote in PollVote.php and PollVote.php call this file to save the answer and vote date in database.<br/>

For testing accout, please use <br/>
username: Admin <br/>
password: 1234567a<br/>
or sign up an account on your own.<br/>
