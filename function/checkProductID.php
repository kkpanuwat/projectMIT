<?php
    include("../connectDB/connectDB.php");
    $pd_id = $_GET["pd_id"];
    $sql = "SELECT * FROM product WHERE pd_id='$pd_id'";
    $result = mysqli_query($conn,$sql);
    if(mysqli_num_rows($result)>0){
        echo "error";
    }
    else{
        echo "success";
    }

?>