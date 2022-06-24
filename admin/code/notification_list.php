<?php
include('../../connection/connection.php');
$noti = $db->query("SELECT * FROM notification WHERE receiver_type = 1 AND is_read = 0 ORDER BY id DESC LIMIT 0,5");
if($noti->rowCount() > 0){
    while($fenoti = $noti->fetch()){
        $user_id = $fenoti['sender_id'];
        $user = $db->query("SELECT * FROM user WHERE id = '$user_id'");
        $feuser = $user->fetch();
        ?>
<div class="dropdown-item">
    <div class="media">
        <?php
                if($fenoti['type'] == 'new_register'){
                    ?>
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
            class="feather feather-user">
            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
            <circle cx="12" cy="7" r="4"></circle>
        </svg>
        <?php
                }
                if($fenoti['type'] == 'new_order'){
                    ?>
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
            class="feather feather-truck">
            <rect x="1" y="3" width="15" height="13"></rect>
            <polygon points="16 8 20 8 23 11 23 16 16 16 16 8"></polygon>
            <circle cx="5.5" cy="18.5" r="2.5"></circle>
            <circle cx="18.5" cy="18.5" r="2.5"></circle>
        </svg>
        <?php
                }
                if($fenoti['type'] == 'order_cancelled'){
                    ?>
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
            class="feather feather-truck">
            <rect x="1" y="3" width="15" height="13"></rect>
            <polygon points="16 8 20 8 23 11 23 16 16 16 16 8"></polygon>
            <circle cx="5.5" cy="18.5" r="2.5"></circle>
            <circle cx="18.5" cy="18.5" r="2.5"></circle>
        </svg>
        <?php
                }
                if($fenoti['type'] == 'order_shipped'){
                    ?>
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
            class="feather feather-truck">
            <rect x="1" y="3" width="15" height="13"></rect>
            <polygon points="16 8 20 8 23 11 23 16 16 16 16 8"></polygon>
            <circle cx="5.5" cy="18.5" r="2.5"></circle>
            <circle cx="18.5" cy="18.5" r="2.5"></circle>
        </svg>
        <?php
                }
                if($fenoti['type'] == 'order_completed'){
                    ?>
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
            class="feather feather-truck">
            <rect x="1" y="3" width="15" height="13"></rect>
            <polygon points="16 8 20 8 23 11 23 16 16 16 16 8"></polygon>
            <circle cx="5.5" cy="18.5" r="2.5"></circle>
            <circle cx="18.5" cy="18.5" r="2.5"></circle>
        </svg>
        <?php
                }
                ?>

        <div class="media-body">
            <?php
                    if($fenoti['type'] == 'new_register' && $feuser['user_type'] == 1){
                        ?>
            <div class="notification-para"><span class="user-name"><?= $feuser['fullname'] ?></span><a
                    href="delivery_boy_details.php?id=<?= $fenoti['sender_id'] ?>"> <?= $fenoti['message'] ?></a></div>
            <?php
                    } elseif ($fenoti['type'] == 'new_register' && $feuser['user_type'] == 0) {
            ?>
            <div class="notification-para"><span class="user-name"><?= $feuser['fullname'] ?></span><a
                    href="user-details.php?id=<?= $fenoti['sender_id'] ?>"> <?= $fenoti['message'] ?></a></div>
            <?php
                    } else {
                        ?>
            <div class="notification-para"><a href="user-orders.php?id=<?= $fenoti['order_id'] ?>">
                    <?= $fenoti['message'] ?></a></div>
            <?php
                    }
                    ?>
        </div>
    </div>
</div>
<?php
    }
    ?>
<div class="text-right">
    <a href="notification.php" class="btn btn-success">View All</a>
</div>
<?php
} else {
?>
<div>No Notification Available</div>
<?php
}
?>