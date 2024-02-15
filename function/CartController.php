<?php
include "../connectDB/connectDB.php";
if (isset($_GET["addtocart"])) {
    $pd_id = $_GET["pd_id"];
    $num_row = $_GET["numrow"];
    $sql = "SELECT * FROM product WHERE pd_id = '$pd_id'";
    $result  = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);
?>
    <tr id="tr_<?php echo $row["pd_id"]?>">
    <td class="td1"><?php echo $num_row?></td>
    <td class="td2" id="testJS"><?php echo $row["pd_id"]?></td>
    <td class="td3">
        <span>
            <button onclick="delProduct('<?php echo $row['pd_id']?>')" class="btn_d">-</button>
        </span>
        <span id="num_<?php echo $row["pd_id"]?>">1</span>
        <!-- <span id="num_<?php echo $row["pd_id"]?>"><input type="number" name="" id="numofproduct" value="1" max="<?php echo $row['pd_qty']?>"></span> -->

        <span>
            <button class="btn_p" onclick="plusProduct('<?php echo $row['pd_id']?>')">+</button>
        </span>
    </td>
    <td class="td4" id="price_<?php echo $row["pd_id"]?>"><?php echo $row["pd_price"]?></td>
    <td class="td5"><span>
            <button onclick="deleteProduct('<?php echo $row['pd_id']?>')" class="btn_delete"><img class="img_bin" src="../img/bin.png" alt=""></button>
        </span>
    </td>
    </tr>
<?php
}


if(isset($_GET["search_cus"])){
    ?>
    <div class="row">
        <div class="col-2">
            <span>ค้นหาผู้ใช้งาน</span>
        </div>
        <div class="col-10">
            <input type="text" class="form-control" id="search_cus" placeholder="ค้นหาจากชื่อ หรือ หมายเลขโทรศัพท์" onkeyup="search_info()">
        </div>
    </div>
    <?php
}


if(isset($_GET["search_info"])){
    ?>
    <table class="table">
        <thead>
            <th>No.</th>
            <th>ชื่อ</th>
            <th>สกุล</th>
            <th>โทรศัพท์</th>
            <th>Email</th>
        </thead>
        <tbody>
            <?php
                $data = $_GET["data"];
                $sql = "SELECT * FROM customer WHERE username LIKE '%$data%' OR fname LIKE '%$data%' OR lname LIKE '%$data%' OR phone LIKE '%$data%' OR email LIKE '%$data%'";
                $result = mysqli_query($conn,$sql);
                $num=1;
                while($row= mysqli_fetch_array($result)){
                    ?>
                    <tr onclick="userinfo('<?php echo $row['username'] ?>')">
                        <td><?php echo $num ?></td>
                        <td><?php echo $row["fname"] ?></td>
                        <td><?php echo $row["lname"] ?></td>
                        <td><?php echo $row["phone"] ?></td>
                        <td><?php echo $row["email"] ?></td>
                    </tr>
                    <?php
                    $num++;
                }
            ?>
        </tbody>
    </table>
    <?php
}


if(isset($_GET["getUserinfo"])){
    $username = $_GET["username"];
    $sql = "SELECT * FROM customer WHERE username = '$username'";
    $result = mysqli_query($conn,$sql);
    $row = mysqli_fetch_array($result);
    ?>
    <div class="row">

        <div class="col-12 mt-6"><b>ข้อมูลผู้ใช้งาน</b></div>
        <br>
        <br>

        <div class="col-2">username</div>
        <div class="col-10"><input type="text" name="" id="usernameInfo" value="<?php echo $row["username"] ?>" readonly class="form-control mt-3"></div>
        <br>
        <div class="col-2">ชื่อจริง</div>
        <div class="col-10"><input type="text" name="" id="" value="<?php echo $row["fname"] ?>" readonly class="form-control mt-3"></div>
        <br>
        <div class="col-2">นามสกุล</div>
        <div class="col-10"><input type="text" name="" id="" value="<?php echo $row["lname"] ?>" readonly class="form-control mt-3"></div>
        <br>
        <div class="col-2">เบอร์โทรศัพท์</div>
        <div class="col-10"><input type="text" name="" id="" value="<?php echo $row["phone"] ?>" readonly class="form-control mt-3"></div>
        <br>
        <div class="col-2">Email</div>
        <div class="col-10"><input type="text" name="" id="" value="<?php echo $row["email"] ?>" readonly class="form-control mt-3"></div>
    </div>
    <?php
}

