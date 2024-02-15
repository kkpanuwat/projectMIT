<?php include("../connectDB/connectDB.php"); ?>
<!DOCTYPE html>
<html lang="th">

<head>
    <link rel="stylesheet" href="../index.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>index</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@300&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="../css/addproduct.css">
    <script src="../ckeditor/ckeditor.js"></script>
    <script>
        function loadData() {
            console.log(document.getElementById('search').value)
            let search = document.getElementById("search").value;
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
            xmlhttp.open("GET", "./searchController.php?product&search=" + search, true);
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

        function findData() {
            let type = document.getElementById("select_type").value;
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
            if (type == "all") {
                xmlhttp.open("GET", "./PurchaseorderController.php?getData=all", true);

            } else {
                xmlhttp.open("GET", "./PurchaseorderController.php?getData=cus", true);

            }
            xmlhttp.send();
        }
    </script>

</head>
</head>

<body onload="findData()">
    <div class="bar">
        <div class="welcome">
        <span>Patnaree | <img src="../img/logout.png" width="20" alt=""></span>
        </div>
    </div>


    <div class="fullscreen">

        <?php
        include "./menu.php";
        ?>

        <div class="center" style="width: 78%;">


            <!-- Modal AddProduct -->
            <div class="row">
                <div class="col-2">
                    <!-- <button type="button" class="btn btn-primary btn_format" data-toggle="modal" data-target="#exampleModalCenter">เพิ่มสินค้า</button> -->
                    <select onchange="findData()" name="type_search" id="select_type" class="form-control">
                        <option value="all" selected>คำสั่งซื้อทั้งหมด</option>
                        <option value="customer">ค้นหาจากข้อมูลลูกค้า</option>
                    </select>
                </div>

                <div class="col-10">
                    <input onkeyup="loadData()" style="width: 50%;" type="text" name="search" id="search" class="form-control" placeholder="ค้นหาข้อมูลสินค้า">
                </div>
            </div>

            <br>

            <div class="modal fade bd-example-modal-xl" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-xl" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">เพิ่มรายการสินค้า</h5>
                            <button type="button" class="close btn btn-danger" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="./backend_addproduct.php" method="post" enctype="multipart/form-data">
                                <p class="lable_format">ภาพสินค้า</p>
                                <input type="file" name="img_upload" id="img_upload" class="form-control">
                                <br>
                                <p class="lable_format">ประเภทสินค้า</p>
                                <select name="pd_type" id="pd_type" class="form-control" required>
                                    <option value="" disabled>กรุณาเลือกรายการสินค้า</option>
                                    <?php
                                    $sql = "SELECT * FROM type_product";
                                    $result = mysqli_query($conn, $sql);
                                    while ($row = mysqli_fetch_array($result)) {
                                        echo '<option value="' . $row["type_product_id"] . '">' . $row["type_name"] . '</option>';
                                    }
                                    ?>
                                </select>
                                <br>
                                <p class="lable_format">รหัสสินค้า</p>
                                <input onkeyup="checkProductID()" type="text" class="form-control" name="pd_id" id="pd_id" placeholder="PD001" required>
                                <p id="check_id"></p>
                                <br>
                                <p class="lable_format">ชื่อสินค้า</p>
                                <input type="text" class="form-control" name="pd_name" id="pd_name" placeholder="ไก่ตัวโล" required>
                                <br>
                                <p class="lable_format">ราคาสินค้า</p>
                                <input type="number" min="1" class="form-control" name="pd_price" id="pd_price" placeholder="50" required>
                                <br>
                                <p class="lable_format">จำนวนคงเหลือ</p>
                                <input type="number" min="1" class="form-control" name="pd_qty" id="pd_qty" placeholder="1" required>
                                <br>
                                <p class="lable_format">รายละเอียดสินค้า</p>
                                <textarea name="pd_desp" id="pd_desp" cols="20" rows="50"></textarea>
                                <script>
                                    CKEDITOR.replace("pd_desp");
                                </script>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิกการทำรายการ</button>
                                    <button type="submit" class="btn btn-success">บันทึกรายการสินค้า</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>


            <div id="result_query">
            </div>



            <div id="edt_modal">

            </div>

        </div><!-- row3 -->
    </div>
    </div>

    <!-- Button trigger modal -->



    <?php include("../cnd.php") ?>
</body>

</html>