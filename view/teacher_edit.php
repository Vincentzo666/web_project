<?php
    $teacher = $lms->select('teacher',"*","id='$id_teacher'");

    if(isset($_POST['action'])){
        
        $action = $_POST['action'];
        
        switch ($action) { 
            
            case "teacher_edit1":
                
                if (!empty($_FILES["teacher_profile"]["name"])) {
            
                    $targetDir = "upload/img_teacher/";
                    $temp = explode(".", $_FILES["teacher_profile"]["name"]);
                    $fileName = 'teacher-'.$namedate. '.' . end($temp);
                    $targetFilePath = $targetDir . $fileName;
                    $fileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));
                    $allowTypes = array('jpg', 'png', 'jpeg');
        
                    if (in_array($fileType, $allowTypes)) {
                                
                        if (move_uploaded_file($_FILES["teacher_profile"]["tmp_name"], $targetFilePath)) {
                            
                            $teacher_edit1 = $lms->update('teacher',['profile'=>$fileName,'up_time'=>$date],"id='$id_teacher'");
                            
                            if(!empty($teacher_edit1)) {
                                
                                $_SESSION['success'] = "แก้ไขสำเร็จ!";
                                echo "<script>window.location.href='?page=teacher_edit';</script>";
                                exit;
                                
                            }else {
                                $_SESSION['error'] = "เกิดข้อผิดพลาด กรุณาลองใหม่อีกครั้ง!";
                                unlink("upload/img_teacher/$fileName");
                                echo "<script>window.history.back();</script>";
                                exit;
                            }
                            
                        }else {
                            $_SESSION['error'] = "เกิดข้อผิดพลาด! อัพโหลดไฟล์ไม่สำเร็จ!";
                            echo "<script> window.history.back()</script>";
                            exit;   
                        } 
                        
                    }else {
                        $_SESSION['error'] = "เกิดข้อผิดพลาด! ไม่รองรับนามสกุลไฟล์ชนิดนี้!";
                        echo "<script> window.history.back()</script>";
                        exit;
                    }
                    
                }else{
                    $_SESSION['error'] = "เกิดข้อผิดพลาด! ไม่พบไฟล์ที่เลือก!";
                    echo "<script> window.history.back()</script>";
                    exit;
                }
                break;
                
            case "teacher_edit2":
                
                if (!empty($_POST['teacher_fname'])&& !empty($_POST['teacher_lname'])) {

                    $student_prefix = mysqli_real_escape_string($lms->dbConnect, trim($_POST['teacher_prefix']));
                    $teacher_fname = mysqli_real_escape_string($lms->dbConnect, trim($_POST['teacher_fname']));
                    $teacher_lname = mysqli_real_escape_string($lms->dbConnect, trim($_POST['teacher_lname']));
                    $teacher_email = mysqli_real_escape_string($lms->dbConnect, trim($_POST['teacher_email']));
                    $teacher_phone = mysqli_real_escape_string($lms->dbConnect, trim($_POST['teacher_phone']));
                    
                    $check_email1 = $lms->select('teacher',"*","id='$id_teacher' AND email='$teacher_email'");
                    
                    if(!empty($check_email1)) {
                        
                        $check_phone1 = $lms->select('teacher',"*","id='$id_teacher' AND phone='$teacher_phone'");
                        
                        if(!empty($check_phone1)) {
                        
                            $teacher_edit2 = $lms->update('teacher',['fname'=>$teacher_fname,'lname'=>$teacher_lname,'email'=>$teacher_email,'phone'=>$teacher_phone,'up_time'=>$date],"id='$id_teacher'"); 
                            
                            if(!empty($teacher_edit2)) {
                                
                                $_SESSION['success'] = "แก้ไขสำเร็จ!";
                                echo "<script>window.location.href='?page=teacher_edit';</script>";
                                exit;
                                
                            } else {
                                
                                whenerror();
                                exit;
                                
                            }
                            
                        }else{

                            $check_phone2 = $lms->select('teacher',"*","phone='$teacher_phone'");
                            
                            if(empty($check_phone2)) {
                                
                                $teacher_edit2 = $lms->update('teacher',['fname'=>$teacher_fname,'lname'=>$teacher_lname,'email'=>$teacher_email,'phone'=>$teacher_phone,'up_time'=>$date],"id='$id_teacher'"); 
                            
                                if(!empty($teacher_edit2)) {
                                    
                                    $_SESSION['success'] = "แก้ไขสำเร็จ!";
                                    echo "<script>window.location.href='?page=teacher_edit';</script>";
                                    exit;
                                    
                                } else {
                                    
                                    whenerror();
                                    exit;
                                    
                                }
                                        
                            }else{
    
                                $_SESSION['error'] = "เบอร์โทรศัพท์นี้มีในระบบแล้ว!";
                                echo "<script>window.history.back();</script>";
                                exit;
                                
                            }
                            
                        }

                    }else{
                        
                        $check_email2 = $lms->select('teacher',"*","email='$teacher_email'");
                        
                        if(empty($check_email2)) {
                        
                            $check_phone2 = $lms->select('teacher',"*","phone='$teacher_phone'");
                            
                            if(empty($check_phone2)) {
                                
                                $teacher_edit2 = $lms->update('teacher',['fname'=>$teacher_fname,'lname'=>$teacher_lname,'email'=>$teacher_email,'phone'=>$teacher_phone,'up_time'=>$date],"id='$id_teacher'"); 
                            
                                if(!empty($teacher_edit2)) {
                                    
                                    $_SESSION['success'] = "แก้ไขสำเร็จ!";
                                    echo "<script>window.location.href='?page=teacher_edit';</script>";
                                    exit;
                                    
                                } else {
                                    
                                    whenerror();
                                    exit;
                                    
                                }
                                        
                            }else{
    
                                $_SESSION['error'] = "เบอร์โทรศัพท์นี้มีในระบบแล้ว!";
                                echo "<script>window.history.back();</script>";
                                exit;
                                
                            }
                            
                        }else{
                            
                            $_SESSION['error'] = "อีเมลล์นี้มีในระบบแล้ว!";
                            echo "<script>window.history.back();</script>";
                            exit;
                        } 
                    }
                    
                }else {
                    whenerror();
                    exit;
                }
                break;
                
            case "teacher_edit3":
                
                if (!empty($_POST['old_username']) && !empty($_POST['new_username'])
                && !empty($_POST['verify_password'])) {
                    
                    $old_username = mysqli_real_escape_string($lms->dbConnect, trim($_POST['old_username']));
                    $new_username = mysqli_real_escape_string($lms->dbConnect, trim($_POST['new_username']));
                    $verify_password = mysqli_real_escape_string($lms->dbConnect, trim($_POST['verify_password']));
                    $en_verify = $lms->encode($verify_password);
                    
                    $check_new = $lms->select('teacher',"*","username='$new_username'");
                    
                    if(!empty($check_new)) {
                        
                        $_SESSION['error'] = "ชื่อผู้ใช้นี้มีในระบบแล้ว!";
                        echo "<script>window.history.back();</script>";
                        exit;
                        
                    }else{
                        
                        $check_verify = $lms->select('teacher',"*","id='$id_teacher' AND username='$old_username' AND password='$en_verify'");
                        
                        if(!empty($check_verify)){
                            
                            $teacher_edit3 = $lms->update('teacher',['username'=>$new_username,'up_time'=>$date],"id='$id_teacher'"); 
                    
                            if(!empty($teacher_edit3)) {
                                
                                $_SESSION['success'] = "แก้ไขสำเร็จ!";
                                echo "<script>window.location.href='?page=teacher_edit';</script>";
                                exit;
                                
                            } else {
                                whenerror();
                                exit;
                            }
                            
                        }else{
                            $_SESSION['error'] = "ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง!";
                            echo "<script>window.history.back();</script>";
                            exit;
                        }
                    } 
                    
                }else {
                    whenerror();
                    exit;
                }
                break;
                
            case "teacher_edit4":

                if (!empty($_POST['username']) && !empty($_POST['old_password']) 
                && !empty($_POST['new_password'])&& !empty($_POST['verify_password'])) {

                    $username = mysqli_real_escape_string($lms->dbConnect, trim($_POST['username']));
                    $old_password = mysqli_real_escape_string($lms->dbConnect, trim($_POST['old_password']));
                    $new_password = mysqli_real_escape_string($lms->dbConnect, trim($_POST['new_password']));
                    $verify_password = mysqli_real_escape_string($lms->dbConnect, trim($_POST['verify_password']));
                    $en_old = $lms->encode($old_password);
                    $en_new = $lms->encode($new_password);
                    $en_verify = $lms->encode($verify_password);
                    
                    if($en_new == $en_verify) {
                        
                        $check_up = $lms->select('teacher',"*","id='$id_teacher'AND username='$username' AND password='$en_old'");
                        
                        if(!empty($check_up)){

                            $teacher_edit4 = $lms->update('teacher',['password'=>$en_new,'up_time'=>$date],"id='$id_teacher'"); 
                        
                            if(!empty($teacher_edit4)) {
                                
                                $_SESSION['success'] = "แก้ไขสำเร็จ!";
                                echo "<script>window.location.href='?page=teacher_edit';</script>";
                                exit;
                                
                            } else {
                                whenerror();
                                exit;
                            }                   
                        }
                        
                    }else{
                        $_SESSION['error'] = "ชื่อผู้ใช้หรือรหัสผ่านเดิมไม่ถูกต้อง!";
                        echo "<script>window.history.back();</script>";
                        exit;
                    } 
                    
                }else {
                    whenerror();
                    exit;
                }
                break;

            case "teacher_delete" :

                if (!empty($_POST['del_username']) && !empty($_POST['del_password'])) {

                    $del_username = mysqli_real_escape_string($lms->dbConnect, trim($_POST['del_username']));
                    $del_password = mysqli_real_escape_string($lms->dbConnect, trim($_POST['del_password']));
                    $en_pwd = $lms->encode($del_password);

                    $check_del = $lms->select('teacher',"*","id='$id_teacher'AND username='$del_username' AND password='$en_pwd'");
                    
                    if(!empty($check_del)) {
                                
                        $del_account = $lms->delete('teacher',"id='$id_teacher'");
                        
                        if(!empty($del_account)) {
                                
                            $_SESSION['success'] = "ลบบัญชีสำเร็จ!";
                            echo "<script>window.location.href='auth/login.php';</script>";
                            exit;
                            
                        } else {
                            whenerror();
                            exit;
                        }   
                        
                    } else {
                        
                        $_SESSION['error'] = "ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง!";
                        echo "<script>window.history.back();</script>";
                        exit;
                    } 
                }
                
                break;
                
            default:
            whenerror();
        }
    }
    
