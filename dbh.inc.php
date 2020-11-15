<?php
$conn = mysqli_connect('localhost','root', '','moj_blog');

if(!$conn){

    die("Connection failed: ".mysqli_connect_error());
}