<?php 
$host ="localhost"; //atau bisa di isi dengan ip localhost 127.0.0.1
$user ="root"; //id user, karena kita menggunakan localhost, nama usernya di isi root
$pass =""; //pasword kita kosongi
$database ="db_meetjahit";
$con=mysqli_connect($host,$user,$pass,$database) or die ("gagal");
?>