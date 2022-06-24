<?php
    if(empty($_SESSION['adminId']))
    {
      header("location:index.php");
    }
    $seladmin = $db->query("SELECT * FROM admin WHERE id='$_SESSION[adminId]'");
    $fetadmin = $seladmin->fetch();
    $adminName =  $fetadmin['name'];
    $adminUserNmae =  $fetadmin['username'];
    $adminEmail =  $fetadmin['email'];
    $adminAvatar =  $fetadmin['avatar'];   

?>
<div class="header-container fixed-top">
    <header class="header navbar navbar-expand-sm">
        <ul class="navbar-item theme-brand flex-row  text-center">
            <li class="nav-item theme-logo">
                <a href="dashboard.php">
                    <img src="assets/img/Logo_jpg.png" class="navbar-logo" alt="logo">
                </a>
            </li>
        </ul>
        <ul class="navbar-item flex-row ml-md-auto">
            <li class="nav-item dropdown notification-dropdown">
                <a href="javascript:void(0);" class="nav-link dropdown-toggle" id="notificationDropdown"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="feather feather-bell">
                        <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
                        <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
                    </svg>
                    <?php
                         $noti = $db->query("SELECT * FROM notification WHERE receiver_type = 1 AND is_read = 0");
                         if($noti->rowCount() > 0){
                            
                         }else{
                            ?> <span class="badge badge-success"></span> <?php
                         }
                    ?>

                </a>
                <div class="dropdown-menu position-absolute" aria-labelledby="notificationDropdown">
                    <div id="refreshheader" class="notification-scroll">
                    </div>
                </div>
            </li>
            <li class="nav-item admin-name-header"><?= $adminName ?></li>
            <li class="nav-item dropdown user-profile-dropdown">
                <a href="javascript:void(0);" class="nav-link dropdown-toggle user" id="userProfileDropdown"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                    <img src="assets/img/<?= $adminAvatar ?>" alt="avatar">
                </a>
                <div class="dropdown-menu position-absolute" aria-labelledby="userProfileDropdown">
                    <div class="">
                        <div class="dropdown-item">
                            <a class="" href="admin-profile.php"><svg xmlns="http://www.w3.org/2000/svg" width="24"
                                    height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" class="feather feather-user">
                                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="12" cy="7" r="4"></circle>
                                </svg> My Profile</a>
                        </div>
                        <div class="dropdown-item">
                            <a class="" href="code/logout.php"><svg xmlns="http://www.w3.org/2000/svg" width="24"
                                    height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" class="feather feather-log-out">
                                    <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                                    <polyline points="16 17 21 12 16 7"></polyline>
                                    <line x1="21" y1="12" x2="9" y2="12"></line>
                                </svg> Sign Out</a>
                        </div>
                    </div>
                </div>
            </li>
        </ul>
    </header>
</div>
<div class="sub-header-container">
    <header class="header navbar navbar-expand-sm">
        <a href="javascript:void(0);" class="sidebarCollapse" data-placement="bottom"><svg
                xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="feather feather-menu">
                <line x1="3" y1="12" x2="21" y2="12"></line>
                <line x1="3" y1="6" x2="21" y2="6"></line>
                <line x1="3" y1="18" x2="21" y2="18"></line>
            </svg></a>
    </header>
</div>
<script language="javascript" type="text/javascript">
var timeout = setInterval(reloadChat1, 1000);

function reloadChat1() {
    $('#refreshheader').load('code/notification_list.php');
}
</script>