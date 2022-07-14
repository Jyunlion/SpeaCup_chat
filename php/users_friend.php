<?php
session_start();
include_once "config.php";
$outgoing_id = $_SESSION['unique_id'];

// $sql = "SELECT * FROM users WHERE NOT unique_id = {$outgoing_id} ORDER BY uid DESC";
// $query = mysqli_query($conn, $sql);

$checkfriend = "SELECT * FROM users JOIN friends on users.unique_id = friends.user1 or users.unique_id = friends.user2 
WHERE (user1 = {$outgoing_id} or user2 = {$outgoing_id}) AND NOT unique_id = {$outgoing_id}";

$query_checkfriend = mysqli_query($conn, $checkfriend);


$output = "";
if (mysqli_num_rows($query_checkfriend) == 0) {
      $output .= "你還沒有加入好友唷!";
} elseif (mysqli_num_rows($query_checkfriend) > 0) {
      include_once "data_friend.php";
}
echo $output;

// 1441018161