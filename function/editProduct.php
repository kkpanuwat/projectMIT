<?php
    include "../connectDB/connectDB.php";
    $pd_id = $_POST["edt_pd_id"];
    $pd_name = $_POST["edt_pd_name"];
    $pd_price = $_POST["edt_pd_price"];
    $pd_qty = $_POST["edt_pd_qty"];
    $pd_type = $_POST["edt_pd_type"];
    $pd_desp = $_POST["edt_pd_desp"];
    $pd_old_pic = $_POST["oldPic"];

    $file = pathinfo(basename($_FILES['edt_img_upload']['name']), PATHINFO_EXTENSION);
    if ($file != "") {
        $new_image_name = 'img' . uniqid() . "." . $file;
        $image_path = "../asset/image";
        $upload_path = $image_path . "/" . $new_image_name;

        $upload = move_uploaded_file($_FILES['edt_img_upload']['tmp_name'], $upload_path);
        if ($upload == FALSE) {
            echo "ไม่สามารถ UPLOAD ภาพได้";
            exit();
        }
        $pro_image = $new_image_name;
        $pic = "../asset/image/".$pro_image;
    } else {
        $pic = $pd_old_pic;
    }

    
    $sql = "UPDATE product set pd_name = '$pd_name' , pd_price = '$pd_price' , pd_qty = '$pd_qty' , pd_type = '$pd_type' , pd_desp = '$pd_desp'  , pd_img = '$pic' WHERE pd_id = '$pd_id'";
    $result = mysqli_query($conn,$sql);
    if($result){
        echo "<script>
                window.alert('Update Success!!!!');
                window.location = './addproduct.php';
            </script>";
    }

?>

