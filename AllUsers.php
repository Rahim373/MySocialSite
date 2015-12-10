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

if (isset($_GET['AddId'])) {
    $res = addFriend($_GET['AddId']);
    if($res){
        header('Location:AllUsers.php');
    }
}
?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>All Users</title>

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
                        <div class="well"><p>All Profiles</p></div>
                        
                        <?php $result = getAllProfiles();
                        while ($profile = mysqli_fetch_assoc($result)) {
                            ?>
                            <div class="box row">
                                <div class="seeprofile">
                                    <div class="head">
                                        <div class="photo">
                                            <img src="<?php echo getProfilePhoto($profile['Profile_Id']) ?>">
                                        </div>
                                        <div class="seeprofilecontent">
                                            <a href="Profile.php?id=<?php echo $profile['Profile_Id'];?>"><?php echo getUserName($profile['Profile_Id']) ?></a>
                                        </div>
                                        <div>
                                            <a href="?AddId=<?php echo $profile['Profile_Id']?>">Add</a>
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