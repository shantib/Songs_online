<?php
session_start();
require 'server.php';

$userid=$_SESSION['email'];

?>
<!DOCTYPE html>
<html>
<head>
<style>
table {
  border-collapse: collapse;
  width:100%;
}

th, td {
  padding: 8px;
  text-align: center;
  border-bottom: 1px solid #ddd;
}

tr:hover {background-color:#f5f5f5;}
a:link, a:visited {
  background-color:SlateBlue;
  color: white;
  padding: 14px 25px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
}

a:hover, a:active {
  background-color:blue;
}
</style>
</head>
<body>
<h3 align="center"> My Friends</h3>
<?php


$query="SELECT * FROM userinfo WHERE email in(select userid1 from friends where userid1 = '$userid' or userid2 = '$userid')";
$stmt=mysqli_query($conn,$query);
while($result=mysqli_fetch_assoc($stmt))
{

?>

<table align= "center">
	

	<tr>
		
		<td>

			<?php

			echo $result['fullname'];

			?>


		</td>
		<form action="message_per.php" method="post">
		<td><input type = "submit" class="input" name="message" value="Message"></a>
			<?php
				$_SESSION['friend']=$result['email'];
			?>
		</td>
		</form>
	</tr>

</table>


<?php
}


$query="SELECT g_name, g_id from fangroup where g_id in(select g_id_m from g_members where email_id = '$userid')";
$stmt=mysqli_query($conn,$query);
while($result=mysqli_fetch_assoc($stmt))
{

?>

<table align= "center">
	

	<tr>
		
		<td>

			<?php

			echo $result['g_name'];

			?>


		<form action="message_grp.php" method="post">
		<td><input type = "button" class="input" name="message" value="Message">
			<?php
				$_SESSION['g_id']=$result['g_id'];
			?>
		</td>
		</form>
		
	</tr>

</table>
	
<?php

}

?>




