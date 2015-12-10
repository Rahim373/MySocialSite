<?php

include 'dbConfig.php';

function dbConnect() {
    static $connection;
    if (!isset($connection)) {
        $connection = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE) or die("Can't connect");
    }
    if ($connection === false) {
        return mysqli_connect_error();
    }
    return $connection;
}

function login($username, $password) {
    $connection = dbConnect();
    $password = md5($password);
    $query = "SELECT * FROM user WHERE User_name='$username' AND Pass = '$password'";
    $result = mysqli_query($connection, $query);
    if (mysqli_num_rows($result) == 1) {
        $_SESSION['login'] = true;
        $user = mysqli_fetch_assoc($result);
        $_SESSION['ID'] = $user['Profile_id'];
        return true;
    } else {
        return false;
    }
}

function register($username, $email, $dob, $upass) {
    $connection = dbConnect();
    $password = md5($upass);
    $query = "SELECT * FROM user WHERE User_name='$username' OR Email='$email'";
    $result = mysqli_query($connection, $query);
    if (mysqli_num_rows($result) > 0) {
        echo mysqli_num_rows($result);
        return false;
    } else {
        $query1 = "INSERT INTO profile (Email, DOB) values ('$email', STR_TO_DATE('$dob', '%d-%m-%Y'))";
        $result1 = mysqli_query($connection, $query1);

        $query2 = "SELECT Profile_Id from profile where Email = '$email'";
        $res = mysqli_query($connection, $query2);
        $profile = mysqli_fetch_assoc($res);
        $profileID = $profile["Profile_Id"];

        $query3 = "INSERT INTO user(User_name, Email, Pass, Profile_Id) values ('$username', '$email', '$password', '$profileID')";
        $result = mysqli_query($connection, $query3);
        if ($result) {
            $_SESSION['login'] = true;
            $_SESSION['ID'] = $profileID;
        }
        return $result;
    }
}

function logout() {
    $_SESSION['login'] = FALSE;
    session_destroy();
}

function checkComplete() {
    $profileId = $_SESSION['ID'];
    $connection = dbConnect();
    $query = "SELECT * FROM PROFILE WHERE Profile_Id = '$profileId'";
    $result = mysqli_query($connection, $query);
    $row = mysqli_fetch_assoc($result);
    if ($row['First_Name'] == "") {
        return false;
    } else {
        return true;
    }
}

function doComplete($id, $firstname, $lastname, $sex, $address, $state, $city, $country, $school, $college, $religion, $about) {
    $connection = dbConnect();

    $query2 = "SELECT Location_Id from location where Address = '$address' and State = '$state' and City = '$city' and Country_Name = '$country'";
    $result2 = mysqli_query($connection, $query2);
    $location;
    if (mysqli_num_rows($result2) == 1) {
        $row = mysqli_fetch_assoc($result2);
        $location = $row['Location_Id'];
    } else {
        $query1 = "Insert into location (Address, State, City, Country_Name) values ('$address', '$state', '$city', '$country')";
        $result1 = mysqli_query($connection, $query1);

        $query4 = "SELECT Location_Id from location where Address = '$address' and State = '$state' and City = '$city' and Country_Name = '$country'";
        $result4 = mysqli_query($connection, $query4);
        $location = "";
        if (mysqli_num_rows($result4) == 1) {
            $row = mysqli_fetch_assoc($result4);
            $location = $row['Location_Id'];
        }
    }
    if($sex == 'Male'){
        $photo = "img/photo/male.png";
    }
    else {
       $photo = "img/photo/female.png" ;
    }

    $query3 = "UPDATE profile SET First_Name = '$firstname', Last_Name = '$lastname', Religion = '$religion', Location_Id = $location, Country = '$country', Sex = '$sex', About = '$about', School = '$school', College = '$college', Profile_photo = '$photo' WHERE Profile_Id = $id";
    echo $id;
    $result3 = mysqli_query($connection, $query3);
    if ($result3) {
        echo 'done';
        return true;
    } else {
        return false;
    }
}

