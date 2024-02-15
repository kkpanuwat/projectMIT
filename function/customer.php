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
        function checkProductID() {
            let ElementCheckID = document.getElementById("check_id")
            let data = document.getElementById("pd_id").value;
            if (window.XMLHttpRequest) {
                xmlhttp = new XMLHttpRequest();

            } else {
                xmlhttp = new ActiveXOject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange = function() {
                if (xmlhttp.responseText != "") {
                    if (xmlhttp.responseText != "success") {
                        ElementCheckID.innerHTML = "รหัสสินค้านี้ถูกใช้งานแล้ว";
                        ElementCheckID.style.color = "red";
                        document.getElementById("pd_id").value = ""
                    } else {
                        ElementCheckID.innerHTML = " "
                    }
                }

            }
            xmlhttp.open("GET", "./checkProductID.php?pd_id=" + data, true);
            xmlhttp.send();
        }

        function create_edt_modal(args) {
            let div = document.getElementById("edt_modal");
            if (window.XMLHttpRequest) {
                xmlhttp = new XMLHttpRequest();

            } else {
                xmlhttp = new ActiveXOject("Microsoft.XMLHTTP");
            }

            let count = 0;
            xmlhttp.onreadystatechange = function() {

                if (xmlhttp.responseText != "" && count == 0) {
                    count++;
                    div.innerHTML = xmlhttp.responseText;
                    // CKEDITOR.replace("edt_pd_desp");
                    document.getElementById("btn_" + args).click();

                }

            }
            xmlhttp.open("GET", "./CustomerController.php?edit_customer&username=" + args, true);
            xmlhttp.send();
        }

        function confrim_delete(...args) {
            let conf = confirm("คุณต้องการลบข้อมูลลูกค้า\n" + args[1] + " ใช่หรือไม่")

            if (conf) {
                if (window.XMLHttpRequest) {
                    xmlhttp = new XMLHttpRequest();

                } else {
                    xmlhttp = new ActiveXOject("Microsoft.XMLHTTP");
                }

                let count = 0;
                xmlhttp.onreadystatechange = function() {
                    
                    if (xmlhttp.responseText == "success" && count==0) {
                        count++;
                        alert("Delete Success");
                        location.reload();
                    }

                }
                xmlhttp.open("GET", "./CustomerController.php?delete&username=" +args[0], true);
                xmlhttp.send();
            }
        }

        function loadData(){
            console.log(document.getElementById('search').value)
            let search = document.getElementById("search").value;
            if (window.XMLHttpRequest) {
                    xmlhttp = new XMLHttpRequest();

                } else {
                    xmlhttp = new ActiveXOject("Microsoft.XMLHTTP");
                }

                let count = 0;
                xmlhttp.onreadystatechange = function() {

                    if (xmlhttp.responseText != "" && count==0) {
                        console.log(xmlhttp.responseText);
                        count++;
                        document.getElementById("result_query").innerHTML = xmlhttp.responseText;               
                    }

                }
                xmlhttp.open("GET", "./searchController.php?customer&search="+search, true);
                xmlhttp.send();
        }
    </script>

</head>
</head>

<body>
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
                    <button type="button" class="btn btn-primary btn_format" data-toggle="modal" style="background-color: #3476ae; border:0px;box-shadow: #b9b8b8 5px 5px 10px;margin-left:25%" data-target="#exampleModalCenter">เพิ่มลูกค้า</button>
                </div>

                <div class="col-10">
                    <input onkeyup="loadData()" style="width: 50%;" type="text" name="search" id="search" class="form-control" placeholder="ค้นหาข้อมูลลูกค้า">
                </div>
            </div>

            <br>


            <div class="modal fade bd-example-modal-xl" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-xl" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Add Customer</h5>
                            <button type="button" class="close btn btn-danger" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="./CustomerController.php?insert" method="post" enctype="multipart/form-data">
                                <p class="lable_format">ภาพลูกค้า</p>
                                <input type="file" name="img_upload" id="img_upload" class="form-control">
                                <br>
                                <br>
                                <p class="lable_format">Username :</p>
                                <input onkeyup="checkProductID()" type="text" class="form-control" name="username" id="username" placeholder="STF001" required>
                                <p id="check_id"></p>
                                <br>
                                <p class="lable_format">Passwod :</p>
                                <input type="password" class="form-control" name="password" id="password1" required>
                                <br>
                                <p class="lable_format">RePassword : </p>
                                <input type="password" class="form-control" name="password2" id="password2" required>
                                <br>
                                <p class="lable_format">ชื่อ :</p>
                                <input type="text" class="form-control" name="fname" id="fname" placeholder="สมชาย" required>
                                <br>
                                <p class="lable_format">สกุล :</p>
                                <input type="text" min="1" class="form-control" name="lname" id="lname" placeholder="สายเสมอ" required>
                                <br>
                                <p class="lable_format">เพศ :</p>
                                <select class="form-control" name="gender" id="gender" required>
                                    <option class="form-control" value="" hidden>กรุณาเลือกเพศ</option>
                                    <option class="form-control" value="1">ชาย</option>
                                    <option class="form-control" value="2">หญิง</option>
                                </select>
                                <br>
                                <p class="lable_format">Email :</p>
                                <input type="email" min="1" class="form-control" name="email" id="email" placeholder="Test@bangnaenginerring.com" required>
                                <br>

                                <p class="lable_format">โทรศัพท์ :</p>
                                <input type="text" class="form-control" name="phone" id="phone" required>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิกการทำรายการ</button>
                                    <button type="submit" class="btn btn-success">บันทึกข้อมูล</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>




            <table class="table">
                <thead>
                    <th>No.</th>
                    <th>Picture</th>
                    <th>Name</th>
                    <th>Lastname</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Edit</th>
                </thead>
                <tbody id="result_query">
                    <?php
                    $num_row = 1;
                    $sql = "SELECT * FROM customer";
                    $result = mysqli_query($conn, $sql);
                    while ($row = mysqli_fetch_array($result)) {
                    ?>
                        <tr>
                            <td><?php echo $num_row ?></td>
                            <td><img src="<?php echo $row["img"] ?>" width="50" height="70" style="object-fit: cover;" alt=""></td>
                            <td><?php echo $row["fname"] ?></td>
                            <td><?php echo $row["lname"] ?></td>
                            <td><?php echo $row["email"] ?></td>
                            <td><?php echo $row["phone"] ?></td>
                            <td><button type="button" onclick="create_edt_modal('<?php echo $row['username'] ?>')" class="btn btn-warning">Edit</button></td>
                        </tr>
                    <?php
                        $num_row++;
                    }
                    ?>
                </tbody>
            </table>


            <div id="edt_modal">

            </div>

        </div><!-- row3 -->
    </div>
    </div>

    <!-- Button trigger modal -->



    <?php include("../cnd.php") ?>
</body>

</html>