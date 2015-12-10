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

if (isset($_REQUEST["submit"])) {
    extract($_REQUEST);

    $change = changePassword($pass1, $old);
    if ($change) {
        header('Location:Setting.php');
    }
}

if (isset($_REQUEST['photoSubmit'])) {
  //  extract($_REQUEST);
    $uploaded = changePhoto($_FILES["fileToUpload"]);
    if($uploaded){
        header('Location:Setting.php');
    }   
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Setting</title>

        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="css/bootstrap-theme.min.css">
        <link rel="stylesheet" type="text/css" href="css/style-index.css">
        <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">

        <script type="text/javascript" src="js/bootstrap.js"></script>
        <script type="text/javascript" src="js/jquery-2.1.3.min.js"></script>

        <script lang="javascript" type="text/javascript">
            function checkPass() {
                var pass1 = document.forms["changep"]["pass1"].value;
                var pass2 = document.forms["changep"]["pass2"].value;
                if (!(pass1 === pass2)) {
                    document.getElementById("presult").innerHTML = "Passwor doesn't match";
                    return false;
                }
            }
        </script>

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
                        <img style="" class="img-thumbnail" src="<?php echo getProfilePhoto($_SESSION['ID']); ?>" />
                        <br>
                        <btn class="btn btn-default changePhoto">Change Photo</btn>
                        <div class="well changephotodiv">
                            <form method="post" enctype="multipart/form-data">
                                <input type="file" name="fileToUpload" id="fileToUpload"><br>
                                <input type="submit" value="Upload Image" name="photoSubmit">
                            </form>

                        </div>
                    </div>
                    <div class="col-lg-8">
                        <h2>
                            <?php echo getUserName($_SESSION['ID']); ?></h2>
                        <?php
                        $result = getAllDataofProfile($_SESSION['ID']);
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

                            <tr>
                                <th>Username</th>
                                <td><?php echo getprofileusername($_SESSION['ID']); ?></td>
                            </tr>
                            <tr>
                                <th>Password</th>
                                <td><a class="changepass">Change Password</a>
                                    <table class="table passtable">
                                        <form name="changep" onsubmit="return checkPass()">
                                            <tr>
                                                <th>New Password</th>
                                                <td><input type="password" name="pass1"></td>
                                            </tr>
                                            <tr>
                                                <th>Confirm password</th>
                                                <td><input type="password" name="pass2"></td>
                                            <div><p id="presult"></p></div>
                                            </tr>
                                            <tr>
                                                <th>Old Password</th>
                                                <td><input type="password" name="old"></td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td><button class="custom_btn" name="submit" type="submit" id="login"  onclick="checkPass()">Change Password</button></td>
                                            </tr>
                                        </form>

                                    </table>
                                </td>
                            </tr>
                        </table>
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