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

if (isset($_REQUEST['sendMessage'])) {
    extract($_REQUEST);
    $to = $_GET['MessageToId'];
    $result = sendMessege($messege, $to);
    if($result){
        
    }
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
        <title>Message to <?php echo getUserName($_GET['MessageToId']); ?></title>

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
                        <h3> Chat with <?php echo getUserName($_GET['MessageToId']); ?> </h3><br>
                       <div class="row msgbox">
                           <?php
                            $destination = $_GET['MessageToId'];
                            $msg = streamMessegespecific($destination);
                            while ($singleMessege = mysqli_fetch_assoc($msg)){
                           
                           ?> 
                           
                           <div class="seepmessege">
                                <div class="photo">
                                    <a href="Profile.php?id=<?php echo $singleMessege['FromId'];?>"><?php echo getUserName($singleMessege['FromId']) ?></a>
                                    <?php echo " | ";
                                           echo date("h:i:s | d M, Y", strtotime($singleMessege['DateTime']));
                                    ?>
                                </div>
                                <br>
                                <div class="body">
                                    <p><?php echo $singleMessege['MessegeBody']; ?></p> 
                                </div>
                            </div>
                            <?php } ?>
                        </div>

                        <div>
                            <div class="post">
                                <p></p>
                                <form method="POST" target="_self" action="SendMessege.php?MessageToId=<?php echo $_GET['MessageToId'];?>">
                                    <div class="form-group has-feedback">
                                        <textarea style="height: 75px" name="messege" class="input postarea" placeholder="Write your message" type="text"></textarea>
                                    </div>
                                    <button class="custom_btn postbtn" type="submit" name="sendMessage">Post</button>
                                </form>
                            </div>
                        </div> 
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