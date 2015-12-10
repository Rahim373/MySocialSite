<?php
function getUserName($conn){
    $id = $_SESSION['ID'];
    $query = "SELECT First_Name, Last_Name FROM profile where Profile_Id = $id";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    $first_name = $row['First_Name'];
    $last_name = $row['Last_Name'];
    $full_name = $first_name.' '.$last_name;
    return $full_name;
}

