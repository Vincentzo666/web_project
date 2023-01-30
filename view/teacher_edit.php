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
                
                $student_prefix = mysqli_real_escape_string($lms->dbConnect, trim($_POST['teacher_prefix']));
                $teacher_fname = mysqli_real_escape_string($lms->dbConnect, trim($_POST['teacher_fname']));
                $teacher_lname = mysqli_real_escape_string($lms->dbConnect, trim($_POST['teacher_lname']));
                $teacher_email = mysqli_real_escape_string($lms->dbConnect, trim($_POST['teacher_email']));
                $teacher_phone = mysqli_real_escape_string($lms->dbConnect, trim($_POST['teacher_phone']));

                if (!empty($_POST['teacher_fname'])&& !empty($_POST['teacher_lname'])) {
                    
                    $check_email1 = $lms->select('teacher',"email","id='$id_teacher'");
                    
                    if($check_email1[0]['email'] == $teacher_email) {

                        $teacher_edit2 = $lms->update('teacher',['prefix'=>$student_prefix,'fname'=>$teacher_fname,'lname'=>$teacher_lname,'email'=>$teacher_email,'phone'=>$teacher_phone,'up_time'=>$date],"id='$id_teacher'"); 
                        
                        if(!empty($teacher_edit2)) {
                            
                            $_SESSION['success'] = "แก้ไขสำเร็จ!";
                            echo "<script>window.location.href='?page=teacher_edit';</script>";
                            exit;
                            
                        } else {
                            whenerror();
                            exit;
                        }
                    
                    }else{
                        
                        $check_email2 = $lms->select('teacher',"email","email='$teacher_email'");
                        
                        if(!empty($check_email2)) {
                        
                            $_SESSION['error'] = "อีเมลล์นี้มีในระบบแล้ว!";
                            echo "<script>window.history.back();</script>";
                            exit;
                            
                        }else{
                            
                            $teacher_edit2 = $lms->update('teacher',['fname'=>$teacher_fname,'lname'=>$teacher_lname,'email'=>$teacher_email,'phone'=>$teacher_phone,'up_time'=>$date],"id='$id_teacher'"); 
                            
                            if(!empty($teacher_edit2)) {
                                
                                $_SESSION['success'] = "แก้ไขสำเร็จ!";
                                echo "<script>window.location.href='?page=teacher_edit';</script>";
                                exit;
                                
                            } else {
                                whenerror();
                                exit;
                            }
                        } 
                    }
                    
                }else {
                    whenerror();
                    exit;
                }
                break;
                
            case "teacher_edit3":
                
                $old_username = mysqli_real_escape_string($lms->dbConnect, trim($_POST['old_username']));
                $new_username = mysqli_real_escape_string($lms->dbConnect, trim($_POST['new_username']));
                $verify_password = mysqli_real_escape_string($lms->dbConnect, trim($_POST['verify_password']));
                $en_verify = $lms->encode($verify_password);

                if (!empty($_POST['old_username']) && !empty($_POST['new_username'])
                && !empty($_POST['verify_password'])) {
                    
                    $check_new = $lms->select('teacher',"*","username='$new_username'");
                    
                    if(!empty($check_new)) {
                        
                        $_SESSION['error'] = "ชื่อผู้ใช้นี้มีในระบบแล้ว!";
                        echo "<script>window.history.back();</script>";
                        exit;
                        
                    }else{
                        
                        $check_old = $lms->select('teacher',"*","id='$id_teacher' AND username='$old_username'");
                        
                        if(!empty($check_old)){
                            
                            $check_verify = $lms->select('teacher',"*","id='$id_teacher' AND password='$en_verify'");
                            
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
                                $_SESSION['error'] = "รหัสผ่านไม่ถูกต้อง!";
                                echo "<script>window.history.back();</script>";
                                exit;
                            }
                            
                        }else{
                            $_SESSION['error'] = "ชื่อผู้ใช้เดิมไม่ถูกต้อง!";
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
                
                $old_password = mysqli_real_escape_string($lms->dbConnect, trim($_POST['old_password']));
                $new_password = mysqli_real_escape_string($lms->dbConnect, trim($_POST['new_password']));
                $verify_password = mysqli_real_escape_string($lms->dbConnect, trim($_POST['verify_password']));
                $en_old = $lms->encode($old_password);
                $en_new = $lms->encode($new_password);
                $en_verify = $lms->encode($verify_password);

                if (!empty($_POST['old_password']) && !empty($_POST['new_password'])
                && !empty($_POST['verify_password'])) {
                    
                    if($en_new == $en_verify) {
                        
                        $check_old = $lms->select('teacher',"*","id='$id_teacher' AND password='$en_old'");
                        
                        if(!empty($check_old)){

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
                        $_SESSION['error'] = "รหัสผ่านเดิมไม่ถูกต้อง!";
                        echo "<script>window.history.back();</script>";
                        exit;
                    } 
                    
                }else {
                    whenerror();
                    exit;
                }
                break;

            case "teacher_delete" :
                
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
                    <div class="card-body">
                        <div class="d-flex flex-column align-items-center text-center">
                            <img src="<?php if($teacher[0]['profile']==''){echo 'image/profile/cat.png';}
                            else{echo 'upload/img_teacher/'.$teacher[0]['profile'];}?>" class="img-thumbnail"
                                width="225">
                            <div class="mt-3">
                                <h4>
                                    <?php echo $teacher[0]['fname'].' '.$teacher[0]['lname']; ?>
                                </h4>
                                <button class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#profileModal">แก้ไขรูปโปรไฟล์</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-7">
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="col-sm-12">
                            <nav>
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
                        <?php include('inc/account.php'); ?>
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