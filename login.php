<?php
include_once 'include/allQueries.php';
    
    session_start();
    if (isset($_REQUEST["submit"])) {
        extract($_REQUEST);
        $result = login($uname, $pass);
        if($result){
           header('Location:index.php');
        }
        else{
            header('Location:index.php');
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>My Social Site | Login</title>

        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="css/bootstrap-theme.min.css">
        <link rel="stylesheet" type="text/css" href="css/style-login.css">

        <script type="text/javascript" src="js/bootstrap.js"></script>
        <script type="text/javascript" src="js/jquery-2.1.3.min.js"></script>


        <link href='http://fonts.googleapis.com/css?family=Lato:300' rel='stylesheet' type='text/css'>

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
                                <h2>Log in</h2>
                                <form >
                                    <div class="form-group has-feedback">
                                        <input class="input" placeholder="username" type="text" name="uname">
                                    </div>
                                    <div class="form-group">
                                        <input class="input" placeholder="Password" type="password" name="pass">
                                    </div>
                                    <button class="custom_btn" name="submit" type="submit" id="login">Login</button>
                                </form>
                                <hr>
                                <a href="#">Forget username or password?</a>
                                <br>
                                <p>New to here? <a href="signup.php">Sign Up</a></p>
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
                                    <li><a href="home.html">Terms & Conditions</a></li>
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
                    <br>
                    <h3>Md. Mahfuzur Rahman</h3>
                    <h3>United International University</h3>
                    <h3>ID: 011 131 107</h3>
                </div>
            </div>

        </div>
        <script type="text/javascript" src="js/custom.js"></script>
    </body>
</html>