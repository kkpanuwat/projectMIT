<?php include "../connectDB/connectDB.php" ?>
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

  <script>
    let product = {};

    function cal() {
      let total = 0;
      for (i in product) {
        let price = parseInt(document.getElementById("price_" + i).innerHTML)
        total += price * product[i]
      }
      document.getElementById("sumprice").value = total;
      console.log(product)
    }

    function addcart(pd_id) {
      if (document.getElementById("tr_" + pd_id)) {
        let value = document.getElementById("num_" + pd_id);
        value.innerHTML = parseInt(value.innerHTML) + 1;
        product[pd_id] = product[pd_id] + 1;
      } else {
        let cart = document.getElementById("allcart");
        if (window.XMLHttpRequest) {
          xmlhttp = new XMLHttpRequest();

        } else {
          xmlhttp = new ActiveXOject("Microsoft.XMLHTTP");
        }

        let count = 0;
        xmlhttp.onreadystatechange = function() {

          if (xmlhttp.responseText != "" && count == 0) {
            count++;
            cart.innerHTML += xmlhttp.responseText;
            product[pd_id] = 1;
            cal()
          }

        }
        let num = cart.childElementCount + 1;
        xmlhttp.open("GET", "./CartController.php?addtocart&pd_id=" + pd_id + "&numrow=" + num, true);
        xmlhttp.send();
      }
      cal()
    }

    function delProduct(pd_id) {
      if (document.getElementById("tr_" + pd_id)) {
        let value = document.getElementById("num_" + pd_id);
        if (value.innerHTML == 1) {
          let con = confirm("คุณต้องการลบสินค้าใช่หรือไม่");
          if (con) {
            document.getElementById("tr_" + pd_id).remove();
            delete product[pd_id]
          }
        } else {
          value.innerHTML = parseInt(value.innerHTML) - 1;
          product[pd_id] = product[pd_id] - 1;
        }

      }
      cal()
    }

    function plusProduct(pd_id) {
      if (document.getElementById("tr_" + pd_id)) {
        let value = document.getElementById("num_" + pd_id);
        value.innerHTML = parseInt(value.innerHTML) + 1;
        product[pd_id] = product[pd_id] + 1;
      }
      cal()
    }

    function deleteProduct(pd_id) {
      if (confirm("คุณต้องการลบสินค้าใช่หรือไม่")) {
        document.getElementById("tr_" + pd_id).remove();
        delete product[pd_id]
      }
      cal()
    }

    function callSearch() {


      let select = document.getElementById("cus_info").value;
      if (select == "none") {
        document.getElementById("display").innerHTML = "";
      } else {

        let display = document.getElementById("display");
        if (window.XMLHttpRequest) {
          xmlhttp = new XMLHttpRequest();

        } else {
          xmlhttp = new ActiveXOject("Microsoft.XMLHTTP");
        }

        let count = 0;
        xmlhttp.onreadystatechange = function() {

          if (xmlhttp.responseText != "" && count == 0) {
            count++;
            console.log(xmlhttp.responseText)
            display.innerHTML = xmlhttp.responseText;
          }

        }

        xmlhttp.open("GET", "./CartController.php?search_cus", true);
        xmlhttp.send();
      }
    }


    function search_info() {
      let data = document.getElementById("search_cus").value;
      if (window.XMLHttpRequest) {
        xmlhttp = new XMLHttpRequest();

      } else {
        xmlhttp = new ActiveXOject("Microsoft.XMLHTTP");
      }

      let count = 0;
      xmlhttp.onreadystatechange = function() {

        if (xmlhttp.responseText != "" && count == 0) {
          count++;
          document.getElementById("search_table").innerHTML = xmlhttp.responseText;
          // console.log(xmlhttp.responseText)
          // display.innerHTML = xmlhttp.responseText;
          // search_table
        }

      }

      xmlhttp.open("GET", "./CartController.php?search_info&data=" + data, true);
      xmlhttp.send();
    }

    function creatSuccess() {

    }

    function userinfo(args) {
      if (window.XMLHttpRequest) {
        xmlhttp = new XMLHttpRequest();

      } else {
        xmlhttp = new ActiveXOject("Microsoft.XMLHTTP");
      }

      let count = 0;
      xmlhttp.onreadystatechange = function() {

        if (xmlhttp.responseText != "" && count == 0) {
          count++;
          document.getElementById("userinfo").innerHTML = xmlhttp.responseText;
          // console.log(xmlhttp.responseText)
          // display.innerHTML = xmlhttp.responseText;
          // search_table
        }

      }

      xmlhttp.open("GET", "./CartController.php?getUserinfo&username=" + args, true);
      xmlhttp.send();

      // getUserinfo
    }


    function savetocart() {
      let select = document.getElementById("cus_info").value;
      let username = "";

      if (select == "none") {
        username = "guess";
      } else {
        username = document.getElementById("usernameInfo").value;
      }
      let str_product = "";
      let str_qty = "";
      let num = 0;
      for (i in product) {
        if (num == 0) {
          str_product += i;
          str_qty += product[i];
        } else {
          str_product += "," + i;
          str_qty += "," + product[i];
        }
        num++;
      }
      let total = document.getElementById("sumprice").value;
      if (window.XMLHttpRequest) {
        xmlhttp = new XMLHttpRequest();

      } else {
        xmlhttp = new ActiveXOject("Microsoft.XMLHTTP");
      }

      let count = 0;
      xmlhttp.onreadystatechange = function() {

        if (xmlhttp.responseText != "" && count == 0) {
          count++;
          console.log(xmlhttp.responseText)
          document.getElementById("dis_button").click();
          document.getElementById("btn_success").click();
          document.getElementById("allcart").innerHTML = "";
          loadData()
        }

      }


      xmlhttp.open("GET", "./CartController.php?savetocart&customer=" + username + "&product=" + str_product + "&qty=" + str_qty + "&total=" + total, true);
      xmlhttp.send();



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
                xmlhttp.open("GET", "./CartController.php?search="+search, true);
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

    <div class="center">

      <div class="row">
        <div class="col-12">
          <input onkeyup="loadData()" style="width: 100%;" type="text" name="search" id="search" class="form-control" placeholder="ค้นหาสินค้า">
        </div>
      </div>
      <div class="row" id="result_query">
        <!-- row2 -->

        <?php
        $sql = "SELECT * FROM product";
        $result  = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_array($result)) {
        ?>
          <div class="col-md-4" onclick="addcart('<?php echo $row['pd_id'] ?>')">
            <div class="card" style="box-shadow: 10px 10px 10px rgb(216, 216, 216);">
              <img src="<?php echo $row["pd_img"] ?>" style="object-fit: cover;" width="100%" height="200" class="card-img-top" alt="...">
              <div class="card_text">
                <p class="text1">รหัสสินค้า: <span class="text2" style="text-align: left;"><?php echo $row["pd_id"] ?></span></p>
                <p class="text1">ชื่อสินค้า: <span class="text2"><?php echo $row["pd_name"] ?></span></p>
                <p class="text1">เหลือ: <span class="text2"><?php echo $row["pd_qty"] ?></span></p>
                <p class="text1">ราคา: <span class="text2"><?php echo $row["pd_price"] ?></span></p>
              </div>
            </div>
          </div>
          
          <!-- col-md-4 -->
        <?php
        }
        ?>
      </div><!-- row2 -->
    </div>



    <div class="right">
      <div class="row" id="row_card">
        <!-- row3 -->
        <h6 class="topic" style="margin-top: -1em;">รายการสั่งซื้อสินค้าสินค้า</h6>

        <div class="item1">

          <table class="item2">
            <thead>
              <th class="th1">ลำดับ</th>
              <th class="th2">รหัสสินค้า</th>
              <th class="th3">จำนวน</th>
              <th class="th4">ราคา</th>
              <th class="th5"></th>
            </thead>
            <tbody id="allcart">

            </tbody>
          </table>


          <div class="sp">
            <span class="sum_price"> ราคารวม : <input class="sum" id="sumprice" type="text" placeholder="0">
              <button type="button" class="btn btn-primary btn_format" style="background-color: #008068; border:0px;box-shadow: #b9b8b8 5px 5px 10px;margin-left:25%" data-toggle="modal" data-target="#exampleModalCenter">ยืนยันการสั่งซื้อ</button></span>
          </div>

        </div>

      </div><!-- row3 -->
    </div>


    <button style="display: none;" id="btn_success" type="button" class="btn btn-primary btn_format" data-toggle="modal" data-target="#success"></button></span>
    <div class="modal fade bd-example-modal-xl" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">ยืนยันการทำรายการ</h5>
            <button type="button" class="close btn btn-danger" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="#" method="post" enctype="multipart/form-data">
              <p class="lable_info">ข้อมูลลูกค้า</p>
              <!-- <input type="text" id=> -->
              <select onchange="callSearch()" name="" id="cus_info" class="form-control">
                <option value="none">ลูกค้าไม่เป็นสมาชิก</option>
                <option value="yes">เป็นสมาชิก</option>
              </select>
              <br>

              <div id="display">
              </div>
              <div id="search_table">
              </div>
              <div id="userinfo">
              </div>


              <div class="modal-footer">
                <button type="button" id="dis_button" class="btn btn-secondary" data-dismiss="modal">ยกเลิกการทำรายการ</button>
                <button type="button" class="btn btn-success" onclick="savetocart()">บันทึกข้อมูล</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade bd-example-modal-xl" id="success" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle" style="font-family: 'Prompt', sans-serif !important;">สถานะการทำรายการ</h5>
          </div>
          <div class="modal-body">
            <form action="#" method="post" enctype="multipart/form-data">
              <center><img src="../asset/image/success.png" alt=""> <br>
                <h2 style="font-family: 'Prompt', sans-serif !important; color: #7abf43;">ทำรายการสั่งซื้อสำเร็จ</h2>
              </center>
              <div class="modal-footer">
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>


  </div>
</body>
<?php include("../cnd.php") ?>

</html>