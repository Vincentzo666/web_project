<?php 
include("../inc/header.php");
include("../php/function.php");
if(isset($_POST["register"]) && $_POST["register"]=='register'){
    // echo "<script>console.log('1111')</script>";
    if (!empty($_POST['register_email']) && !empty($_POST['register_password']) && !empty($_POST['register_username'])) {
        // echo "<script>console.log('2222')</script>";
        $lms = new lms();
        $email = mysqli_real_escape_string($lms->dbConnect, trim($_POST['register_email']));
        $username = mysqli_real_escape_string($lms->dbConnect, trim($_POST['register_username']));
        $password = mysqli_real_escape_string($lms->dbConnect, trim($_POST['register_password']));

        $check_email = $lms->select('teacher',"*","email='$email'");
        if(!empty($check_email)) {
            // echo "<script>console.log('yess')</script>";
            $_SESSION['error'] = "อีเมลล์นี้มีในระบบแล้ว กรุณาใช้อีเมลล์อื่น!";
            echo "<script>window.history.back();</script>";
            exit;
            
        } else {
            // echo "<script>console.log('noo')</script>";
            $check_username = $lms->select('teacher',"*","username='$username'");
            if(!empty($check_username)) {
                // echo "<script>console.log('yess')</script>";
                $_SESSION['error'] = "ยูสเซอร์เนมนี้มีในระบบแล้ว กรุณาใช้ยูสเซอร์เนมอื่น!";
                echo "<script>window.history.back();</script>";
                exit;
                
            }else{
                $register = $lms->insert('teacher',['email'=>$email,'username'=>$username,'password'=>$password,'cr_time'=>$date]); 
                if(!empty($register)) {
                    $_SESSION['success'] = "สมัครสมาชิกสำเร็จ!";
                    echo "<script>window.location.href='login.php';</script>";
                    exit;
                    
                } else {
                    $_SESSION['error'] = "เกิดข้อผิดพลาด กรุณาลองใหม่อีกครั้ง!";
                    echo "<script>window.history.back();</script>";
                    exit;
                }
            }
            
        }   
    }
    exit;
}

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

                            <h2 class="fw-bold mb-2 text-uppercase text-white">Register</h2>
                            <p class="text-white-50 mb-5">Please enter email and password!</p>
                            <form method="post" action="">
                                <div class="form-floating mb-3">
                                    <input type="email" class="form-control" name="register_email" id="register_email"
                                        placeholder="Email address" required>
                                    <label for="floatingInput">Email address</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" name="register_username"
                                        id="register_username" placeholder="Username" required>
                                    <label for="floatingInput">Username</label>
                                </div>
                                <div class="form-floating mb-5">
                                    <input type="password" class="form-control" name="register_password"
                                        id="register_password" placeholder="Password" minlength="6" required>
                                    <label for="floatingPassword">Password</label>
                                </div>
                                <input type="hidden" name="register" value="register">
                                <button class=" fw-bold btn btn-outline-light btn-lg px-5" id="submit_register"
                                    type="submit">Register</button>
                            </form>

                        </div>
                        <div class="mb-5">
                            <p class="mb-0 text-white">I have an account &nbsp;<a href="login.php"
                                    class="text-danger fw-bold">Back to Login</a>
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