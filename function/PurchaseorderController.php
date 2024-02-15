<?php
include "../connectDB/connectDB.php";
if (isset($_GET["getData"])) {
    $type = $_GET["getData"];
    if ($type == "all") {
?>
        <table class="table">
            <thead>
                <th>ลำดับ</th>
                <th>หมายเลขคำสั่งซื้อ</th>
                <th>ชื่อ-สกุล</th>
                <th>วันที่ทำรายการ</th>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM purchaseorder JOIN customer ON purchaseorder.customer_id = customer.username ORDER BY purchaseorder.purchase_id DESC";
                $result = mysqli_query($conn, $sql);
                $num = 1;
                while ($row = mysqli_fetch_array($result)) {
                ?>
                    <tr onclick="getDetail(<?php echo $row['purchase_id'] ?>)">
                        <td><?php echo $num ?></td>
                        <td><?php echo $row["purchase_id"] ?></td>
                        <td><?php echo $row["fname"] . " " . $row["lname"] ?></td>
                        <td><?php echo $row["created_at"] ?></td>
                    </tr>
                <?php
                    $num++;
                }
                ?>
            </tbody>
        </table>
    <?php
    } else {
        // find data
    }
}


if (isset($_GET["getDetail"])) {
    $purchase = $_GET["purchase_id"];
    $sql = "SELECT * FROM customer JOIN purchaseorder ON purchaseorder.customer_id = customer.username JOIN orderdetail ON orderdetail.purchase_id = purchaseorder.purchase_id JOIN product ON orderdetail.product_id = product.pd_id WHERE purchaseorder.purchase_id = $purchase";
    $result = mysqli_query($conn, $sql);

    $getUser = "SELECT * FROM customer JOIN purchaseorder ON purchaseorder.customer_id = customer.username WHERE purchaseorder.purchase_id = $purchase ";
    $result2 = mysqli_query($conn, $getUser);
    $rowName = mysqli_fetch_array($result2);

    ?>
    <button id="btn_<?php echo $purchase ?>" style="display: none;" type="button" class="btn btn-primary btn_format" data-toggle="modal" data-target="#modal<?php echo $purchase ?>">เพิ่มสินค้า</button>
    <div class="modal fade bd-example-modal-xl" id="modal<?php echo $purchase ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">รายละเอียดคำสั่งซื้อ</h5>
                    <button type="button" class="close btn btn-danger" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <br>
                    <div class="row">
                        <div class="col-2 mt-2">
                            ชื่อ-สกุล :
                        </div>
                        <div class="col-10 mt-2">
                            <?php echo $rowName["fname"] . " " . $rowName["lname"] ?>
                        </div>
                        <div class="col-2 mt-2">
                            โทรศัพท์ :
                        </div>
                        <div class="col-10 mt-2">
                            <?php echo $rowName["phone"] ?>
                        </div>
                        <div class="col-2 mt-2">
                            Email :
                        </div>
                        <div class="col-10 mt-2">
                            <?php echo $rowName["email"] ?>
                        </div>
                    </div>
                    <br>
                    <br>
                    <table class="table">
                        <thead>
                            <th>ลำดับ</th>
                            <th>ชื่อสินค้า</th>
                            <th>จำนวน</th>
                            <th>ราคา</th>
                        </thead>

                        <tbody>
                            <?php
                            $num = 1;
                            while ($row = mysqli_fetch_array($result)) {
                            ?>
                                <tr>
                                    <td><?php echo $num ?></td>
                                    <td><?php echo $row["pd_name"] ?></td>
                                    <td><?php echo $row["qty"] ?></td>
                                    <td><?php echo $row["price"] ?></td>
                                </tr>
                            <?php
                                $num++;
                            }
                            ?>
                        </tbody>
                    </table>
                    <div style="float: right;">
                        <h4 style="font-family: 'Prompt', sans-serif !important;">ราคาสินค้ารวม : <?php echo $rowName["purchase_price"] ?></h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
}


if (isset($_GET["user"])) {
    $username = $_GET["user"];
    $sql = "SELECT * FROM purchaseorder JOIN customer ON purchaseorder.customer_id = customer.username WHERE customer.username = '$username' ORDER BY purchaseorder.purchase_id DESC";
    $result = mysqli_query($conn, $sql);

?>
    รายการสั่งซื้อ (พบรายการสั่งซื้อของคุณ <?php echo mysqli_num_rows($result)?> รายการ )
    <hr>
    <table class="table">
        <thead>
            <th>ลำดับ</th>
            <th>หมายเลขคำสั่งซื้อ</th>
            <th>ชื่อ-สกุล</th>
            <th>วันที่ทำรายการ</th>
        </thead>
        <tbody>
            <?php
            $num = 1;
            while ($row = mysqli_fetch_array($result)) {
            ?>
                <tr onclick="getDetail(<?php echo $row['purchase_id'] ?>)">
                    <td><?php echo $num ?></td>
                    <td><?php echo $row["purchase_id"] ?></td>
                    <td><?php echo $row["fname"] . " " . $row["lname"] ?></td>
                    <td><?php echo $row["created_at"] ?></td>
                </tr>
            <?php
                $num++;
            }
            ?>
        </tbody>
    </table>
<?php
}





?>