if(isset($_GET["savetocart"])){
    $customer=$_GET["customer"];
    $product = $_GET["product"];
    $total = $_GET["total"];
    $qty = $_GET["qty"];
    $list_product = explode(",",$product);
    $list_qty = explode(",",$qty);
    $username = "STF002";
    echo $customer;
    echo $username;
    $sqlCreateOrder = "INSERT INTO purchaseorder(customer_id,staff_id,purchase_price) VALUES ('$customer','$username',$total)";
    mysqli_query($conn,$sqlCreateOrder);
    
    $sqlFetchId = "SELECT * FROM purchaseorder WHERE customer_id = '$customer' ORDER BY purchase_id DESC LIMIT 1";
    $resultID = mysqli_query($conn,$sqlFetchId);
    $rowID= mysqli_fetch_array($resultID);
    $rowID = $rowID["purchase_id"];
    // echo "\n".$rowID["id"];


    for($i=0;$i<count($list_product);$i++){
        $prod = $list_product[$i];
        $sub_qty = $list_qty[$i];
        $sqlPrice = "SELECT * FROM product WHERE pd_id = '$prod'";
        $resultPrice = mysqli_query($conn,$sqlPrice);
        $rowPrice = mysqli_fetch_array($resultPrice);
        $qty_amount = $rowPrice["pd_qty"];
        $rowPrice = $rowPrice["pd_price"];
        $sqlDetail = "INSERT INTO orderdetail(product_id,qty,purchase_id,price) VALUES('$prod','$sub_qty','$rowID',$rowPrice)";
        $resultDetail = mysqli_query($conn,$sqlDetail);
        $totalqty = $qty_amount - $sub_qty;
        $sqlUpdate = "UPDATE product SET pd_qty = $totalqty WHERE pd_id = '$prod'";
        mysqli_query($conn,$sqlUpdate);
        echo "<script>console.log('".$sub_qty."')</script>";
        echo "<script>console.log('".$qty_amount."')</script>";
     }

     $sqlUserInfo = "SELECT * FROM customer WHERE username = '$customer'";
     $resultUserInfo = mysqli_query($conn,$sqlUserInfo);
     $fetchUserInfo = mysqli_fetch_array($resultUserInfo);

     $oldPoint = $fetchUserInfo["point"];
     $currentPoint = floor($total/500);
     $newPoint = $oldPoint+$currentPoint;

     $sqlUpdatePoint = "UPDATE customer SET point = $newPoint WHERE username = '$customer'";
     mysqli_query($conn,$sqlUpdatePoint);

     
     echo "success";

}

if(isset($_GET["search"])){
    $search = $_GET["search"];
    $sql = "SELECT * FROM product WHERE pd_name LIKE '%$search%' OR pd_desp LIKE '%$search%' OR pd_id LIKE '%$search%' ";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        while ($row = mysqli_fetch_array($result)) {
        ?>
          <div class="col-md-4" onclick="addcart('<?php echo $row['pd_id'] ?>')">
            <div class="card">
              <img src="<?php echo $row["pd_img"] ?>" style="object-fit: cover;" width="100%" height="200" class="card-img-top" alt="...">
              <div class="card_text">
                <p class="text1">รหัสสินค้า: <span class="text2" style="text-align: left;"><?php echo $row["pd_id"] ?></span></p>
                <p class="text1">ชื่อสินค้า: <span class="text2"><?php echo $row["pd_name"] ?></span></p>
                <p class="text1">เหลือ: <span class="text2"><?php echo $row["pd_qty"] ?></span></p>
                <p class="text1">ราคา: <span class="text2"><?php echo $row["pd_price"] ?></span></p>
              </div>
            </div>
          </div>

        <?php
        }
    }
}

?>

