<?php
include "../connectDB/connectDB.php";
if (isset($_GET["insert"])) {
    $username = $_POST["username"];
    $password = md5($_POST["password"]);
    $fname = $_POST["fname"];
    $lname = $_POST["lname"];
    $gender = $_POST["gender"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $file = pathinfo(basename($_FILES['img_upload']['name']), PATHINFO_EXTENSION);
    if ($file != "") {
        $new_image_name = 'img' . uniqid() . "." . $file;
        $image_path = "../asset/userprofile/staff";
        $upload_path = $image_path . "/" . $new_image_name;

        $upload = move_uploaded_file($_FILES['img_upload']['tmp_name'], $upload_path);
        if ($upload == FALSE) {
            echo "ไม่สามารถ UPLOAD ภาพได้";
            exit();
        }
        $pro_image = $new_image_name;
        $pic = "../asset/userprofile/staff/" . $pro_image;
    } else {
        $pic = "../asset/userprofile/staff/img_001.jpg";
    }

    $sql =  "INSERT INTO customer(username,password,fname,lname,gender,email,phone,img) VALUES ('$username','$password','$fname','$lname',$gender,'$email','$phone','$pic')";
    $result = mysqli_query($conn, $sql);
    if ($result) {
?>
        <script>
            alert("Created Successful");
            window.location = "./customer.php";
        </script>

    <?php
    } else {
    ?>
        <script>
            alert("Create Fail!!!!")
            window.location = "./customer.php";
        </script>
    <?php
    }
}
// end insert module



if (isset($_GET["edit_customer"])) {
    $stf = $_GET["username"];
    $sql = "SELECT * FROM customer WHERE username = '$stf' ";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);

    ?>
    <button id="btn_<?php echo $row["username"] ?>" style="display: none;" type="button" class="btn btn-primary btn_format" data-toggle="modal" data-target="#<?php echo $row["username"] ?>">เพิ่มสินค้า</button>
    <div class="modal fade bd-example-modal-xl" id="<?php echo $row["username"] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Edit Customer</h5>
                    <button type="button" class="close btn btn-danger" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="./CustomerController.php?update&username=<?php echo $row['username'] ?>" method="post" enctype="multipart/form-data">
                        <p class="lable_format">ภาพลูกค้า</p>
                        <input type="file" name="img_upload" id="img_upload" class="form-control">
                        <br>
                        <br>
                        <p class="lable_format">Username :</p>
                        <input readonly onkeyup="checkProductID()" type="text" class="form-control" name="username" id="username" value="<?php echo $row['username'] ?>" placeholder="STF001" required>
                        <p id="check_id"></p>
                        <br>
                        <p class="lable_format">Passwod :</p>
                        <input type="password" class="form-control" name="password" id="password1">
                        <br>
                        <p class="lable_format">RePassword : </p>
                        <input type="password" class="form-control" name="password2" id="password2">
                        <br>
                        <p class="lable_format">ชื่อ :</p>
                        <input type="text" value="<?php echo $row["fname"] ?>" class="form-control" name="fname" id="fname" placeholder="สมชาย" required>
                        <br>
                        <p class="lable_format">สกุล :</p>
                        <input type="text" min="1" value="<?php echo $row["lname"] ?>" class="form-control" name="lname" id="lname" placeholder="สายเสมอ" required>
                        <br>
                        <p class="lable_format">เพศ :</p>
                        <select class="form-control" name="gender" id="gender" required>
                            <option class="form-control" value="" hidden>กรุณาเลือกเพศ</option>
                            <?php
                            if ($row["gender"] == 1) {
                                $m = "selected";
                                $f = "";
                            } else {
                                $m = "";
                                $f = "selected";
                            }
                            ?>
                            <option class="form-control" <?php echo $m ?> value="1">ชาย</option>
                            <option class="form-control" <?php echo $f ?> value="2">หญิง</option>
                        </select>
                        <br>
                        <p class="lable_format">Email :</p>
                        <input type="email" min="1" class="form-control" value="<?php echo $row["email"] ?>" name="email" id="email" placeholder="Test@bangnaenginerring.com" required>
                        <br>

                        <p class="lable_format">โทรศัพท์ :</p>
                        <input type="text" class="form-control" name="phone" value="<?php echo $row["phone"] ?>" id="phone" required>
                        <div class="modal-footer">
                            <button onclick="confrim_delete('<?php echo $row['username'] ?>','<?php echo $row['fname'] ?>')" type="button" class="btn btn-danger">ลบรายการสินค้า</button>
                            <button type="submit" class="btn btn-success">บันทึกข้อมูล</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php
}



if (isset($_GET["update"])) {
    $stf = $_GET["username"];
    $fname = $_POST["fname"];
    $lname = $_POST["lname"];
    $password = md5($_POST["password"]);
    $gender = $_POST["gender"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $pic = "";

    $file = pathinfo(basename($_FILES['img_upload']['name']), PATHINFO_EXTENSION);
    if ($file != "") {
        $new_image_name = 'img' . uniqid() . "." . $file;
        $image_path = "../asset/userprofile/customer";
        $upload_path = $image_path . "/" . $new_image_name;

        $upload = move_uploaded_file($_FILES['img_upload']['tmp_name'], $upload_path);
        if ($upload == FALSE) {
            echo "ไม่สามารถ UPLOAD ภาพได้";
            exit();
        }
        $pro_image = $new_image_name;
        $pic = "../asset/userprofile/customer/" . $pro_image;
    } else {
        $pic = "../asset/userprofile/customer/img_001.jpg";
    }

    if ($password != "") {
        $sql = "UPDATE customer set fname = '$fname' ,lname = '$lname' , password = '$password' , email = '$email' , phone = '$phone' , gender = $gender WHERE username = '$stf'";
        if ($pic != "../asset/userprofile/customer/img_001.jpg") {
            $sql = "UPDATE customer set fname = '$fname' ,lname = '$lname' , password = '$password' , email = '$email' , phone = '$phone' , gender = $gender ,img = '$pic' WHERE username = '$stf'";
        }
    } else {
        $sql = "UPDATE customer set fname = '$fname' ,lname = '$lname' , email = '$email' , phone = '$phone' , gender = $gender WHERE username = '$stf'";
        if ($pic != "../asset/userprofile/customer/img_001.jpg") {
            $sql = "UPDATE customer set fname = '$fname' ,lname = '$lname' , password = '$password' , email = '$email' , phone = '$phone' , gender = $gender ,img = '$pic' WHERE username = '$stf'";
        }
    }

    $result = mysqli_query($conn, $sql);
    if ($result) {
    ?>
        <script>
            alert("Update Success!");
            window.location = "./customer.php";
        </script>
    <?php
    } else {
    ?>
        <script>
            alert("Update Fail!");
            window.location = "./customer.php";
        </script>
<?php
    }
}

if(isset($_GET["delete"])){
    $username = $_GET["username"];
    $sql = "DELETE FROM customer WHERE username = '$username'";
    $result = mysqli_query($conn,$sql);
    if($result){
        echo "success";
    }
    else{
        echo "fail";
    }
}


?>