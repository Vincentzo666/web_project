<?php 
include("inc/header.php");
include("php/function.php");

if(!isset($_SESSION['id_teacher'])){
    if(isset($_GET['action'])&& $_GET['action']=='logout'){
        $_SESSION['success'] = "ออกจากระบบสำเร็จ!";
        echo "<script>window.location.href='auth/login.php';</script>";
        exit;
    }
    $_SESSION['error'] = "กรุณาเข้าสู่ระบบใหม่อีกครั้ง!";
    echo "<script>window.location.href='auth/login.php';</script>";
    exit;
}
$profile ="image/profile/cat.png";
include("inc/navbar.php");
?>

<?php 
include("inc/footer.php");
?>