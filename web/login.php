<!doctype html>
<html>
<head>
   
  <title>ระบบเช็คชื่อเเละตรวจจับพฤติกรรม</title> <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
  <style>
    body {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }
  </style>
</head>
<div class="container text-center">
    <h1>ระบบเช็คชื่อเเละตรวจจับพฤติกรรม</h1>
</div>
<body>
  <div>
  
    <form method="post">
      <label for="username">ชื่อผู้ใช้:</label><br>
      <input type="text" id="username" name="username"><br>
      <label for="password">รหัสผ่าน:</label><br>
      <input type="password" id="password" name="password"><br><br>
      <input type="submit" value="ยืนยัน">
      <button type="button" onclick="location.href='register.php'">สมัครสมาชิก</button>
    </form> 
    <?php
      if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Get the submitted username and password
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Do some validation and authentication here

        // Redirect to the dashboard page if successful
        header("Location: home.php");
        exit;
      }
    ?>
  </div>
</body>
</html>
