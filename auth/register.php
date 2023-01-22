<?php 
include("../inc/header.php");
if(isset($_POST["register"]) && $_POST["register"]=='register'){
    echo "<script>console.log('1111')</script>";
    if (!empty($_POST['input_email']) && !empty($_POST['input_password'])) {
        echo "<script>console.log('2222')</script>";
        include("../php/function.php");
        $lms = new lms();
        $register = $lms->RegisterTeacher(trim($_POST['input_email']),trim($_POST['input_password'])); 
        if(!empty($register)) {
            $_SESSION['success'] = "สมัครสมาชิกสำเร็จ!";
            echo "<script>window.location.href='login.php';</script>";
        } else {
            $_SESSION['error'] = "เกิดข้อผิดพลาด กรุณาลองใหม่อีกครั้ง!";
            echo "<script>window.history.back();</script>";
        }
    }
}

?>
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
                                    <input type="email" class="form-control" name="input_email" id="input_email"
                                        placeholder="Email address" required>
                                    <label for="floatingInput">Email address</label>
                                </div>
                                <div class="form-floating mb-5">
                                    <input type="password" class="form-control" name="input_password"
                                        id="input_password" placeholder="Password" minlength="6" required>
                                    <label for="floatingPassword">Password</label>
                                </div>
                                <input type="hidden" name="register" value="register">
                                <button class=" fw-bold btn btn-outline-light btn-lg px-5"
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