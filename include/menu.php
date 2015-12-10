<div class="leftmenu">
    <div class="logo">
        <img src="img/logo.png">
    </div>
    <div class="mainpp">
        <img style="" class="" src="<?php echo getProfilePhoto($_SESSION['ID']); ?>">
        <br>
        <a class="mainppname" href="Profile.php"><?php echo getUserName($_SESSION['ID']); ?></a>
    </div>	
    <div class="menu">
        <ul>
            <li class=""><a href="index.php"><div class="menuicon"><i class="fa fa-home"></i></div>Home</a></li>
            <li class=""><a href="Friends.php"><div class="menuicon"><i class="fa fa-group"></i></div>Friends</a> <span class="badge"><?php
                    $number = checkNumberOfFriendNotification();
                    if ($number > 0) {
                        echo "| " . $number . " New Request";
                    }
                    ?></span></li>
            <li class=""><a href="AllUsers.php"><div class="menuicon"><i class="fa fa-group"></i></div>All Profiles</a></li>
            <li class=""><a href="Message.php"><div class="menuicon"><i class="fa fa-envelope"></i></div>Message</a></li>
            <li class=""><a href="Setting.php"><div class="menuicon"><i class="fa fa-gear"></i></div>Setting</a></li>
            <li class=""><a href="index.php?q=logout"><div class="menuicon"><i class="fa fa-sign-out"></i></div>log out</a></li>
        </ul>
    </div>	
</div>