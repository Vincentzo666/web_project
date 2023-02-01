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
                            <div class="col-sm-3">
                                <h6 class="mb-0">รหัสนักศึกษา</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <?= $show_std[0]['std_id'] ?>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">คำนำหน้า</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <?= $show_std[0]['prefix'] ?>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">ชื่อ</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <?= $show_std[0]['fname'] ?>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">นามสกุล</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <?= $show_std[0]['lname'] ?>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">อีเมล์</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <?= $show_std[0]['email'] ?>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">เบอร์โทร</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <?= $show_std[0]['phone'] ?>
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