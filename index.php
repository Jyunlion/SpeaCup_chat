<?php
session_start();
if (isset($_SESSION['unique_id'])) {
      header("location: users.php");
}
?>

<?php include_once "header.php"; ?>

<body>
      <div class="wrapper">
            <section class="form signup">
                  <header>SpeaCup</header>
                  <form action="#" enctype="multipart/form-data" autocomplete="off">
                        <div class="error-txt"></div>
                        <div class="name-details">
                              <div class="field input">
                                    <label>暱稱:</label>
                                    <input type="text" name="fname" placeholder="請輸入暱稱" required />
                              </div>
                        </div>
                        <div class="field input">
                              <label>信箱:</label>
                              <input type="text" name="email" placeholder="請輸入信箱" required />
                        </div>
                        <div class="field input">
                              <label>帳號:</label>
                              <input type="text" name="account" placeholder="請輸入帳號" required />
                        </div>
                        <div class="field input">
                              <label>密碼:</label>
                              <input type="password" name="password" placeholder="請輸入密碼" required />
                              <i class="fa fa-eye"></i>
                        </div>
                        <div class="gender"> <label>性別:</label>
                              <input type="radio" name="gender" value="男" checked="checked" required /><label>男</label>
                              <input type="radio" name="gender" value="女" required /><label>女</label>
                        </div>
                        <div class="field">
                              <label>生日:</label>
                              <input type="date" name="birth" required />
                        </div>
                        <div class="field image">
                              <label>頭像:</label>
                              <input type="file" name="image" required />
                        </div>
                        <div class="field button">
                              <input type="submit" value="註冊" />
                        </div>
                  </form>
                  <div class="link">已經註冊了嗎?<a href="login.php"> 馬上登入</a></div>
            </section>
      </div>

      <script src="./Js/pass-show-hide.js"></script>
      <script src="./Js/signup.js"></script>
</body>

</html>