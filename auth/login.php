<?php 
include("../inc/header.php");
?>
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

                            <div class="form-floating mb-3">
                                <input type="email" class="form-control " placeholder="Email address">
                                <label for="floatingInput">Email address</label>
                            </div>
                            <div class="form-floating mb-5">
                                <input type="password" class="form-control " placeholder="Password">
                                <label for="floatingPassword">Password</label>
                            </div>
                            <button class=" fw-bold btn btn-outline-light btn-lg px-5" type="submit">Login</button>
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