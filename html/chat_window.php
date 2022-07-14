            <!-- 聊天視窗 -->
            <div class="chatbox">
                  <section class="chat-area">
                        <header>
                              <?php
                              $user_id = mysqli_real_escape_string($conn, $_GET['user_id']);
                              $sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$user_id}");
                              if ($user_id === "") {
                                    header("location: login.php");
                              }
                              if (mysqli_num_rows($sql) > 0) {
                                    $row = mysqli_fetch_assoc($sql);
                              } else {
                                    header("location: users_friend.php");
                              }
                              ?>
                              <a href="users_friend.php" class="back-icon"><i class="fa fa-arrow-left"></i></a>
                              <img src="php/images/<?php echo $row['img']; ?>" alt="">
                              <div class="details">
                                    <span><?php echo $row['nickname']; ?></span>
                                    <p><?php echo $row['status']; ?></p>
                              </div>
                        </header>
                        <div class="chat-box">

                        </div>
                        <form action="#" class="typing-area">
                              <input type="text" class="incoming_id" name="incoming_id" value="<?php echo $user_id; ?>"
                                    hidden>
                              <input type="text" name="message" class="input-field" placeholder="請輸入訊息..."
                                    autocomplete="off" />
                              <button><i class="fa fa-telegram"></i></button>
                        </form>
                  </section>
                  <div class="chatbox__button">
                        <button>Branch-1</button>
                  </div>
            </div>

            <script src="./Js/chat_box_show.js"></script>
            <script src="./Js/chat.js"></script>
            <script src="./Js/app.js"></script>