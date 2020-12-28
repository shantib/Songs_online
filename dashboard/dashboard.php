<?php

if(isset($_SESSION['id']))
{
  header("Location: ../index.php");
}
session_start();
require '../server.php';

$userid=$_SESSION['email'];

?>


<html>
<head>
<title>Dashboard</title>
<link href="style.css" rel=stylesheet type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Kaushan+Script&display=swap" rel="stylesheet">
<nav>
<div class="row">
<ul class="main-nav">

<li><a href="../friends.php">friendlist</a></li>
<li><a href="../fav_songs.php">&hearts;favorite songs </a></li>
    <li><a href="../login-form">log out</a></li>
</div>
</nav>
<meta name="viewport" content="width=device-width, initial-scale=1">
<script src='https://kit.fontawesome.com/a076d05399.js'></script>
<style>
 <!--
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 50%;
  margin-bottom:0px;
  margin-top: 10%;
  margin-right: -580px;

}

td, th {
  border: 1px solid #dddddd;
  text-align:left;
  padding: 5px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}

  .dropbtn {
  background-color: #3498DB;
  color: white;
  padding: 16px;
  font-size: 16px;
  border: none;
}

.dropup {
  position: relative;
  display: inline-block;
   float:right;
  margin-top:490px;
  margin-right:-880px;
}

.dropup-content {
  display: none;
  position: absolute;
  background-color: #f1f1f1;
  min-width: 160px;
  bottom: 50px;
  z-index: 1;
}

.dropup-content a {
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
}

.dropup-content a:hover {background-color: #ccc}

.dropup:hover .dropup-content {
  display: block;
}

.dropup:hover .dropbtn {
  background-color: #2980B9;
}
* {box-sizing: border-box;}

body {
  margin: 0;

}

.topnav {
  overflow:visible;
  background-color: #e9e9e9;
  background-image: linear-gradient(to right, #E55D87 0%, #5FC3E4 51%, #E55D87 100%)
}

.topnav a {
  float: left;
  display: block;
  color: black;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
  font-size: 17px;
}

.topnav a:hover {
  background-color: #ddd;
  color: black;
}

.topnav a.active {
  background-color: #2196F3;
  color: white;
}

.topnav .search-container {
margin-right:100px;
  float: right;
}

.topnav input[type=text] {
  padding: 6px;
  margin-top: 8px;
  font-size: 17px;
  border: none;
}

.topnav .search-container button {
  float: right;

  margin-top: 8px;

  background: #ddd;
  font-size: 17px;
  border-radius:0 5px 5px 0;
  cursor: pointer;
}

.topnav .search-container button:hover {
  background: #ccc;
}

@media screen and (max-width: 600px) {
  .topnav .search-container {
    float: none;
  }
  .topnav a, .topnav input[type=text], .topnav .search-container button {
    float: none;
    display: block;
    text-align: left;
    width: 100%;
    margin: 0;
    padding: 14px;
  }
  .topnav input[type=text] {
    border: 1px solid #ccc;
  }
}
.sidenav {
  height: 100%;
  width: 0;
  position: fixed;
  z-index: 1;
  top: 0;
  left: 0;
  background-color: #111;
  overflow-x: hidden;
  transition: 0.5s;
  padding-top: 60px;
}

.sidenav a {
  padding: 8px 8px 8px 32px;
  text-decoration: none;
  font-size: 25px;
  color: #818181;
  display: block;
  transition: 0.3s;
}

.sidenav a:hover {
  color: #f1f1f1;
}

.sidenav .closebtn {
  position: absolute;
  top: 0;
  right: 25px;
  font-size: 36px;
  margin-left: 50px;
}

@media screen and (max-height: 450px) {
  .sidenav {padding-top: 15px;}
  .sidenav a {font-size: 18px;}
}


</style>
</head>
<body>
</div>
<div id="mySidenav" class="sidenav">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
  <a href="#"><i style='font-size:24px' class='fas'>&#xf2bd;</i>userprofile</a>
  <a href="../fav_songs.php">my music</a>
  <a href="../friends.php">my friends</a>
  <a href="../music+.html">Buy Music+</a>
</div>



<div class="topnav">
<span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776; My profile</span>
  <div class="search-container">
    <form action="/action_page.php">
      <input type="text" placeholder="Search.." name="search">
      <button type="submit">search</button>
    </form>
  </div>
</div>

<div style="padding-left:16px">


</div>
<table align="right">
  <tr>
    <th>Title</th>
    <th>Album</th>
    <th>artist</th>
    <th>Year</th>
  </tr>

<?php

$query="SELECT * FROM Songs";
$stmt=mysqli_query($conn,$query);
while($result=mysqli_fetch_assoc($stmt))
{
?>

  <tr>
      <td><?php print_r ($result['Title']) ?> ></td>
      <td><?php echo $result['album']?> </td>
      <td><?php echo $result['Artist']?> </td>
      <td><?php echo $result['release_year']."<br>"?> </td>
  </tr>

<?php 
}
?>
</table>
<div class="dropup">
  <button class="dropbtn">My message</button>
  <div class="dropup-content">
    <a href="messages.php">Link 1</a>

  </div>
<script>
function openNav() {
  document.getElementById("mySidenav").style.width = "250px";
}

function closeNav() {
  document.getElementById("mySidenav").style.width = "0";
}
</script>


</body>
</html>
