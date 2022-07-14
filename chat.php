<?php
session_start();
include_once "php/config.php";
if (!isset($_SESSION['unique_id'])) {
      header("location: login.php");
}
?>
<?php include_once "header.php"; ?>

<body>
      <!-- 聊天對象選擇介面 -->
      <?php include_once "html/users_select.php"; ?>
      <!-- 聊天視窗 -->
      <?php include_once "html/chat_window.php"; ?>
</body>

</html>