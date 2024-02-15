<!DOCTYPE html>
<html lang="en">

<head>
  <link rel="stylesheet" href="./index.css">
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@300&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <link rel="stylesheet" href="../css/addproduct.css">
  <script src="./ckeditor/ckeditor.js"></script>
  <script>
    function login() {
      let elementUsername = document.getElementById("username");
      let elementPassword = document.getElementById("password");
      let username = document.getElementById("username").value;
      let password = document.getElementById("password").value;
      if (username == "" || password == "") {
        if (username == "") {
          elementUsername.setAttribute("style", "border:1px solid red;color:red;transition:0.7s all");
          elementUsername.setAttribute("placeholder", "กรุณากรอกชื่อผู้ใช้งาน")
        }
        if (password == "") {
          elementPassword.setAttribute("style", "border:1px solid red;color:red;transition:0.7s all");
        }
      } else {
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
            if (xmlhttp.responseText == "user") {
              window.location = "./function/userinfo.php";
            }
            if (xmlhttp.responseText == "staff") {
              window.location = "./function/";
            } else {
              document.getElementById("result").innerHTML = "Username หรือ Password ไม่ถูกต้อง";
              document.getElementById("result").setAttribute("style", "color:red;margin-left:-10em;");
              elementUsername.setAttribute("style", "border:1px solid red;color:red;width:95%;margin-left:-2em;");
              elementUsername.setAttribute("placeholder", "กรุณากรอกชื่อผู้ใช้งาน")
              elementPassword.setAttribute("style", "border:1px solid red;color:red;width:95%;margin-left:-2em;");
            }
          }

        }

        let url = "./function/LoginController.php";
        let data = "username=" + username + "&password=" + password;
        xmlhttp.open("POST", url, true);
        xmlhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xmlhttp.send(data)
      }

    }
  </script>
</head>

<body style="background-color: #aa52c2;">

  <center style="margin-top: 10vh;">
    <div style="background-color: white; width: 30vw;height: 80vh;border-radius: 0.3cm;box-shadow: #cac9c9 5px 5px 10px;">
      <center>
      <img style="margin-top: 4em;" src="img/logo2.jpg" width="200" alt="">
      </center>
      <div class="" style="margin-top: -1em;font-size: 2em;">Login</div>
      <div class="row" style="position: absolute;margin-top: 2em;">
        <div class="col-12" style="margin-left: -36%;">Username : </div>
        <div class="col-12" style="width:50%;margin-left:6%;"><input type="text" class="form-control" name="username" id="username"></div>
        <div class="col-12" style="margin-left: -36%;">Password : </div>
        <div class="col-12" style="width:50%;margin-left:6%;"><input type="password" class="form-control" name="password" id="password"></div>
        <div class="col-12" id="result"></div>
        <button style="width:30%;margin-left:15%; margin-top:3em;" class="btn btn-primary" onclick="login()">Login</button>
      </div>
    </div>
  </center>


</body>

<?php include "./cnd.php" ?>

</html>