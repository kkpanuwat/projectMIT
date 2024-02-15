<?php
    include "../connectDB/connectDB.php";
    session_start();
    $username = $_POST["username"];
    $password = md5($_POST["password"]);
    $sqlQueryCustomer = "SELECT * FROM customer WHERE username = '$username' AND password= '$password' ";
    $resultCustomer = mysqli_query($conn,$sqlQueryCustomer);
    $countCustomer = mysqli_num_rows($resultCustomer);
    $fetchCustomer = mysqli_fetch_array($resultCustomer);
    if($countCustomer>0){
        $_SESSION["type"]=1;
        $_SESSION["username"]=$fetchCustomer["username"];
        echo "user";
    }

    $sqlQueryStaff = "SELECT * FROM staff WHERE username = '$username' AND password= '$password' ";
    $resultStaff = mysqli_query($conn,$sqlQueryStaff);
    $countStaff = mysqli_num_rows($resultStaff);
    $fetchStaff = mysqli_fetch_array($resultStaff);
    if($countStaff>0){
        $_SESSION["type"]=2;
        $_SESSION["username"]=$fetchStaff["username"];
        echo "staff";
    }
    
    if($countCustomer ==0 && $countStaff==0){
        echo "error";
    }

    // echo "Username OR Password is incorrect!";



?>