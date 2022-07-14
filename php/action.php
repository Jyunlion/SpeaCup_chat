<?php include_once "config.php";
session_start();




if ($_REQUEST['action'] === 'sendReq') {
    $reqSendingTo  = $_REQUEST['user_id'];
    $reqSendingFrom = $_SESSION['unique_id'];
    $dateAdded_now = date('y-m-d H:i:s');

    $sql = "INSERT INTO requests (sendingfrom, sendingto, dateAdded) VALUES ('$reqSendingFrom', '$reqSendingTo', '$dateAdded_now')";

    $sql_requestFrom_name = "SELECT nickname FROM users where unique_id = '$reqSendingFrom'";
    $sql_requestTo_name = "SELECT nickname FROM users where unique_id = '$reqSendingTo'";

    $result_From = mysqli_query($conn, $sql_requestFrom_name);
    $result_To = mysqli_query($conn, $sql_requestTo_name);

    $row_name_From = mysqli_fetch_assoc($result_From);
    $row_name_To = mysqli_fetch_assoc($result_To);

    $message =
        $row_name_From['nickname'] . ' 希望與你當朋友' .
        '</br>
        <button class="btn btn-primary btnAccept" data-type="1" data-reqSendingFrom="' . $reqSendingFrom . '">同意</button> 
        <button class="btn btn-success btnReject" data-type="2" data-reqSendingFrom="' . $reqSendingFrom . '">抱歉</button>';




    $sql_notification = "INSERT INTO notifications (noti_From, noti_To, message, is_Read, date_Added) VALUES ('$reqSendingFrom', '$reqSendingTo', '$message', '0', '$dateAdded_now')";


    if (mysqli_query($conn, $sql_notification) && mysqli_query($conn, $sql)) {
        $success  =  "Request send, saved into DB";
    } else {
        $success  =  "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    echo $success;
} else if ($_REQUEST['action'] === 'RequestSection') {

    $sentRequest = $_REQUEST['sentRequest'];
    $type = $_REQUEST['type'];

    if ($type == 1) {
        $sql_acceptReq = "UPDATE requests SET accepted='1' WHERE sendingfrom='$sentRequest'";
        $dateNow = date('y-m-d H:i:s');
        $MyId = $_SESSION['unique_id'];
        $sql_insert_friends = "INSERT INTO friends (user1, user2, date_Added) VALUES ('$sentRequest', '$MyId', '$dateNow')";


        if (mysqli_query($conn, $sql_acceptReq) and mysqli_query($conn, $sql_insert_friends)) {
            echo "success_accepted";
        } else {
            echo  mysqli_error($conn);
        }
    } else if ($type == 2) {
        $sql_rejectReq = "UPDATE requests SET accepted='2' WHERE sendingfrom='$sentRequest'";
        $sql_deleteReq = "DELETE FROM requests WHERE sendingfrom='$sentRequest'";
        $sql_deleteNoti = "DELETE FROM notifications WHERE noti_From='$sentRequest'";

        if (mysqli_query($conn, $sql_rejectReq)) {
            echo "success_Reject";
            mysqli_query($conn, $sql_deleteReq);
            mysqli_query($conn, $sql_deleteNoti);
        } else {
            echo  mysqli_error($conn);
        }
    }
} else if ($_REQUEST['action'] === 'cancelReq') {
    $cancelSendingTo  = $_REQUEST['user_id'];
    $cancelSendingFrom = $_SESSION['unique_id'];

    $sql_cancelFriend = "DELETE FROM friends WHERE (user1 = '$cancelSendingTo' AND user2 = '$cancelSendingFrom') OR (user2 = '$cancelSendingTo' AND user1 = '$cancelSendingFrom')";
    $sql_deleteReq = "DELETE FROM requests WHERE (sendingfrom = '$cancelSendingTo' AND sendingto = '$cancelSendingFrom') OR (sendingfrom = '$cancelSendingTo' AND sendingto = '$cancelSendingFrom')";
    $sql_deleteNoti = "DELETE FROM notifications WHERE (noti_From = '$cancelSendingTo' AND noti_To = '$cancelSendingFrom') OR (noti_From = '$cancelSendingTo' AND noti_To = '$cancelSendingFrom')";

    if (
        mysqli_query($conn, $sql_cancelFriend) &&   mysqli_query($conn, $sql_deleteReq) && mysqli_query($conn, $sql_deleteNoti)
    ) {
        echo "Request send, delete from DB";
    } else {
        echo  mysqli_error($conn);
    }
}