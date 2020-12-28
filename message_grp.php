<?php
session_start();
require 'server.php';

$userid=$_SESSION['email'];
$g_id = $_SESSION['g_id'];
echo $g_id;
echo"We are here";
$query="SELECT * FROM grp_messsages WHERE g_id = '$g_id'";
$stmt=mysqli_query($conn,$query);
while($result=mysqli_fetch_assoc($stmt))
{
	echo"We are in";
	echo $result['dtg']."  ".$result['sender_']."  ".$result['g_id']."  ".$result['sub']."  ".$result['body'];
}
?>