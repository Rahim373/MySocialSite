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

if (isset($_GET['MessageToId'])){
    $link = "SendMessege.php?MessageToId=".$_GET['MessageToId'];
    header($link);
}
?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Message</title>

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
                    <div class="col-lg-12">
                        <?php
                        $result = getAllMessegeFromFriends();
                        while ($profile = mysqli_fetch_assoc($result)) {
                            ?>
                            <div class="row">
                                <div class="seeprofile">
                                    <div class="head">
                                        <div class="photo">
                                            <img src="<?php echo getProfilePhoto($profile['ID']); ?>" >
                                        </div>
                                        <div class="seeprofilecontent">
                                            <a href="Profile.php?id=<?php echo $profile['ID'];?>"><?php echo getUserName($profile['ID']) ?></a>
                                          
                                        </div>
                                        <div>
                                            <a href="SendMessege.php?MessageToId=<?php echo $profile['ID'];?>">Check/New</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                       <?php  } ?>
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