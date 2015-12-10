<?php
session_start();
include_once 'include/allQueries.php';

$id = $_SESSION['ID'];
if (isset($_REQUEST['submit'])) {
    extract($_REQUEST);
    $complete = doComplete($id, $firstname, $lastname, $sex, $road, $state, $city, $country, $school, $college, $religion, $about);
    if ($complete) {
        header('Location:index.php');
    }
}
?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>My Social Site</title>

        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="css/bootstrap-theme.min.css">
        <link rel="stylesheet" type="text/css" href="css/style-login.css">

        <script type="text/javascript" src="js/bootstrap.js"></script>
        <script type="text/javascript" src="js/jquery-2.1.3.min.js"></script>
        <link href='http://fonts.googleapis.com/css?family=Lato:300' rel='stylesheet' type='text/css'>


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
                                <h2>Sign up successful.</h2>
                                <h2>Complete your profile</h2>
                                <form name="completeform" method="POST" action="completeAccount.php">
                                    <div class="form-group has-feedback">
                                        <input required="" class="input" placeholder="First Name" name="firstname" type="text">
                                    </div>
                                    <div class="form-group has-feedback">
                                        <input required="" class="input" placeholder="Last Name" name="lastname" type="text">
                                    </div>
                                    <div class="form-group has-feedback">
                                        <select required="" name="sex" class="input">
                                            <option value="" selected="selected">Select Sex</option> 
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                        </select>
                                    </div>

                                    <div class="form-group form-inline has-feedback">
                                        <input class="input" placeholder="Road" name="road" type="text">
                                    </div>
                                    <div class="form-group form-inline has-feedback">
                                        <input class="input" placeholder="State" name="state" type="text">
                                    </div>
                                    <div class="form-group form-inline has-feedback">
                                        <input class="input" placeholder="City" name="city" type="text">
                                    </div>

                                    <div class="form-group has-feedback">
                                        <select required="" name="country" class="input">
                                            <option value="" selected="selected">Select Country</option> 
                                            <option value="United States">United States</option> 
                                            <option value="United Kingdom">United Kingdom</option> 
                                            <option value="Afghanistan">Afghanistan</option> 
                                            <option value="Albania">Albania</option> 
                                            <option value="Algeria">Algeria</option> 
                                            <option value="American Samoa">American Samoa</option> 
                                            <option value="Andorra">Andorra</option> 
                                            <option value="Angola">Angola</option> 
                                            <option value="Anguilla">Anguilla</option> 
                                            <option value="Antarctica">Antarctica</option> 
                                            <option value="Antigua and Barbuda">Antigua and Barbuda</option> 
                                            <option value="Argentina">Argentina</option> 
                                            <option value="Armenia">Armenia</option> 
                                            <option value="Aruba">Aruba</option> 
                                            <option value="Australia">Australia</option> 
                                            <option value="Austria">Austria</option> 
                                            <option value="Azerbaijan">Azerbaijan</option> 
                                            <option value="Bahamas">Bahamas</option> 
                                            <option value="Bahrain">Bahrain</option> 
                                            <option value="Bangladesh">Bangladesh</option> 
                                            <option value="Barbados">Barbados</option> 
                                            <option value="Belarus">Belarus</option> 
                                            <option value="Belgium">Belgium</option> 
                                            <option value="Belize">Belize</option> 
                                            <option value="Benin">Benin</option> 
                                            <option value="Bermuda">Bermuda</option> 
                                            <option value="Bhutan">Bhutan</option> 
                                            <option value="Bolivia">Bolivia</option> 
                                            <option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option> 
                                            <option value="Botswana">Botswana</option> 
                                            <option value="Bouvet Island">Bouvet Island</option> 
                                            <option value="Brazil">Brazil</option> 
                                            <option value="British Indian Ocean Territory">British Indian Ocean Territory</option> 
                                            <option value="Brunei Darussalam">Brunei Darussalam</option> 
                                            <option value="Bulgaria">Bulgaria</option> 
                                        </select>
                                    </div>

                                    <div class="form-group has-feedback">
                                        <input required="" class="input" placeholder="School" name="school" type="text">
                                    </div>
                                    <div class="form-group has-feedback">
                                        <input required="" class="input" placeholder="College" name="college" type="text">
                                    </div>
                                    <div class="form-group has-feedback">
                                        <input required="" class="input" placeholder="Religion" name="religion" type="text">
                                    </div>
                                    <div class="form-group has-feedback">
                                        <textarea required="" class="input" placeholder="About yourself" name="about" type="text"></textarea>
                                    </div>
                                    <button name="submit" class="custom_btn" type="submit">Complete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <script type="text/javascript" src="js/custom.js"></script>
    </body>

</html>