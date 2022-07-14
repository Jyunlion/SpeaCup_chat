<?php
session_start();
include_once "config.php";
$email_account = mysqli_real_escape_string($conn, $_POST['email_account']);
$password = mysqli_real_escape_string($conn, $_POST['password']);
if (!empty($email_account) && !empty($password)) {
      //資訊檢驗
      $sql_email = mysqli_query($conn, "SELECT * FROM users WHERE email = '{$email_account}'");
      $sql_account = mysqli_query($conn, "SELECT * FROM users WHERE account = '{$email_account}'");
      if (mysqli_num_rows($sql_email) > 0 || mysqli_num_rows($sql_account) > 0) {
            if (mysqli_num_rows($sql_email) > 0) {
                  $row = mysqli_fetch_assoc($sql_email);
            } else {
                  $row = mysqli_fetch_assoc($sql_account);
            }
            $user_pass = md5($password);
            $enc_pass = $row['password'];
            if ($user_pass === $enc_pass) {
                  $status = "上線中";
                  //若登入則更新狀態
                  $sql2 = mysqli_query($conn, "UPDATE users SET status = '{$status}' WHERE unique_id = {$row['unique_id']}");
                  if ($sql2) {
                        $_SESSION['unique_id'] = $row['unique_id'];
                        echo "OK";
                  } else {
                        echo "怪怪的!請再嘗試一次!";
                  }
            } else {
                  echo "帳號/信箱/密碼錯誤";
            }
      } else {
            echo "$$email_account - 此email或帳號不存在!";
      }
} else {
      echo "請輸入所有登入資訊!";
}