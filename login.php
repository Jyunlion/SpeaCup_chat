<?php
session_start();
if (isset($_SESSION['unique_id'])) {
      header("location: chat.php");
}
?>


<?php include_once "header.php"; ?>

<body>
      <div class="wrapper">
            <section class="form login">
                  <header>SpeaCup</header>
                  <form action="#">
                        <div class="error-txt"></div>
                        <div class="field input">
                              <label>帳號/信箱:</label>
                              <input type="text" name="email_account" placeholder="請輸入信箱或帳號" />
                        </div>
                        <div class="field input">
                              <label>密碼:</label>
                              <input type="password" name="password" placeholder="請輸入密碼" />
                              <i class="fa fa-eye"></i>
                        </div>
                        <div class="field button">
                              <input type="submit" value="登入" />
                        </div>
                  </form>
                  <div class="link">還沒註冊嗎?<a href="index.php"> 馬上註冊</a></div>
            </section>
      </div>
      <script src="./Js/pass-show-hide.js"></script>
      <script src="./Js/login.js"></script>
</body>

</html>