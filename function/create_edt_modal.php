<?php
include "../connectDB/connectDB.php";
if (isset($_GET["edit_product"])) {
    $pd_id = $_GET["pd_id"];
    $sql = "SELECT * FROM product where pd_id = '$pd_id'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);
?>
    <button id="btn_<?php echo $row["pd_id"] ?>" style="display: none;" type="button" class="btn btn-primary btn_format" data-toggle="modal" data-target="#<?php echo $row["pd_id"] ?>">เพิ่มสินค้า</button>
    <div class="modal fade bd-example-modal-xl" id="<?php echo $row["pd_id"] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">แก้ไขรายการสินค้า (<?php echo $row["pd_name"] ?>) </h5>
                    <button type="button" class="close btn btn-danger" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="./editProduct.php" method="post" enctype="multipart/form-data">
                        <p class="lable_format">ภาพสินค้า</p>
                        <input type="file" name="edt_img_upload" id="edt_img_upload" class="form-control">
                        <input type="hidden" name="oldPic" value="<?php echo $row["pd_img"] ?>">
                        <br>
                        <p class="lable_format">ประเภทสินค้า</p>
                        <select name="edt_pd_type" id="edt_pd_type" class="form-control" required>
                            <option value="" disabled>กรุณาเลือกรายการสินค้า</option>
                            <?php
                            $sql2 = "SELECT * FROM type_product";
                            $result2 = mysqli_query($conn, $sql2);
                            while ($row2 = mysqli_fetch_array($result2)) {
                                if ($row["pd_type"] == $row2["type_product_id"]) {
                                    $checked = "selected";
                                } else {
                                    $checked = "";
                                }
                                echo '<option value="' . $row2["type_product_id"] . '"' . $checked . '>' . $row2["type_name"] . '</option>';
                            }
                            ?>
                        </select>
                        <br>
                        <p class="lable_format">รหัสสินค้า</p>
                        <input value="<?php echo $row["pd_id"] ?>" readonly type="text" class="form-control" name="edt_pd_id" id="edt_pd_id" placeholder="PD001" required>
                        <p id="check_id"></p>
                        <br>
                        <p class="lable_format">ชื่อสินค้า</p>
                        <input value="<?php echo $row["pd_name"] ?>" type="text" class="form-control" name="edt_pd_name" id="edt_pd_name" placeholder="ไก่ตัวโล" required>
                        <br>
                        <p class="lable_format">ราคาสินค้า</p>
                        <input value="<?php echo $row["pd_price"] ?>" type="number" min="1" class="form-control" name="edt_pd_price" id="edt_pd_price" placeholder="50" required>
                        <br>
                        <p class="lable_format">จำนวนคงเหลือ</p>
                        <input type="number" value="<?php echo $row["pd_qty"] ?>" min="1" class="form-control" name="edt_pd_qty" id="edt_pd_qty" placeholder="1" required>
                        <br>
                        <p class="lable_format">รายละเอียดสินค้า</p>
                        <textarea name="edt_pd_desp" id="edt_pd_desp" cols="20" rows="50"><?php echo $row["pd_desp"] ?></textarea>
                        <script>
                            CKEDITOR.replace("edt_pd_desp");
                        </script>
                        <div class="modal-footer">
                            <button onclick="confrim_delete('<?php echo $row['pd_id'] ?>','<?php echo $row['pd_name'] ?>')" type="button" class="btn btn-danger">ลบรายการสินค้า</button>
                            <button type="submit" class="btn btn-success">บันทึกรายการสินค้า</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php
}

if (isset($_GET["edit_staff"])) {
    $stf = $_GET["username"];
    $sql = "SELECT * FROM staff WHERE username = '$stf' ";
    $result = mysqli_query($conn,$sql);
    $row = mysqli_fetch_array($result);

?>
    <button id="btn_<?php echo $row["username"] ?>" style="display: none;" type="button" class="btn btn-primary btn_format" data-toggle="modal" data-target="#<?php echo $row["username"] ?>">เพิ่มสินค้า</button>
    <div class="modal fade bd-example-modal-xl" id="<?php echo $row["username"] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Edit Staff</h5>
                    <button type="button" class="close btn btn-danger" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="./staffController.php?update&username=<?php echo $row['username']?>" method="post" enctype="multipart/form-data">
                        <p class="lable_format">ภาพพนักงาน</p>
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
                                if($row["gender"] == 1){
                                    $m = "selected";
                                    $f = "";
                                }
                                else{
                                    $m = "";
                                    $f = "selected";
                                }
                            ?>
                            <option class="form-control" <?php echo $m?> value="1">ชาย</option>
                            <option class="form-control" <?php echo $f?> value="2">หญิง</option>
                        </select>
                        <br>
                        <p class="lable_format">Email :</p>
                        <input type="email" min="1" class="form-control" value="<?php echo $row["email"] ?>" name="email" id="email" placeholder="Test@bangnaenginerring.com" required>
                        <br>

                        <p class="lable_format">โทรศัพท์ :</p>
                        <input type="text" class="form-control" name="phone" value="<?php echo $row["phone"] ?>" id="phone" required>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิกการทำรายการ</button>
                            <button type="submit" class="btn btn-success">บันทึกข้อมูลพนักงาน</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php
}
?>