<?php
    include("../connectDB/connectDB.php");
    $pd_id = $_POST["pd_id"];
    $pd_type = $_POST["pd_type"];
    $pd_name = $_POST["pd_name"];
    $pd_qty = $_POST["pd_qty"];
    $pd_price = $_POST["pd_price"];
    $pd_desp = $_POST["pd_desp"];

    $file = pathinfo(basename($_FILES['img_upload']['name']), PATHINFO_EXTENSION);
    if ($file != "") {
        $new_image_name = 'img' . uniqid() . "." . $file;
        $image_path = "../asset/image";
        $upload_path = $image_path . "/" . $new_image_name;

        $upload = move_uploaded_file($_FILES['img_upload']['tmp_name'], $upload_path);
        if ($upload == FALSE) {
            echo "ไม่สามารถ UPLOAD ภาพได้";
            exit();
        }
        $pro_image = $new_image_name;
        $pic = "../asset/image/".$pro_image;
    } else {
        $pic = "../asset/image/defualtProduct.jpg";
    }

    $sql = "INSERT INTO product(pd_id,pd_type,pd_name,pd_price,pd_qty,pd_desp,pd_img) VALUES ('$pd_id','$pd_type','$pd_name','$pd_price','$pd_qty','$pd_desp','$pic')";
    $reult=mysqli_query($conn,$sql);
    if($reult){
        echo "<script>window.alert('Create Success')</script>";
        echo "<script>window.location='./addproduct.php.'</script>";
    }
    else{
        echo "<script>window.alert('Fail Please Try Agins')</script>";
    }

    
?>