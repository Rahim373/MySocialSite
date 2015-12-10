<?php
session_start();

include_once 'include/allQueries.php';
if (!$_SESSION['login']) {
    header('Location:login.php');
} else {
    $completed = checkComplete();
    if ($completed == false) {
        header('Location:completeAccount.php');
    }
}

if (isset($_GET['q'])) {
    logout();
    header("location:login.php");
}

if (isset($_GET['RemoveId'])) {
    $frienId = $_GET['RemoveId'];
    $result = removeFriend($frienId);
    if($result){
        header('Location:Friends.php');
    }
    else{
        echo "Error";
    }
}

if (isset($_GET['AddId'])) {
    $frienId = $_GET['AddId'];
    $result = confirmFriend($frienId);
    if($result){
        header('Location:Friends.php');
    }
    else{
        echo "Error";
    }
}

if (isset($_GET['IgnoreId'])) {
    $frienId = $_GET['IgnoreId'];
    $result = ignoreFriend($frienId);
    if($result){
        header('Location:Friends.php');
    }
    else{
        echo "Error";
    }
}

if (isset($_GET['MessageToId'])) {
    $frienId = $_GET['MessageToId'];
    $loc = 'Location:Message.php?MessageToId='.$frienId;
    header($loc);
}
?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Friends</title>

        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="css/bootstrap-theme.min.css">
        <link rel="stylesheet" type="text/css" href="css/style-index.css">
        <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">

        <script type="text/javascript" src="js/bootstrap.js"></script>
        <script type="text/javascript" src="js/jquery-2.1.3.min.js"></script>


        <link href='http://fonts.googleapis.com/css?family=Lato:300' rel='stylesheet' type='text/css'>

    </head>
    <body>
        <header>
            <?php include 'include/menu.php'; ?>
        </header>


        <section>

            <div class="mainbox">
                <div class="row">
                    <div class="col-lg-6">
                        <?php
                        $result = getAllFriends();
                        ?>
                        <p class="well"><?php
                            $number = mysqli_num_rows($result);
                            if ($number > 0) {
                                echo $number . " friends";
                            }
                            ?></p> 
                        <?php
                        while ($profile = mysqli_fetch_assoc($result)) {
                            ?>
                        <div class="row" style="margin-bottom: 15px">
                                <div class="seeprofile">
                                    <div class="head">
                                        <div class="photo">
                                            <img src="<?php echo getProfilePhoto($profile['ID']); ?>" >
                                        </div>
                                        <div class="seeprofilecontent">
                                            <a href="Profile.php?id=<?php echo $profile['ID'];?>"><?php echo getUserName($profile['ID']) ?></a>
                                        </div>
                                        <div>
                                            <a href="SendMessege.php?MessageToId=<?php echo $profile['ID'];?>">Message</a> 
                                            <a href="?RemoveId=<?php echo $profile['ID']; ?>">Remove Friend</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>


                    <!-- Requests -->
                    <div class="col-lg-6">
                        <p class="well"><?php
                            $number = checkNumberOfFriendNotification();
                            if ($number > 0) {
                                echo $number . " New Request";
                            }
                            else {
                               echo "No New Request";  
                            }
                            ?></p> 
                        <?php
                        $result = checkNewFriendRequest();
                        while ($profile = mysqli_fetch_assoc($result)) {
                            ?>
                            <div class="row">
                                <div class="seeprofile">
                                    <div class="head">
                                        <div class="photo">
                                            <img src="<?php echo getProfilePhoto($profile['profile_id']); ?>">
                                        </div>
                                        <div class="seeprofilecontent">
                                            <a><?php echo getUserName($profile['profile_id']); ?></a>
                                        </div>
                                        <div>
                                            <a href="?AddId=<?php echo $profile['profile_id']; ?>">Resoponse</a>
                                            <a href="?IgnoreId=<?php echo $profile['profile_id'];?>">Ignore</a>
                                            
                                        </div>
                                    </div>
                                </div>

                            </div>
                        <?php } ?>
                        <!-- Post ends-->
                    </div>
                </div>
            </div>
        </section>


        <footer>

        </footer>

        <div>
            <script type="text/javascript" src="js/custom.js"></script>
    </body>
</html>