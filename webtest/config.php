<?php
$server="localhost";
$user="dbuser02";
$pass="OVp2jqRzB[sIft05";
$dbname="dbassgiment2";

$conn=mysqli_connect($server,$user,$pass,$dbname);
if(!$conn){
    echo "<script>alert('Connection failed.')</script>";
}

?>