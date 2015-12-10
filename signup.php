<?php
    session_start();
    include_once 'include/allQueries.php';
    if (isset($_REQUEST["submit"])) {
    extract($_REQUEST);
    
    echo $dob;
    $register = register($uname, $uemail, $dob, $upass);
    if ($register) {
        header('Location:completeAccount.php');
    }
    else{
        echo "Error";
    }
}
?>



<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>My Social Site | Sign up</title>

        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="css/bootstrap-theme.min.css">
        <link rel="stylesheet" type="text/css" href="css/style-login.css">
        <link rel="stylesheet" type="text/css" href="css/tcal.css" />

        <script type="text/javascript" src="js/tcal.js"></script> 
        <script type="text/javascript" src="js/bootstrap.js"></script>
        <script type="text/javascript" src="js/jquery-2.1.3.min.js"></script>
        <link href='http://fonts.googleapis.com/css?family=Lato:300' rel='stylesheet' type='text/css'>

        <script lang="javascript" type="text/javascript">
            function checkPass() {
                var pass1 = document.forms["signupform"]["pass1"].value;
                var pass2 = document.forms["signupform"]["pass2"].value;
                if (!(pass1 === pass2)) {
                    document.getElementById("presult").innerHTML = "Passwor doesn't match";
                    return false;
                }
            }
        </script>
    </head>
    
    <body>
        <div class="main">
            <header>
                <div class="top-bar">
                    <div class="logo-icon">
                        <img src="img/logo.png">
                    </div>
                </div>
            </header>
            <section>
                <div class="container">
                    <div class="row">
                        <div class="col-lg-4 col-lg-offset-4">
                            <div class="login-form">
                                <h2>Sign up</h2>
                                <form name="signupform" method="POST" action="signup.php" onsubmit="return checkPass()">
                                    <div class="form-group has-feedback">
                                        <input required="" class="input" placeholder="User Name" name="uname" type="text">
                                    </div>
                                    <div class="form-group has-feedback">
                                        <input type="text" class="tcal input" name = "dob" placeholder="Date of Birth"/>
                                    </div>
                                    <div class="form-group has-feedback">
                                        <input required="" class="input" placeholder="Email" name="uemail" type="email">
                                    </div>
                                    <div class="form-group">
                                        <input required="" class="input" id="pass1" placeholder="Password" name="upass" type="password">
                                    </div>
                                    <div class="form-group">
                                        <input required="" class="input" id="pass2" placeholder="Repeat Password" name="password" type="password">
                                        <div><p id="presult"></p></div>
                                    </div>

                                    <button name="submit" class="custom_btn" type="submit" onclick="checkPass()">Sign Up</button>
                                </form>
                                <hr>
                                <a href="login.php">Already have a account?</a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <footer>
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="footer-list-1">
                                <ul>
                                    <li><a href="index.php">Terms & Conditions</a></li>
                                    <li><a href="">Privacy policy</a></li>
                                    <li><a href="">Disclaimer</a></li>
                                    <li><a href="">About</a></li>
                                    <li class="dev">Developers</li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="footer-right">
                                <p>All right reserved | Copyright @ Mymeetbook 2015</p>
                            </div>
                        </div>
                    </div>
                </div>
            </footer>

            <div id="check" class="developer">
                <div class="row">
                    <div class="cross">
                        <img onclick="hide()" src="img/cross.png">
                    </div>
                </div>
                <div class="row dicon">
                    <img src="img/developer.png">
                </div>
                <div class="row dname">
                    <h3>Md. Abdur Rahim</h3>
                    <h3>United International University</h3>
                    <h3>ID: 011 131 148</h3>
                </div>
            </div>
        </div>
        <script type="text/javascript" src="js/custom.js"></script>
    </body>

</html>