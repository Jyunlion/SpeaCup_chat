<?php include_once "header.php"; ?>
<?php include_once "./php/config.php";
session_start();
if (!isset($_SESSION['unique_id'])) {
      header("location: login.php");
} ?>



<div class="row">
      <div class="col-4">
            <h3 class='pb-3'>朋友清單</h3>
            <?php

            $s_id = $_SESSION['unique_id'];
            $sql_friendsList_get = "SELECT * FROM friends where user1 = '$s_id' or user2 = '$s_id'";

            $result_friensList_get = mysqli_query($conn, $sql_friendsList_get);

            while ($row_friensList_get = mysqli_fetch_assoc($result_friensList_get)) {
                  if ($s_id == $row_friensList_get['user2']) {
                        $myFriend = $row_friensList_get['user1'];

                        $sql_getuser = "SELECT * FROM users where unique_id = '$myFriend'";
                        $result_getName = mysqli_query($conn, $sql_getuser);
                        $row_getName = mysqli_fetch_assoc($result_getName);

                        $result_ProfilePic = mysqli_query($conn, $sql_getuser);
                        $row_ProfilePic = mysqli_fetch_assoc($result_ProfilePic);
                  } else {
                        $myFriend = $row_friensList_get['user2'];

                        $sql_getuser = "SELECT * FROM users where unique_id = '$myFriend'";
                        $result_getName = mysqli_query($conn, $sql_getuser);
                        $row_getName = mysqli_fetch_assoc($result_getName);

                        $result_ProfilePic = mysqli_query($conn, $sql_getuser);
                        $row_ProfilePic = mysqli_fetch_assoc($result_ProfilePic);
                  }
            ?>

            <div class="row">
                  <div class="col-4">
                        <img src="./php/images/<?php echo $row_ProfilePic['img'] ?>" alt="" height=50 width=50>
                  </div>
                  <div class="col-4">
                        <h6 class='text-uppercase'><?php echo $row_getName['nickname']; ?></h6>
                  </div>
            </div>

            <?php
            }



            ?>


      </div>
      <div class="col-8">
            <h3 class='pb-3'>通知</h3>
            <?php
            $now_id = $_SESSION['unique_id'];
            $sql_Noti = "SELECT * FROM notifications where noti_To = '$now_id'";

            $result_Noti = mysqli_query($conn, $sql_Noti);

            //受邀者才看到
            while ($row_noti = mysqli_fetch_assoc($result_Noti)) {
                  $noti_From = $row_noti['noti_From'];
                  $noti_To = $row_noti['noti_To'];
                  $sql_FriendsList = "SELECT * FROM friends where user1 = '$noti_From' and user2 = '$noti_To' or  user1 = '$noti_To' and user2 = '$noti_From'";

                  $result_FriendsList = mysqli_query($conn, $sql_FriendsList);

                  if (mysqli_num_rows($result_FriendsList) > 0) {
                  } else {
            ?>
            <div class="card">
                  <div class="card-body">

                        <div class="alert alert-success d-flex justify-content-between">
                              <strong><?php echo $row_noti['message']; ?></strong>
                        </div>
                  </div>
            </div>
            <?php
                  }
            }
            ?>

      </div>
</div>

<script>
$('.btnAccept').click(function() {
      type = $(this).attr('data-type');
      reqsendingfrom = $(this).attr('data-reqsendingfrom');
      button = $(this);
      $.post(`./php/action.php?action=RequestSection&sentRequest=${reqsendingfrom}&type=${type}`, function(
            res) {
            // alert(res);
            if (res == 'success_accepted') {
                  // console.log(button.parent());

                  button.parent().parent().text('你和 ' +
                        reqsendingfrom + '是朋友了!')
            }
      })
})

$('.btnReject').click(function() {
      type = $(this).attr('data-type');
      reqsendingfrom = $(this).attr('data-reqsendingfrom');
      button = $(this);
      $.post(`./php/action.php?action=RequestSection&sentRequest=${reqsendingfrom}&type=${type}`, function(
            res) {
            // alert(res);
            if (res == 'success_Reject') {
                  // console.log(button.parent());

                  button.parent().parent().text('你拒絕了 ' +
                        reqsendingfrom)
            }
      })
})
</script>