<?php 
include("../inc/header.php");
include("../php/function.php");

if(isset($_POST["action"]) && $_POST["action"]=='login'){
    // echo "<script>console.log('1111')</script>";
    if (!empty($_POST['login_username']) && !empty($_POST['login_password'])) {
        // echo "<script>console.log('2222')</script>";
        $lms = new lms();
        $username = mysqli_real_escape_string($lms->dbConnect, trim($_POST['login_username']));
        $password = mysqli_real_escape_string($lms->dbConnect, trim($_POST['login_password']));
        $en_password = $lms->encode($password);
        
        $login = $lms->select('teacher',"*","username='$username' AND password='$en_password'"); 
        
        if(!empty($login)) {
            // echo "<script>console.log('yess')</script>";
            $_SESSION['success'] = "เข้าสู่ระบบสำเร็จ!";
            $_SESSION['id_teacher'] = $login[0]['id'];
            $_SESSION['name_teacher'] = $login[0]['fname']." ".$login[0]['lname'];
            echo "<script>window.location.href='../index.php';</script>";
            exit;
            
        } else {
            // echo "<script>console.log('noo')</script>";
            $_SESSION['error'] = "ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง กรุณาลองใหม่อีกครั้ง!";
            echo "<script>window.history.back();</script>";
            exit;
        }
    }else{
        
        $_SESSION['error'] = "เกิดข้อผิดพลาด กรุณาลองใหม่อีกครั้ง!";
        echo "<script>window.history.back();</script>";
        exit;
    }
}
session_unset();
session_destroy();
?>
<style>
.gradient-custom {
    /* fallback for old browsers */
    background: #6a11cb;

    /* Chrome 10-25, Safari 5.1-6 */
    background: -webkit-linear-gradient(to right, rgba(106, 17, 203, 1), rgba(37, 117, 252, 1));

    /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
    background: linear-gradient(to right, rgba(106, 17, 203, 1), rgba(37, 117, 252, 1))
}
</style>
<section class="vh-100 gradient-custom">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                <div class="card bg-dark text-black" style="border-radius: 1rem;">
                    <div class="card-body p-5 text-center">

                        <div class="mb-md-5 mt-md-4 pb-3">

                            <h4 class="fw-bold mb-2 text-uppercase text-white mb-4">Learning Management System </h4>
                            <h2 class="fw-bold mb-2 text-uppercase text-white">Login</h2>
                            <p class="text-white-50 mb-5">Please enter your email and password!</p>

                            <form method="post" action="">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" name="login_username" id="login_username"
                                        placeholder="Username" required>
                                    <label for="floatingInput">Username</label>
                                </div>
                                <div class="form-floating mb-5">
                                    <input type="password" class="form-control" name="login_password"
                                        id="login_password" placeholder="Password" minlength="6" required>
                                    <label for="floatingPassword">Password</label>
                                </div>
                                <input type="hidden" name="action" value="login">
                                <button class=" fw-bold btn btn-outline-light btn-lg px-4" type="submit">Login</button>
                            </form>
                        </div>
                        <div class="mb-5">
                            <p class="mb-0 text-white">Don't have an account? <a href="register.php"
                                    class="text-danger fw-bold">Register</a>
                            </p>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php 
include("../inc/footer.php");
?>