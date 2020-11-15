<?php
function setComments($conn){
    if(isset($_POST['commentSubmit'])){
        $userid = $_POST['userid'];
        $date = $_POST['date'];
        $nick = $_POST['nick'];
        $email = $_POST['email'];
        $message = $_POST['message'];

       $sql  = "INSERT INTO comments(userid,date,message,nick,email) 
                VALUES('$userid','$date','$message','$nick',' $email')";
       $result = $conn-> query($sql);
    }
}
function getComments($conn){
    $sql= "SELECT * FROM comments";
    $result = $conn-> query($sql);
    while($row = $result->fetch_assoc()){
        echo"<div class = 'comment-box'><p>";
            echo $row['nick']."<br>";
            echo $row['date']."<br>";
            echo ($row['message']);
        echo"</p></div>";
    }




}