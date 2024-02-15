<?php
include('../connectDB/connectDB.php');
if (isset($_GET["update"])) {
    $stf = $_GET["username"];
    $fname = $_POST["fname"];
    $lname = $_POST["lname"];
    $password = md5($_POST["password"]);
    $gender = $_POST["gender"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $pic="";

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

    if ($password != "") {
        $sql = "UPDATE staff set fname = '$fname' ,lname = '$lname' , password = '$password' , email = '$email' , phone = '$phone' , gender = $gender WHERE username = '$stf'";
        if ($pic != "../asset/userprofile/staff/img_001.jpg") {
            $sql = "UPDATE staff set fname = '$fname' ,lname = '$lname' , password = '$password' , email = '$email' , phone = '$phone' , gender = $gender ,img = '$pic' WHERE username = '$stf'";
        }
    } else {
        $sql = "UPDATE staff set fname = '$fname' ,lname = '$lname' , email = '$email' , phone = '$phone' , gender = $gender WHERE username = '$stf'";
        if ($pic != "../asset/userprofile/staff/img_001.jpg") {
            $sql = "UPDATE staff set fname = '$fname' ,lname = '$lname' , password = '$password' , email = '$email' , phone = '$phone' , gender = $gender ,img = '$pic' WHERE username = '$stf'";
        }
    }

    $result = mysqli_query($conn, $sql);
    if ($result) {
?>
        <script>
            alert("Update Success!");
            window.location = "./manageStaft.php";
        </script>
    <?php
    } else {
    ?>
        <script>
            alert("Update Fail!");
            window.location = "./manageStaft.php";
        </script>
    <?php
    }
}

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

    $sql =  "INSERT INTO staff(username,password,fname,lname,gender,email,phone,img) VALUES ('$username','$password','$fname','$lname',$gender,'$email','$phone','$pic')";
    $result = mysqli_query($conn, $sql);
    if ($result) {
    ?>
        <script>
            alert("Created Successful");
            window.location = "./manageStaft.php";
        </script>

    <?php
    } else {
    ?>
        <script>
            alert("Create Fail!!!!")
            window.location = "./manageStaft.php";
        </script>
<?php
    }
}
