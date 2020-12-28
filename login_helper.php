
<?php
session_start();
require 'server.php';

if(isset($_POST['submit']))
{
	$email = $_POST['email'];
	$password = $_POST['password'];

	$sql = "SELECT * from userinfo where email ='$email' and passwrd = '$password'";
	$result = $conn->query($sql);

	if($result->num_rows>0)
	{
		$row = $result->fetch_assoc();
		$_SESSION['email'] = $row['email'];
		$_SESSION['name'] = $row['fullname'];
		//echo"e3";
		header("Location: dashboard/dashboard.php");
	}
	else header("Location: login.php");
}
?>