function getUserName($id){
    $connection = dbConnect();
    $query = "SELECT First_Name, Last_Name FROM profile where Profile_Id = $id";
    $result = mysqli_query($connection, $query);
    $row = mysqli_fetch_assoc($result);
    $first_name = $row['First_Name'];
    $last_name = $row['Last_Name'];
    $full_name = $first_name.' '.$last_name;
    return $full_name;
}

function getProfilePhoto($id){
    $connection = dbConnect();
    $query = "SELECT Profile_photo from profile where Profile_Id = $id";
    $result = mysqli_query($connection, $query);
    $row = mysqli_fetch_assoc($result);
    $photo = $row['Profile_photo']."";
    return $photo;
}

function postStatus($post, $isphoto){
    $connection = dbConnect();
    $id = $_SESSION['ID'];
    $query = "Insert into Status (Status_Body, Profile_Id, Date, IsPhoto) VALUES ('$post', $id, Now(), $isphoto)";
    $result = mysqli_query($connection, $query);
    header('Location:index.php');
}

/*
SELECT * FROM status where Profile_Id = (select profile_id from friend where friend_PROFILE_ID = 20 and isadded = 1) 
Union SELECT * FROM status where Profile_Id = (select friend_PROFILE_ID from friend where profile_id = 20 and isadded = 1)
 * Union SELECT * FROM status where Profile_Id = $id Order by Date DESC  Order by Date DESC 

*/
function getPost(){
    $connection = dbConnect();
    
    $id = $_SESSION['ID'];
    $query = "select * "
            . "from status "
            . "where Profile_id in "
            . "(select profile_id as ID from friend where friend_PROFILE_ID = $id and isadded = 1 "
            . "union"
            . " select friend_PROFILE_ID as ID from friend where profile_id = $id and isadded = 1)"
            . " or Profile_id = $id Order by Date DESC ";
    $result = mysqli_query($connection, $query);
    if($result){
         return $result;
    }
 else {
     echo $_SESSION['ID'];
     echo   'Error';
    } 
}

function getAllProfiles(){
    $id = $_SESSION['ID'];
    $connection = dbConnect();
    $query = "SELECT * FROM profile where Profile_Id <> $id";
    $result = mysqli_query($connection, $query);
    return $result;
}

/*
 * SELECT * FROM status where Profile_Id = ((select profile_id from friend where friend_PROFILE_ID = 20 and isadded = 1) union (select friend_PROFILE_ID from friend where profile_id = 20 and isadded = 1))
 * 
 * 
 * 
 */
function checkNumberOfFriendNotification(){
    $id = $_SESSION['ID'];
    $connection = dbConnect();
    $query = "select profile_id from friend where friend_PROFILE_ID = $id and isadded = 0";
    $result = mysqli_query($connection, $query);
    if($result){
        return mysqli_num_rows($result);
    }
}

function checkNewFriendRequest(){
    $id = $_SESSION['ID'];
    $connection = dbConnect();
    $query = "select profile_id from friend where friend_PROFILE_ID = $id and isadded = 0";
    $result = mysqli_query($connection, $query);
    if($result){
        return $result;
    }
}

function getAllFriends(){
    $id = $_SESSION['ID'];
    $connection = dbConnect();
    $query = "select profile_id as ID from friend where friend_PROFILE_ID = $id and isadded = 1 "
            . "union "
            . "select friend_PROFILE_ID as ID from friend where profile_id = $id and isadded = 1 ";
    $result = mysqli_query($connection, $query);
    if($result){
        return $result;
    }
}

function addFriend($friendId){
    $id = $_SESSION['ID'];
    $connection = dbConnect();
    $query = "INSERT into Friend values ($id, $friendId, Now(), 0)";
    $result = mysqli_query($connection, $query);
    if($result){
        return true;
    }
    else{
        return false;
    }
}

function removeFriend($frienId){
    $id = $_SESSION['ID'];
    $connection = dbConnect();
    $query = "DELETE from friend where (friend_PROFILE_ID = $id AND Profile_Id = $frienId) OR (friend_PROFILE_ID = $frienId AND Profile_Id = $id)";
    $result = mysqli_query($connection, $query);
    if($result){
        return true;
    }
    else {
        return false;
    }
}

