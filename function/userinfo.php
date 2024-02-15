<?php
include "../connectDB/connectDB.php";
session_start();
if (isset($_SESSION["type"]) and isset($_SESSION["username"])) {
    if ($_SESSION["type"] != 1) {
?>
        <script>
            alert("คุณไม่มีสิทธิ์ในการเข้าถึง");
            window.location = "../index.php";
        </script>
    <?php
    }
} else {
    ?>
    <script>
        alert("เข้าสู่ระบบก่อนทำรายการ");
        window.location = "../index.php";
    </script>
<?php
}

$username = $_SESSION["username"];
$sql = "SELECT * FROM customer WHERE username = '$username'";
$result = mysqli_query($conn, $sql);
$fetchUser = mysqli_fetch_array($result);


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome : <?php echo $fetchUser["fname"] . " " . $fetchUser["lname"] ?> </title>
    <link rel="stylesheet" href="../index.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@300&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

    <script>
        function findData() {
            if (window.XMLHttpRequest) {
                xmlhttp = new XMLHttpRequest();

            } else {
                xmlhttp = new ActiveXOject("Microsoft.XMLHTTP");
            }

            let count = 0;
            xmlhttp.onreadystatechange = function() {

                if (xmlhttp.responseText != "" && count == 0) {
                    console.log(xmlhttp.responseText);
                    count++;
                    document.getElementById("result_query").innerHTML = xmlhttp.responseText;
                }

            }
            xmlhttp.open("GET", "./PurchaseorderController.php?user=<?php echo $username ?>", true);
            xmlhttp.send();
        }

        function getDetail(args){
            if (window.XMLHttpRequest) {
                xmlhttp = new XMLHttpRequest();

            } else {
                xmlhttp = new ActiveXOject("Microsoft.XMLHTTP");
            }

            let count = 0;
            xmlhttp.onreadystatechange = function() {

                if (xmlhttp.responseText != "" && count == 0) {
                    console.log(xmlhttp.responseText);
                    count++;
                    document.getElementById("result_query").innerHTML = xmlhttp.responseText;
                    document.getElementById("btn_"+args).click();
                    findData()
                }

            }
            xmlhttp.open("GET", "./PurchaseorderController.php?getDetail&purchase_id=" + args, true);
            xmlhttp.send();
        }
    </script>
</head>

<body style="background-color: #eee;" onload="findData()">
    <div class="container" style="margin-top: 2em; ">
        <div style="float: right;" onclick="window.location='./logout.php'">ออกจากระบบ</div>
    </div>

    <br>

    <img src="<?php echo $fetchUser['img'] ?>" style="object-fit: cover; border-radius: 100px;display: block;margin-top: 5em; margin-bottom:2em;margin-left:auto;margin-right:auto;" width="200px" height="200px" alt="">
    <div class="container" style="background-color: white;padding-bottom: 30vh;margin-top: -7em;border-radius: 10px;">
        <div class="name" style="padding-top:20vh;text-align: center;font-size: 2em;">
            <span><?php echo $fetchUser["fname"] . " " . $fetchUser["lname"] ?></span>
            <br>
            <br>
            <center><div style="color:white;padding:10px;background-color:#dc577e;width:10em;border-radius:10px;box-shadow:lightgray 10px 10px 10px;"><span style="font-size: 3em;"><?php echo $fetchUser["point"]?></span><span style="margin-left: 20px;">Point</span></div></center>
        </div>
        <div class="purchase">
            <!-- <div class="toppiv" style="margin-top: 2em; margin-left: 3em;">รายการสั่งซื้อ</div> -->
            <div class="container" style="width: 80%;margin-top: 5em;">


                <div id="result_query">
                    รายการสั่งซื้อ
                    <hr>
                </div>



                <div id="edt_modal">
                </div>


            </div>
        </div>
    </div>
    </div>
</body>
<?php include("../cnd.php") ?>

</html>