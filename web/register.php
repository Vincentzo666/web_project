<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
<style>
div {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
}
</style> 
</head>
<body>

<div>
  <h1>สมัครสมาชิก</h1>
  <form method="post">
    <label for="username">ชื่อผู้ใช้:</label><br>
    <input type="text" id="username" name="username"><br>
    <label for="password">รหัสผ่าน:</label><br>
    <input type="password" id="password" name="password"><br>
    <label for="email">อีเมล์:</label><br>
    <input type="email" id="email" name="email"><br><br>
    <input type="submit" value="ยืนยัน">
    <button type="button" onclick="location.href='login.php'">ยกเลิก</button>
  </form>
</div>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = $_POST["username"];
  $password = $_POST["password"];
  $email = $_POST["email"];

  header("Location: login.php");

  // Validate the input and submit to database
}
?>

</body>
</html>