function confirmFriend($frienId){
    $id = $_SESSION['ID'];
    $connection = dbConnect();
    $query = "update friend set isadded = 1 where (friend_PROFILE_ID = $id AND Profile_Id = $frienId) OR (friend_PROFILE_ID = $frienId AND Profile_Id = $id)";
    $result = mysqli_query($connection, $query);
    if($result){
        return true;
    }
    else {
        return false;
    } 
}

function ignoreFriend($frienId){
    $id = $_SESSION['ID'];
    $connection = dbConnect();
    $query = "delete from friend where (friend_PROFILE_ID = $id AND Profile_Id = $frienId) OR (friend_PROFILE_ID = $frienId AND Profile_Id = $id)";
    $result = mysqli_query($connection, $query);
    if($result){
        return true;
    }
    else {
        return false;
    } 
}

function sendMessege($messege, $to){
    $from = $_SESSION['ID'];
    $connection = dbConnect();
    $query = "INSERT into messege (MessegeBody, FromId, ToId, DateTime) values ('$messege', $from, $to, Now())";
    $result = mysqli_query($connection, $query);
    if($result){
        return true;
    }
    else{
        echo mysqli_errno();
    } 
}

function getAllMessegeFromFriends(){
    $id = $_SESSION['ID'];
    $connection = dbConnect();
    $query = "select ToId as ID from messege where FromId = $id"
            . " union "
            . "select FromId as ID from messege where ToId = $id";
    $result = mysqli_query($connection, $query);
    if($result){
        return $result;
    }
}

function streamMessegespecific($to){
    $id = $_SESSION['ID'];
    $connection = dbConnect();
    $query = "select * from messege where FromId = $id and ToId = $to "
            . "union "
            . "select * from messege where ToId = $id and FromId = $to "
            . "order by MessegeId ASC";
    $result = mysqli_query($connection, $query);
    if($result){
        return $result;
    }
}


function uploadPhoto(){
    $target_dir = "img/photo/";
    $target_file = $target_dir . $_SESSION['ID'].date("Ymdhis"). basename($_FILES["fileToUpload"]["name"]);
    $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

    $uploadOk = 1;
    if ($_FILES["fileToUpload"]["size"] > 5000000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
    } else {
        move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $target_file);
        $post = $target_file;
        postStatus($post, 1);
        return true;
    }
}


function getAllDataofProfile($Id){
    $connection = dbConnect();
    $query = "select * from profile where Profile_Id = $Id";
    $result = mysqli_query($connection, $query);
    if($result){
        return $result;
    }
}


function getPostofID($id){
    $connection = dbConnect();
    $query = "select * "
            . "from status "
            . "where Profile_id = $id  Order by Date DESC ";
    $result = mysqli_query($connection, $query);
    if($result){
         return $result;
    } 
}

function getprofileusername($id){
    $connection = dbConnect();
    $query = "select User_name from user where Profile_id = $id";
    $result = mysqli_query($connection, $query);
    $row = mysqli_fetch_array($result);
    if($result){
         return $row['User_name'];
    } 
}

function changePassword($new, $old){
    $connection = dbConnect();
    $newpass = md5($new);
    $oldpass = md5($old);
    $id = $_SESSION['ID'];
    $query = "Update user set Pass = '$newpass' where Pass = '$oldpass' and Profile_Id = $id";
    $result = mysqli_query($connection, $query);
    if($result){
        return true;
    }
    else{
        return false;;
    }
}

function changePhoto(){
    $target_dir = "img/photo/";
    $target_file = $target_dir . $_SESSION['ID'].date("Ymdhis"). basename($_FILES["fileToUpload"]["name"]);
    $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

    $uploadOk = 1;
    if ($_FILES["fileToUpload"]["size"] > 5000000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
    } else {
        move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $target_file);
        $photo = $target_file;
        $connection = dbConnect();
        $id = $_SESSION['ID'];
        $query = "update profile set Profile_photo = '$photo' where Profile_id = $id";
        $result = mysqli_query($connection, $query);
        if($result){
             return true;
        } 
    }
}