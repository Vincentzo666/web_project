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

$lms = new lms();
$id_teacher = $_SESSION["id_teacher"];

include("inc/navbar.php");

    $page = isset($_GET['page']) ? $_GET['page'] : '';
    $sw_page='';
    if ($page) {
        switch ($page) { 
            case "teacher_edit":
                include("view/teacher_edit.php");
                break;
            case "subject_list":
                include("view/subject_list.php");
                break;
            case "subject_add":
                include("view/subject_add.php");
                break;
            case "subject_edit":
                include("view/subject_edit.php");
                break;
            case "student_list":
                include("view/student_list.php");
                break;
            case "student_add":
                include("view/student_add.php");
                break;
            case "student_edit":
                include("view/student_edit.php");
                break;
            default:
            include("view/subject_list.php");
        }

    }else{
        include("view/subject_list.php");
    }

include("inc/footer.php");
?>