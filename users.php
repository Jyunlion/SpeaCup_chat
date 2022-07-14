<?php
session_start();
include_once "php/config.php";
if (!isset($_SESSION['unique_id'])) {
      header("location: login.php");
}
?>
<?php include_once "header.php"; ?>

<body>
      <div class="wrapper">
            <div>
                  <a class="nav-link" href="timeline.php">資訊欄</a>
            </div>
            <section class="users">
                  <header>
                        <div class="content">
                              <?php
                              $sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$_SESSION['unique_id']}");
                              if (mysqli_num_rows($sql) > 0) {
                                    $row = mysqli_fetch_assoc($sql);
                              }
                              ?>
                              <img src="php/images/<?php echo $row['img']; ?>" alt="">
                              <div class="details">
                                    <span><?php echo $row['nickname']; ?></span>
                                    <p><?php echo $row['status']; ?></p>
                              </div>
                        </div>
                        <a href="php/logout.php?logout_id=<?php echo $row['unique_id']; ?>" class="logout">登出</a>
                  </header>
                  <div class="search">
                        <span class="text">選擇聊天對象</span>
                        <input type="text" placeholder="尋找對象..." />
                        <button><i class="fa fa-search"></i></button>
                  </div>
                  <div class="users-list">
                  </div>
            </section>
      </div>

      <script src="./Js/users_friend.js"></script>
</body>

</html>