<div class="tab-content" id="nav-tabContent">
    <div class="tab-pane fade show active" id="nav-show" role="tabpanel" aria-labelledby="nav-show-tab">
        <div class="ps-3">
            <div class="row">
                <div class="col-sm-3">
                    <h6 class="mb-0">คำนำหน้า</h6>
                </div>
                <div class="col-sm-9 text-secondary">
                    <?= $teacher[0]['prefix'] ?>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-sm-3">
                    <h6 class="mb-0">ชื่อ</h6>
                </div>
                <div class="col-sm-9 text-secondary">
                    <?= $teacher[0]['fname'] ?>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-sm-3">
                    <h6 class="mb-0">นามสกุล</h6>
                </div>
                <div class="col-sm-9 text-secondary">
                    <?= $teacher[0]['lname'] ?>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-sm-3">
                    <h6 class="mb-0">อีเมล์</h6>
                </div>
                <div class="col-sm-9 text-secondary">
                    <?= $teacher[0]['email'] ?>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-sm-3">
                    <h6 class="mb-0">เบอร์โทร</h6>
                </div>
                <div class="col-sm-9 text-secondary">
                    <?= $teacher[0]['phone'] ?>
                </div>
            </div>
            <hr>
            <div class="col-md-3">
                <button class="btn btn-danger" data-bs-toggle="modal"
                    data-bs-target="#profiledelModal">ลบบัญชีนี้</button>
            </div>
        </div>
    </div>

    <!-- ************************************************************************************* -->

    <div class="tab-pane fade" id="nav-edit" role="tabpanel" aria-labelledby="nav-edit-tab">
        <div class="ps-3">
            <form action="?page=teacher_edit" method="post">
                <div class="row mb-3 d-flex justify-content-start">
                    <label for="input" class="col-sm-2 col-form-label">คำนำหน้า</label>
                    <div class="col-sm-9">
                        <div class="col-3">
                            <select class="form-select " id="teacher_prefix" name="teacher_prefix">
                                <option value="">--คำนำหน้า--</option>
                                <option value="นาย" <?php if($teacher[0]['prefix']=="นาย"): ?> selected="selected"
                                    <?php endif; ?>>นาย
                                </option>
                                <option value="นาง" <?php if($teacher[0]['prefix']=="นาง"): ?> selected="selected"
                                    <?php endif; ?>>นาง
                                </option>
                                <option value="นางสาว" <?php if($teacher[0]['prefix']=="นางสาว"): ?> selected="selected"
                                    <?php endif; ?>>นางสาว
                                </option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row mb-3 d-flex justify-content-start">
                    <label for="input" class="col-sm-2 col-form-label">ชื่อ
                        <span class="text-danger">*</span></label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="teacher_fname" name="teacher_fname"
                            placeholder="ชื่อ" required value="<?= $teacher[0]['fname'] ?>">
                    </div>
                </div>
                <div class="row mb-3 d-flex justify-content-start">
                    <label for="input" class="col-sm-2 col-form-label">นามสกุล
                        <span class="text-danger">*</span></label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="teacher_lname" name="teacher_lname"
                            placeholder="นามสกุล" required value="<?= $teacher[0]['lname'] ?>">
                    </div>
                </div>
                <div class="row mb-3 d-flex justify-content-start">
                    <label for="input" class="col-sm-2 col-form-label">อีเมล์</label>
                    <div class="col-sm-8">
                        <input type="email" class="form-control" id="teacher_email" name="teacher_email"
                            placeholder="อีเมล์" value="<?= $teacher[0]['email'] ?>">
                    </div>
                </div>
                <div class="row mb-3 d-flex justify-content-start">
                    <label for="input" class="col-sm-2 col-form-label">เบอร์โทรศัพท์</label>
                    <div class="col-sm-8">
                        <input type="phone" class="form-control" id="teacher_phone" name="teacher_phone"
                            placeholder="เบอร์โทรศัพท์" value="<?= $teacher[0]['phone'] ?>">
                    </div>
                </div>
                <hr>
                <div class="col-md-3">
                    <button type="submit" class="btn btn-primary" name="action" value="teacher_edit2">บันทึกการแก้ไข
                        <i class="fa-solid fa-cloud-arrow-up"></i></button>
                </div>
            </form>
        </div>
    </div>

    <!-- *************************************************************************************-->

    <div class="tab-pane fade" id="nav-user" role="tabpanel" aria-labelledby="nav-user-tab">
        <div class="ps-3">
            <form action="?page=teacher_edit" method="post">
                <div class="row mb-3 d-flex justify-content-start">
                    <label for="input" class="col-sm-2 col-form-label">ชื่อผู้ใช้เดิม
                        <span class="text-danger">*</span></label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="old_username" name="old_username"
                            placeholder="ชื่อผู้ใช้เดิม" required>
                    </div>
                </div>
                <div class="row mb-3 d-flex justify-content-start">
                    <label for="input" class="col-sm-2 col-form-label">ชื่อผู้ใช้ใหม่
                        <span class="text-danger">*</span></label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="new_username" name="new_username"
                            placeholder="ชื่อผู้ใช้ใหม่" required minlength="6">
                    </div>
                </div>
                <div class=" row mb-3 d-flex justify-content-start">
                    <label for="input" class="col-sm-2 col-form-label">รหัสผ่าน<span
                            class="text-danger">*</span></label>
                    <div class="col-sm-8">
                        <input type="password" class="form-control" id="verify_password" name="verify_password"
                            placeholder="รหัสผ่าน" required>
                    </div>
                </div>
                <hr>
                <div class="col-md-3">
                    <button type="submit" class="btn btn-primary" name="action" value="teacher_edit3">บันทึกการแก้ไข
                        <i class="fa-solid fa-cloud-arrow-up"></i></button>
                </div>
            </form>
        </div>
    </div>

    <!-- *************************************************************************************-->

    <div class="tab-pane fade" id="nav-password" role="tabpanel" aria-labelledby="nav-password-tab">
        <div class="ps-3">
            <form action="?page=teacher_edit" method="post">
                <div class="row mb-3 d-flex justify-content-start">
                    <label for="input" class="col-sm-2 col-form-label">รหัสผ่านเดิม
                        <span class="text-danger">*</span></label>
                    <div class="col-sm-8">
                        <input type="password" class="form-control" id="old_password" name="old_password"
                            placeholder="รหัสผ่านเดิม" required>
                    </div>
                </div>
                <div class="row mb-3 d-flex justify-content-start">
                    <label for="input" class="col-sm-2 col-form-label">รหัสผ่านใหม่
                        <span class="text-danger">*</span></label>
                    <div class="col-sm-8">
                        <input type="password" class="form-control" id="new_password" name="new_password"
                            placeholder="รหัสผ่านใหม่" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                            title="a-Z ต้องมีตัวพิมพ์ใหญ่ ตัวพิมพ์เล็กและตัวเลข(อย่างน้อย 8 ตัวอักษร)">
                    </div>
                </div>
                <div class=" row mb-3 d-flex justify-content-start">
                    <label for="input" class="col-sm-2 col-form-label">ยืนยันรหัสผ่านใหม่<span
                            class="text-danger">*</span></label>
                    <div class="col-sm-8">
                        <input type="password" class="form-control" id="verify_password" name="verify_password"
                            placeholder="ยืนยันรหัสผ่านใหม่" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                            title="a-Z ต้องมีตัวพิมพ์ใหญ่ ตัวพิมพ์เล็กและตัวเลข(อย่างน้อย 8 ตัวอักษร)">
                    </div>
                </div>
                <hr>
                <div class="col-md-3">
                    <button type="submit" class="btn btn-primary" name="action" value="teacher_edit4">บันทึกการแก้ไข
                        <i class="fa-solid fa-cloud-arrow-up"></i></button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- *************************************************************************************
    ************************************************************************************* -->

