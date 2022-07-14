<?php include_once "header.php"; ?>
<?php include_once "./php/config.php";
session_start();
if (!isset($_SESSION['unique_id'])) {
      header("location: login.php");
} ?>



<?php
$user_id =  $_REQUEST['user_id'];

$sql_user = "SELECT * FROM users where unique_id = '$user_id'";
$result_user = mysqli_query($conn, $sql_user);

$row_user = mysqli_fetch_assoc($result_user);

$picture = $row_user['img'];
$nickname =  $row_user['nickname'];
$gender =   $row_user['gender'];
$email =  $row_user['email'];
$birth = $row_user['birth'];

?>
<div class="row">
      <div class="col-4">
            <div class="row mt-5">
                  <div class="col-12 text-center pb-3">
                        <img src="./php/images/<?php echo $picture; ?>" alt="" height=200 width=200>
                  </div>

                  <div class="col-6">
                        暱稱:
                  </div>
                  <div class="col-6">
                        <?php echo $nickname; ?>
                  </div>
                  <div class="col-6">
                        性別:
                  </div>
                  <div class="col-6">
                        <?php echo $gender; ?>
                  </div>
                  <div class="col-6">
                        email:
                  </div>
                  <div class="col-6">
                        <?php echo $email; ?>
                  </div>
                  <div class="col-6">
                        生日:
                  </div>
                  <div class="col-6">
                        <?php echo $birth; ?>
                  </div>

                  <div class="col-12 pt-2">
                        <?php
                        $sendFrom = $_SESSION["unique_id"];
                        $sql_CheckReq = "SELECT * FROM requests where sendingfrom = '$sendFrom' and sendingto = '$user_id' ";
                        $sql_CheckFriend = "SELECT * FROM friends where (user1 = '$sendFrom' and user2 = '$user_id') or (user1 = '$user_id' and user2 = '$sendFrom')";

                        $result_CheckReq = mysqli_query($conn, $sql_CheckReq);
                        $result_CheckFriend = mysqli_query($conn, $sql_CheckFriend);


                        if (mysqli_num_rows($result_CheckReq) > 0 || mysqli_num_rows($result_CheckFriend) > 0) {
                              echo "已經申請過好友或已經是朋友囉!";
                        } else {
                              if ($sendFrom == $user_id) {
                              } else {

                        ?>

                        <button class='btn btn-primary' id='sendReq'
                              onclick='sendAction(1,"<?php echo $user_id ?>")'>加好友</button>

                        <?php
                              }
                        }
                        ?>



                  </div>
            </div>

      </div>
      <li class="nav-item">
            <a class="nav-link" href="notification.php">Notification</a>
      </li>
      <div class="col-8">

      </div>
</div>

<script>
function sendAction(constant, user_id) {
      // alert(unique_id);
      $.post(`./php/action.php?action=sendReq&user_id=${user_id}`, function(res) {
            // alert(res);
            if (res == 'Request send, saved into DB') {
                  $('#sendReq').hide()
                  $('#sendReq').parent().html('邀請成功，等待對方確認!')
            }
      })
}
</script>