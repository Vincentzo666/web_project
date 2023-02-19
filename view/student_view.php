<?php

    if(!isset($_SESSION['id_teacher'])){

        $_SESSION['error'] = "กรุณาเข้าสู่ระบบใหม่อีกครั้ง!";
        echo "<script>window.location.href='auth/login.php';</script>";
        exit;
        
    }

?>
<div class="modal fade" id="studentModal" tabindex="-1" aria-labelledby="studentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="studentModalModalLabel">ข้อมูลนักศึกษา</h5>
            </div>
            <div class="modal-body">
                <div class="px-4 text-center">
                    <div class="ps-3">
                        <div class="row">
                            <div class="col-sm-12 text-secondary">
                                <img src="" id="result1"
                                    style=" width: 220px; height: 220px; object-fit: cover;">
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">รหัสนักศึกษา</h6>
                            </div>
                            <p class="col-sm-9 text-secondary" id="result2">
                            </p>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">คำนำหน้า</h6>
                            </div>
                            <div class="col-sm-9 text-secondary" id="result3">
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">ชื่อ</h6>
                            </div>
                            <div class="col-sm-9 text-secondary" id="result4">
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">นามสกุล</h6>
                            </div>
                            <div class="col-sm-9 text-secondary" id="result5">
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">อีเมล์</h6>
                            </div>
                            <div class="col-sm-9 text-secondary" id="result6">
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">เบอร์โทร</h6>
                            </div>
                            <div class="col-sm-9 text-secondary" id="result7">
                            </div>
                        </div>
                        <br>
                    </div>
                </div>
                <div class="modal-footer">
                    <a type="button" class="btn btn-warning dmbtn" data-bs-dismiss="modal">ปิด</a>
                </div>
            </div>
        </div>
    </div>
</div>