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

                        <button class='btn btn-danger' id='cancelReq'
                              onclick='cancelAction(1,"<?php echo $row_ProfilePic['unique_id']; ?>")'>解除好友</button>

                  </div>


                  <?php
                  }



                  ?>
            </div>
            <script src="./Js/add_cancel_friend.js"></script>