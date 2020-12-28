<?php
session_start();
require 'server.php';
if(!isset($_SESSION['user_id']))
{
header("Location: login.php");
}
$user_id = $_SESSION['user_id'];

?>
<!DOCTYPE html>
<html>
<head>
<title>Search</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
<div class="container">
<div class="jumbotron">

<form action="" method="get">
<input type="text" name="search_key">
<input type="submit" name="submit">
</form>
<?php

if (isset($_GET['search_key'])) {
$search_keyword = $_GET['search_key'] ?>
<h3>Users</h3>
<table class="table align-items-center table-flush">
<thead class="thead-light">
<tr>
<th scope="col">Name</th>
<th scope="col">Email</th>
<th scope="col">Date of Birth</th>
<th scope="col">Friend Request</th>
</tr>
</thead>
<tbody>
<?php
$sql = "SELECT * from users where name LIKE '%".$search_keyword."%';";
$result = $conn->query($sql);
if($result->num_rows > 0)
{
while($row = $result->fetch_assoc())
{
?>
<tr>
<th scope="row">
<?php echo $row['name']; ?>
</th>
<td>
<?php echo $row['email']; ?>
</td>
<td>
<?php echo $row['date_of_birth']; ?>
</td>
<td>
<a class="send_friend_req btn btn-sm btn-primary" href="friend_request_helper.php?user2=<?php echo $row['user_id'];?>&user1=<?php echo $user_id;?>">

Send</a>
</td>
</tr>
<?php }} ?>
</tbody>
</table> <br><br>
<h3>Songs</h3>

<table class="table align-items-center table-flush">
                <thead class="thead-light">
                  <tr>
                    <th scope="col">Song</th>
                    <th scope="col">Album</th>
                    <th scope="col">Like</th>
                  </tr>
                </thead>
                <tbody>
                <?php
                $sql = "SELECT * from song,album where title LIKE '%".$search_keyword."%' and song.album_id = album.album_id;";
    $result = $conn->query($sql);
    if($result->num_rows > 0)
    {
    while($row = $result->fetch_assoc())
    {
                ?>
                  <tr>
                    <th scope="row">
                      <?php echo $row['title']; ?>
                    </th>
                    <td>
                      <?php echo $row['album_name']; ?>
                    </td>
                    <td>
                    <a class="like_song btn btn-sm btn-primary" href="like_helper_search.php?songid=<?php echo $row['song_id']; ?>">
                     
                      Like</a>
                  <?php }} ?>
                    </td>
                  </tr>
                </tbody>
              </table>

<?php }  ?>

</div>
</div>
<footer><a href="index.php">back to home</a></footer>
</body>
</html>
