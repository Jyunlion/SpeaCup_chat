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

            <script src="./Js/friend_confirm.js"></script>