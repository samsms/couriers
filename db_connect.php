<?php 
if($_SERVER['REMOTE_ADDR']!="127.0.0.1"){

$conn= new mysqli('localhost','techsava_courier','Trymenot#123$','techsava_courier')or die("Could not connect to mysql".mysqli_error($con));
}else{
    
$conn= new mysqli('localhost','root','Trymenot#123$','techsava_courier')or die("Could not connect to mysql".mysqli_error($con));
}