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

if (isset($_GET['id'])) {
    $Id = $_GET['id'];
} else {
    $Id = $_SESSION['ID'];
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title><?php echo getUserName($Id); ?></title>

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
                    <div class="col-lg-4 profilemainphoto">
                        <img style="" class="img-thumbnail" src="<?php echo getProfilePhoto($Id); ?>" >
                    </div>
                    <div class="col-lg-8">
                        <h2>
                            <?php echo getUserName($Id); ?></h2>
                        <?php
                            $result = getAllDataofProfile($Id);
                            $row = mysqli_fetch_assoc($result)
                        ?>
                            <table class="table">
                                <tr>
                                    <th>Email</th>
                                    <td><?php echo $row['Email']; ?></td>
                                </tr>
                                <tr>
                                    <th>Birthday</th>
                                    <td><?php echo $row['DOB']; ?></td>
                                </tr>
                                <tr>
                                    <th>Sex</th>
                                    <td><?php echo $row['Sex']; ?></td>
                                </tr>
                                <tr>
                                    <th>Country</th>
                                    <td><?php echo $row['Country']; ?></td>
                                </tr>
                                <tr>
                                    <th>School</th>
                                    <td><?php echo $row['School']; ?></td>
                                </tr>
                                <tr>
                                    <th>College</th>
                                    <td><?php echo $row['College']; ?></td>
                                </tr>
                                <tr>
                                    <th>About</th>
                                    <td><?php echo $row['About']; ?></td>
                                </tr>
                            </table>
                    </div>
                </div>
                <br>
                <h3 class="text-center">Post by <?php  echo getUserName($Id);?></h3>
                <br>
                <!-- posts -->
                <?php
                $result = getPostofID($Id);
                while ($status = mysqli_fetch_assoc($result)) {
                    ?>
                    <div class="row">
                        <div class="userpost">
                            <div class="head">
                                <div class="photo">
                                    <img src="<?php echo getProfilePhoto($status['Profile_Id']) ?>">
                                </div>
                                <div class="content">
                                    <a><?php echo getUserName($status['Profile_Id']) ?></a>
                                    <p><?php echo date("h:i:s | d M, Y", strtotime($status['Date'])); ?></p>
                                </div>
                            </div>
                            <div class="sbody">
                                <?php
                                if ($status['IsPhoto'] == 1) {
                                    ?> 
                                    <img src="<?php echo $status['Status_Body']; ?>">
                                    <?php
                                } else {
                                    ?>    
                                    <p><?php echo $status['Status_Body']; ?></p>
                                    <?php
                                }
                                ?>
                            </div>
                        </div>
                        <hr>
                    </div>
                <?php } ?>
            </div>
        </section>
        <footer>

        </footer>

        <div>
            <script type="text/javascript" src="js/custom.js"></script>
    </body>
</html>