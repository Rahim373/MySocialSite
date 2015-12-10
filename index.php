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

if (isset($_REQUEST['postStatus'])) {
    extract($_REQUEST);
    postStatus($post, 0);
}

if (isset($_REQUEST['photoSubmit'])) {
  //  extract($_REQUEST);
    $uploaded = uploadPhoto($_FILES["fileToUpload"]);
    if($uploaded){
        header('Location:index.php');
    }   
}
?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Home</title>

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
                        <!-- Tab starts  -->
                        <div class="tabs">
                            <ul class="tab-links">
                                <li class="active"><a href="#tab1">Post Status</a></li>
                                <li><a href="#tab2">Post Photo</a></li>
                            </ul>
                            <div class="tab-content">
                                <div id="tab1" class="tab active">
                                    <div class="box row">
                                        <div class="post">
                                            <form>
                                                <div class="form-group has-feedback">
                                                    <textarea name="post" class="input parea postarea" placeholder="What is on your mind?" type="text"></textarea>
                                                </div>
                                                <button class="custom_btn postbtn" type="submit" name="postStatus">Post</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <div id="tab2" class="tab">
                                    <div class="box row">
                                        <div class="post">
                                            <form method="post" enctype="multipart/form-data">
                                                Select image to upload:
                                                <input type="file" name="fileToUpload" id="fileToUpload"><br>
                                                <input type="submit" value="Upload Image" name="photoSubmit">
                                            </form>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <!-- Tab ends  -->
                        <!-- posts -->
                        <?php
                        $result = getPost();
                        while ($status = mysqli_fetch_assoc($result)) {
                            ?>
                            <div class="row">
                                <div class="userpost">
                                    <div class="head">
                                        <div class="photo">
                                            <img src="<?php echo getProfilePhoto($status['Profile_Id']) ?>">
                                        </div>
                                        <div class="content">
                                             <a href="Profile.php?id=<?php echo $status['Profile_Id'];?>"><?php echo getUserName($status['Profile_Id']) ?></a>
                                            <p><?php echo date("h:i:s | d M, Y", strtotime($status['Date'])); ?></p>
                                        </div>
                                    </div>
                                    <div class="sbody">
                                    <?php 
                                        if($status['IsPhoto'] == 1){
                                    ?> 
                                        <img src="<?php echo $status['Status_Body']; ?>">
                                    <?php   
                                    }
                                    else {
                                    ?>    
                                        <p><?php echo $status['Status_Body']; ?></p>
                                    <?php
                                    }
                                    ?>
                                    
                                        
                                    </div>
                                    <!--       <div class="option">
                                               <a href="">Like</a> <a href="">Comment</a>
                                           </div> -->
                                </div>
                                <!--
                                <div class="feedback">
                                    <div class="liked">
                                        <p>You, <a href="">John</a> Like this.</p>
                                    </div>
                                    <div class="comment">
                                        <ul class="comments">
                                            <li>
                                                <div class="photo">
                                                    <img src="img/photo/p2.jpg">
                                                </div>
                                                <div class="content">
                                                    <a>Kim Martin</a>
                                                    <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour.</p>
                                                    <p>January 1, 2015</p>
                                                </div>
                                            </li>
                                        </ul>
                                        <div class="postcomment">
                                            <div class="photo">
                                                <img src="img/photo/p1.jpg">
                                            </div>
                                            <div class="content">
                                                <form>
                                                    <div class="form-group has-feedback">
                                                        <textarea name="comment" class="input parea postarea" placeholder="Type your comment" type="text"></textarea>
                                                    </div>
                                                    <button class="custom_btn postbtn" type="submit" name="postStatus">Comment</button>
                                            </form>
                                            </div>
                                        </div>
                                    </div>
                                </div> -->
                                <hr>
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