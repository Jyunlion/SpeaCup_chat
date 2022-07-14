<?php
session_start();
include_once "config.php";
$fname = mysqli_real_escape_string($conn, $_POST['fname']);
$email = mysqli_real_escape_string($conn, $_POST['email']);
$account = mysqli_real_escape_string($conn, $_POST['account']);
$password = mysqli_real_escape_string($conn, $_POST['password']);
$gender = mysqli_real_escape_string($conn, $_POST['gender']);
$birth = mysqli_real_escape_string($conn, $_POST['birth']);

if (!empty($fname) && !empty($email) && !empty($account) && !empty($password) && !empty($gender) && !empty($birth)) {
  //email 檢查
  if (filter_var($email, FILTER_VALIDATE_EMAIL)) { //有效判斷
    //檢驗email account fname是否存在
    $sql_email = mysqli_query($conn, "SELECT * FROM users WHERE email = '{$email}'");
    $sql_account = mysqli_query($conn, "SELECT * FROM users WHERE account = '{$account}'");
    $sql_fname = mysqli_query($conn, "SELECT * FROM users WHERE nickname = '{$fname}'");
    if (
      mysqli_num_rows($sql_email) > 0
    ) {
      echo "$email - 此email已存在!";
    } else if (
      mysqli_num_rows($sql_account) > 0
    ) {
      echo "$account - 此帳號已存在!";
    } else if (
      mysqli_num_rows($sql_fname) > 0
    ) {
      echo "$fname - 此暱稱已存在!";
    } else {
      //檢驗上傳檔案
      if (isset($_FILES['image'])) {
        $img_name = $_FILES['image']['name']; //擷取上傳圖片名
        $img_type = $_FILES['image']['type']; //擷取上傳圖片類型
        $tmp_name = $_FILES['image']['tmp_name']; //用以存或移動檔案到我方資料夾中

        //抓檔案格式
        $img_explode = explode('.', $img_name);
        $img_ext = end($img_explode);

        $extensions = ["jpeg", "png", "jpg"];

        if (in_array($img_ext, $extensions) === true) {
          $types = ["image/jpeg", "image/jpg", "image/png"];
          if (in_array($img_type, $types) === true) {
            $time = time(); //透過此時間，及時修改users上傳檔案名
            $date = date('y-m-d H:i:s');
            $new_img_name = $time . $img_name;
            if (move_uploaded_file($tmp_name, "images/" . $new_img_name)) {
              $ran_id = rand(time(), 100000000); //創亂數ID
              $status = "上線中";  //上線狀態
              $encrypt_pass = md5($password);
              $insert_query = mysqli_query($conn, "INSERT INTO users (account, password, nickname, gender, email, birth, img, status, register, unique_id)
                                VALUES ('{$account}', '{$encrypt_pass}','{$fname}', '{$gender}', '{$email}', '{$birth}', '{$new_img_name}', '{$status}', '{$date}', {$ran_id})");
              if ($insert_query) {
                $select_sql2 = mysqli_query($conn, "SELECT * FROM users WHERE email = '{$email}'");
                if (mysqli_num_rows($select_sql2) > 0) {
                  $result = mysqli_fetch_assoc($select_sql2);
                  $_SESSION['unique_id'] = $result['unique_id']; //使用此 session 搭配其他php
                  echo "OK";
                } else {
                  echo "此email不存在";
                }
              } else {
                echo "怪怪的!請再重新嘗試一次!";
              }
            }
          } else {
            echo "圖片格式請上傳 - jpeg, png, jpg";
          }
        } else {
          echo "圖片格式請上傳 - jpeg, png, jpg";
        }
      }
    }
  } else {
    echo "$email - 無效的email格式!";
  }
} else {
  echo "請輸入全部資料!";
}