<?php include_once "header.php"; ?>
<?php include_once "./php/config.php";
session_start();
if (!isset($_SESSION['unique_id'])) {
      header("location: login.php");
} ?>


<body>
      <div class="row">
            <!-- 朋友清單 -->
            <?php include_once "html/friend_list.php" ?>
            <!-- 交友通知 -->
            <?php include_once "html/friend_noti.php" ?>

      </div>

</body>

</html>