?>
<div class="py-5 pt-3" style="background-color:#f0f8ff;">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">หน้าหลัก</a></li>
                <li class="breadcrumb-item active" aria-current="page">แก้ไขข้อมูลส่วนตัว</li>
            </ol>
        </nav>
        <div class="row mb-4 d-flex justify-content-center">
            <div class="col-sm-5">
                <h2>แก้ไขข้อมูลส่วนตัว</h2>
            </div>
            <div class="col-sm-5 text-end">
                <a class="btn btn-primary" href="index.php"><i class="fa-regular fa-circle-left"></i>&nbsp;กลับ</a>
            </div>
        </div>
        <div class="row gutters-sm justify-content-center">
            <div class="col-md-4 mb-3">
                <div class="card">
                    <div class="card-body pb-4">
                        <div class="d-flex flex-column align-items-center text-center pt-4">
                            <img src="<?php if($teacher[0]['profile']==''){echo 'image/profile/cat.png';}
                            else{echo 'upload/img_teacher/'.$teacher[0]['profile'];}?>" class="img-thumbnail"
                                width="225">
                            <div class="mt-3 pb-4">
                                <h4 class="pb-3"
                                    style="width:280px;white-space:nowrap; overflow:hidden; text-overflow:ellipsis;">
                                    <?php echo $teacher[0]['fname'].' '.$teacher[0]['lname']; ?>
                                </h4>
                                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#profileModal"><i
                                        class="fa-solid fa-pen-to-square"></i>&nbsp;แก้ไขรูปโปรไฟล์</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-7">
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="col-sm-12">
                            <nav class="nav">
                                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                    <button class="nav-link active" id="nav-show-tab" data-bs-toggle="tab"
                                        data-bs-target="#nav-show" type="button" role="tab" aria-controls="nav-show"
                                        aria-selected="true"><b>ดูข้อมูล</b>
                                    </button>
                                    <button class="nav-link" id="nav-edit-tab" data-bs-toggle="tab"
                                        data-bs-target="#nav-edit" type="button" role="tab" aria-controls="nav-edit"
                                        aria-selected="false"><b>แก้ไขข้อมูล</b>
                                    </button>
                                    <button class="nav-link" id="nav-user-tab" data-bs-toggle="tab"
                                        data-bs-target="#nav-user" type="button" role="tab" aria-controls="nav-user"
                                        aria-selected="false"><b>แก้ไขชื่อผู้ใช้</b>
                                    </button>
                                    <button class="nav-link" id="nav-password-tab" data-bs-toggle="tab"
                                        data-bs-target="#nav-password" type="button" role="tab"
                                        aria-controls="nav-password" aria-selected="false"><b>แก้ไขรหัสผ่าน</b>
                                    </button>
                                </div>
                            </nav>
                        </div>
                        <br>
                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="nav-show" role="tabpanel"
                                aria-labelledby="nav-show-tab">
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
                                            data-bs-target="#profiledelModal"><i
                                                class="fa-solid fa-trash-can"></i>&nbsp;ลบบัญชีนี้</button>
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
                                                    <select class="form-select " id="teacher_prefix"
                                                        name="teacher_prefix">
                                                        <option value="">--คำนำหน้า--</option>
                                                        <option value="นาย" <?php if($teacher[0]['prefix']=="นาย"): ?>
                                                            selected="selected" <?php endif; ?>>นาย
                                                        </option>
                                                        <option value="นาง" <?php if($teacher[0]['prefix']=="นาง"): ?>
                                                            selected="selected" <?php endif; ?>>นาง
                                                        </option>
                                                        <option value="นางสาว"
                                                            <?php if($teacher[0]['prefix']=="นางสาว"): ?>
                                                            selected="selected" <?php endif; ?>>นางสาว
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-3 d-flex justify-content-start">
                                            <label for="input" class="col-sm-2 col-form-label">ชื่อ
                                                <span class="text-danger">*</span></label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="teacher_fname"
                                                    name="teacher_fname" placeholder="ชื่อ" required
                                                    value="<?= $teacher[0]['fname'] ?>">
                                            </div>
                                        </div>
                                        <div class="row mb-3 d-flex justify-content-start">
                                            <label for="input" class="col-sm-2 col-form-label">นามสกุล
                                                <span class="text-danger">*</span></label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="teacher_lname"
                                                    name="teacher_lname" placeholder="นามสกุล" required
                                                    value="<?= $teacher[0]['lname'] ?>">
                                            </div>
                                        </div>
                                        <div class="row mb-3 d-flex justify-content-start">
                                            <label for="input" class="col-sm-2 col-form-label">อีเมล์</label>
                                            <div class="col-sm-8">
                                                <input type="email" class="form-control" id="teacher_email"
                                                    name="teacher_email" placeholder="อีเมล์"
                                                    value="<?= $teacher[0]['email'] ?>">
                                            </div>
                                        </div>
                                        <div class="row mb-3 d-flex justify-content-start">
                                            <label for="input" class="col-sm-2 col-form-label">เบอร์โทรศัพท์</label>
                                            <div class="col-sm-8">
                                                <input type="phone" class="form-control" id="teacher_phone"
                                                    name="teacher_phone" placeholder="เบอร์โทรศัพท์"
                                                    value="<?= $teacher[0]['phone'] ?>">
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="col-md-3">
                                            <button type="reset" class="btn btn-warning me-3"><i
                                                    class="fa-solid fa-arrow-rotate-left"></i>
                                                ล้างข้อมูล</button>
                                            <button type="submit" class="btn btn-primary" name="action"
                                                value="teacher_edit2">บันทึกการแก้ไข
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
                                                <input type="text" class="form-control" id="old_username"
                                                    name="old_username" placeholder="ชื่อผู้ใช้เดิม" required>
                                            </div>
                                        </div>
                                        <div class="row mb-3 d-flex justify-content-start">
                                            <label for="input" class="col-sm-2 col-form-label">ชื่อผู้ใช้ใหม่
                                                <span class="text-danger">*</span></label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="new_username"
                                                    name="new_username" placeholder="ชื่อผู้ใช้ใหม่" required
                                                    minlength="6">
                                            </div>
                                        </div>
                                        <div class=" row mb-3 d-flex justify-content-start">
                                            <label for="input" class="col-sm-2 col-form-label">รหัสผ่าน<span
                                                    class="text-danger">*</span></label>
                                            <div class="col-sm-8">
                                                <input type="password" class="form-control" id="verify_password"
                                                    name="verify_password" placeholder="รหัสผ่าน" required>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="col-md-3">
                                            <button type="submit" class="btn btn-primary" name="action"
                                                value="teacher_edit3">บันทึกการแก้ไข
                                                <i class="fa-solid fa-cloud-arrow-up"></i></button>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <!-- *************************************************************************************-->

                            <div class="tab-pane fade" id="nav-password" role="tabpanel"
                                aria-labelledby="nav-password-tab">
                                <div class="ps-3">
                                    <form action="?page=teacher_edit" method="post">
                                        <div class="row mb-3 d-flex justify-content-start">
                                            <label for="input" class="col-sm-2 col-form-label">ชื่อผู้ใช้
                                                <span class="text-danger">*</span></label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="username" name="username"
                                                    placeholder="ชื่อผู้ใช้" required>
                                            </div>
                                        </div>
                                        <div class="row mb-3 d-flex justify-content-start">
                                            <label for="input" class="col-sm-2 col-form-label">รหัสผ่านเดิม
                                                <span class="text-danger">*</span></label>
                                            <div class="col-sm-8">
                                                <input type="password" class="form-control" id="old_password"
                                                    name="old_password" placeholder="รหัสผ่านเดิม" required>
                                            </div>
                                        </div>
                                        <div class="row mb-3 d-flex justify-content-start">
                                            <label for="input" class="col-sm-2 col-form-label">รหัสผ่านใหม่
                                                <span class="text-danger">*</span></label>
                                            <div class="col-sm-8">
                                                <input type="password" class="form-control" id="new_password"
                                                    name="new_password" placeholder="รหัสผ่านใหม่" required
                                                    pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                                                    title="a-Z ต้องมีตัวพิมพ์ใหญ่ ตัวพิมพ์เล็กและตัวเลข(อย่างน้อย 8 ตัวอักษร)">
                                            </div>
                                        </div>
                                        <div class=" row mb-3 d-flex justify-content-start">
                                            <label for="input" class="col-sm-2 col-form-label">ยืนยันรหัสผ่านใหม่<span
                                                    class="text-danger">*</span></label>
                                            <div class="col-sm-8">
                                                <input type="password" class="form-control" id="verify_password"
                                                    name="verify_password" placeholder="ยืนยันรหัสผ่านใหม่" required
                                                    pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                                                    title="a-Z ต้องมีตัวพิมพ์ใหญ่ ตัวพิมพ์เล็กและตัวเลข(อย่างน้อย 8 ตัวอักษร)">
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="col-md-3">
                                            <button type="submit" class="btn btn-primary" name="action"
                                                value="teacher_edit4">บันทึกการแก้ไข
                                                <i class="fa-solid fa-cloud-arrow-up"></i></button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- *************************************************************************************
    ************************************************************************************* -->

                        <div class="modal fade" id="profileModal" tabindex="-1" aria-labelledby="profileModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="profileModalModalLabel">แก้ไขรูปภาพส่วนตัว</h5>
                                    </div>
                                    <form method="post" action="?page=teacher_edit" enctype="multipart/form-data">
                                        <div class="modal-body">
                                            <div class="px-4 text-center">
                                                <input class="form-control" id="teacher_profile" name="teacher_profile"
                                                    type="file" accept="image/*" onchange="readURL(this);">
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
                                                <button type="submit" class="btn btn-primary" name="action"
                                                    value="teacher_edit1">บันทึกการแก้ไข
                                                    <i class="fa-solid fa-cloud-arrow-up"></i></button>
                                                <button type="button" class="btn btn-warning"
                                                    data-bs-dismiss="modal">ยกเลิก</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- *************************************************************************************
    ************************************************************************************* -->

                        <div class="modal fade" id="profiledelModal" tabindex="-1"
                            aria-labelledby="profiledelModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="profiledelModalModalLabel">ลบบัญชี้ผู้ใช้</h5>
                                    </div>
                                    <form method="post" action="?page=teacher_edit" enctype="multipart/form-data">
                                        <div class="modal-body">
                                            <div class="px-4 text-center">
                                                <div class="row mb-3 d-flex justify-content-start">
                                                    <label for="input" class="col-sm-4 col-form-label">ชื่อผู้ใช้
                                                        <span class="text-danger">*</span></label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control" id="del_username"
                                                            name="del_username" placeholder="ชื่อผู้ใช้" required>
                                                    </div>
                                                </div>
                                                <div class="row mb-3 d-flex justify-content-start">
                                                    <label for="input" class="col-sm-4 col-form-label">รหัสผ่าน
                                                        <span class="text-danger">*</span></label>
                                                    <div class="col-sm-8">
                                                        <input type="password" class="form-control" id="del_password"
                                                            name="del_password" placeholder="รหัสผ่านเดิม" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-danger" name="action"
                                                    value="teacher_delete">
                                                    <i class="fa-solid fa-trash-can"></i>&nbsp;ลบบัญชี้ผู้ใช้
                                                </button>
                                                <button type="button" class="btn btn-success"
                                                    data-bs-dismiss="modal">ยกเลิก</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
            $('#preview').attr('src', e.target.result);
            $('#preview').show();
            $('#stored_picture').hide();
        };

        reader.readAsDataURL(input.files[0]);
    } else {
        $('#preview').hide();
    }
}
</script>