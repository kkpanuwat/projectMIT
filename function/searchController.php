<?php
include "../connectDB/connectDB.php";
if (isset($_GET["product"])) {
    $search = $_GET["search"];
    $sql = "SELECT * FROM product WHERE pd_id LIKE '%$search%' OR pd_name LIKE '%$search%'";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        while ($row = mysqli_fetch_array($result)) {
?>
            <div class="col-md-4">
                <div class="card">
                    <img src="<?php echo $row['pd_img'] ?>" width="430" height="400" class="card-img-top" alt="...">
                    <div class="card_text">
                        <p class="text1">รหัสสินค้า: <span class="text2" style="text-align: left;"><?php echo $row['pd_id'] ?></span></p>
                        <p class="text1">ชื่อสินค้า: <span class="text2"><?php echo $row['pd_name'] ?></span></p>
                        <p class="text1">เหลือ: <span class="text2"></span><?php echo $row['pd_qty'] ?></p>
                        <p class="text1">ราคา: <span class="text2"><?php echo $row['pd_price'] ?></span></p>
                        <button onclick="create_edt_modal('<?php echo $row['pd_id'] ?>')" style="margin-left: 10px;margin-bottom: 10px;" type="button" class="btn btn-warning">แก้ไขรายการสินค้า</button>
                    </div>
                </div>
            </div>
        <?php
        }
    }
}

if (isset($_GET["staff"])) {
    $search = $_GET["search"];
    $sql = "SELECT * FROM staff WHERE username LIKE '%$search%' OR fname LIKE '%$search%' OR lname LIKE '%$search%'";
    $result = mysqli_query($conn, $sql);
    $num_row = 1;
    if ($result) {
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
    }
}

if (isset($_GET["customer"])) {
    $search = $_GET["search"];
    $sql = "SELECT * FROM customer WHERE username LIKE '%$search%' OR fname LIKE '%$search%' OR lname LIKE '%$search%'";
    $result = mysqli_query($conn, $sql);
    $num_row = 1;
    if ($result) {
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
    }
}






?>