<div class="modal fade" id="profileModal" tabindex="-1" aria-labelledby="profileModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="profileModalModalLabel">แก้ไขรูปภาพส่วนตัว</h5>
            </div>
            <form method="post" action="?page=teacher_edit" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="px-4 text-center">
                        <input class="form-control" id="teacher_profile" name="teacher_profile" type="file"
                            accept="image/*" onchange="readURL(this);">
                        <br>
                        <img id='preview' class="pb-3"
                            style="display:none; width: 250px; height: 250px; object-fit: cover;">
                        <div id="stored_picture" class="pb-3">
                            <?php if ($teacher[0]['profile']!='') { ?>

                            <img src="upload/img_teacher/<?= $teacher[0]['profile'] ?>"
                                style="width: 250px; height: 250px; object-fit: cover;">

                            <?php } ?>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" name="action" value="teacher_edit1">บันทึกการแก้ไข
                            <i class="fa-solid fa-cloud-arrow-up"></i></button>
                        <button type="button" class="btn btn-warning" data-bs-dismiss="modal">ยกเลิก</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- *************************************************************************************
    ************************************************************************************* -->

<div class="modal fade" id="profiledelModal" tabindex="-1" aria-labelledby="profiledelModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="profiledelModalModalLabel">แก้ไขรูปภาพส่วนตัว</h5>
            </div>
            <form method="post" action="?page=teacher_edit" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="px-4 text-center">
                        <input class="form-control" id="teacher_profile" name="teacher_profile" type="file"
                            accept="image/*" onchange="readURL(this);">
                        <br>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" name="action" value="teacher_edit1">บันทึกการแก้ไข
                            <i class="fa-solid fa-cloud-arrow-up"></i></button>
                        <button type="button" class="btn btn-warning" data-bs-dismiss="modal">ยกเลิก</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>