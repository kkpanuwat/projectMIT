<?php
    include "../connectDB/connectDB.php";
    $pd_id = $_GET["pd_id"];
    $sql = "DELETE FROM product WHERE pd_id = '$pd_id'";
    $result = mysqli_query($conn,$sql);
    if($result){
        echo "success";
    }
    else{
        echo "fail";
    }
?>