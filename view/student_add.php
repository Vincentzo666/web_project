<?php 
    if(isset($_POST["action"]) && $_POST["action"]=='student_add'){
        
        if (!empty($_POST['student_id']) && !empty($_POST['student_fname'])
        && !empty($_POST['student_lname'])) {

            $student_id = mysqli_real_escape_string($lms->dbConnect, trim($_POST['student_id'])); 
            $student_prefix = mysqli_real_escape_string($lms->dbConnect, trim($_POST['student_prefix']));
            $student_fname = mysqli_real_escape_string($lms->dbConnect, trim($_POST['student_fname']));
            $student_lname = mysqli_real_escape_string($lms->dbConnect, trim($_POST['student_lname']));
            $student_email = mysqli_real_escape_string($lms->dbConnect, trim($_POST['student_email']));
            $student_phone = mysqli_real_escape_string($lms->dbConnect, trim($_POST['student_phone']));

            $check_student = $lms->select('student',"*","std_id='$student_id'");
            
            if(!empty($check_student)) {
                
                $_SESSION['error'] = "รหัสผู้เรียนนี้มีในระบบแล้ว!";
                echo "<script>window.history.back();</script>";
                exit;
                
            }else{
            
                if (!empty($_FILES["student_img"]["name"])) {

                    $targetDir = "upload/img_student/";
                    $temp = explode(".", $_FILES["student_img"]["name"]);
                    $fileName = 'student-'.$namedate. '.' . end($temp);
                    $targetFilePath = $targetDir . $fileName;
                    $fileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));
                    $allowTypes = array('jpg', 'png', 'jpeg');

                    if (in_array($fileType, $allowTypes)) {
                        
                        if (move_uploaded_file($_FILES["student_img"]["tmp_name"], $targetFilePath)) {
                            
                            $student_add = $lms->insert('student',['std_id'=>$student_id,'prefix'=>$student_prefix,'fname'=>$student_fname,'lname'=>$student_lname,'email'=>$student_email,'phone'=>$student_phone,'std_pic'=>$fileName,'cr_time'=>$date]);
                            
                            if(!empty($student_add)) {
                                
                                $_SESSION['success'] = "เพิ่มรายชื่อผู้เรียนสำเร็จ!";
                                echo "<script>window.location.href='?page=student_list';</script>";
                                exit;
                                
                            }else {
                                $_SESSION['error'] = "เกิดข้อผิดพลาด กรุณาลองใหม่อีกครั้ง!";
                                unlink("upload/img_student/$fileName");
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
            }  
             
        }else{
            whenerror();
            exit;
        }
        
    }
?>
<div class="py-5 pt-3" style="background-color:#f0f8ff;">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">หน้าหลัก</a></li>
                <li class="breadcrumb-item"><a href="?page=student_list">รายชื่อชื่อผู้เรียน</a></li>
                <li class="breadcrumb-item active" aria-current="page">เพิ่มรายชื่อผู้เรียน</li>
            </ol>
        </nav>
        <div class="row mb-4 d-flex justify-content-center">
            <div class="col-sm-5">
                <h2>เพิ่มรายชื่อผู้เรียน</h2>
            </div>
            <div class="col-sm-5 text-end">
                <a class="btn btn-primary" href="?page=student_list"><i
                        class="fa-regular fa-circle-left"></i>&nbsp;กลับ</a>
            </div>
        </div>

        <div class="d-flex justify-content-center">
            <div class="py-3 p-md-5 bg-light rounded-5 shadow-lg col-md-8">
                <form action="?page=student_add" method="post" class="px-0 pt-3" enctype="multipart/form-data">
                    <div class="row mb-3 d-flex justify-content-center">
                        <label for="input" class="col-sm-2 col-form-label">เพศ</label>
                        <div class="col-sm-8">
                            <div class="col-3">
                                <select class="form-select " id="student_prefix" name="student_prefix">
                                    <option value="">--คำนำหน้า--</option>
                                    <option value="นาย">นาย</option>
                                    <option value="นาง">นาง</option>
                                    <option value="นางสาว">นางสาว</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3 d-flex justify-content-center">
                        <label for="input" class="col-sm-2 col-form-label">ชื่อ
                            <span class="text-danger">*</span></label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="student_fname" name="student_fname"
                                placeholder="ชื่อ" required>
                        </div>
                    </div>
                    <div class="row mb-3 d-flex justify-content-center">
                        <label for="input" class="col-sm-2 col-form-label">นามสกุล
                            <span class="text-danger">*</span></label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="student_lname" name="student_lname"
                                placeholder="นามสกุล" required>
                        </div>
                    </div>
                    <div class="row mb-3 d-flex justify-content-center">
                        <label for="input" class="col-sm-2 col-form-label">รหัสผู้เรียน
                            <span class="text-danger">*</span></label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="student_id" name="student_id"
                                placeholder="รหัสผู้เรียน" required>
                        </div>
                    </div>
                    <div class="row mb-3 d-flex justify-content-center">
                        <label for="input" class="col-sm-2 col-form-label">อีเมล์</label>
                        <div class="col-sm-8">
                            <input type="email" class="form-control" id="student_email" name="student_email"
                                placeholder="อีเมล์">
                        </div>
                    </div>
                    <div class="row mb-3 d-flex justify-content-center">
                        <label for="input" class="col-sm-2 col-form-label">เบอร์โทรศัพท์</label>
                        <div class="col-sm-8">
                            <input type="phone" class="form-control" id="student_phone" name="student_phone"
                                placeholder="เบอร์โทรศัพท์">
                        </div>
                    </div>
                    <div class="row mb-3 d-flex justify-content-center ">
                        <label for="input" class="col-sm-2 col-form-label">รูปภาพ<span
                                class="text-danger">*</span></label>
                        <div class="col-sm-8">
                            <input type="file" class="form-control" id="student_img" name="student_img"
                                onchange="readURL(this);" required>
                            <br><img id='preview' style="display:none; width: 300px; height: 300px; object-fit: cover;">
                        </div>
                    </div>

                    <div class=" row">
                        <div class="col-md-11">
                            <div class="d-flex justify-content-end">
                                <button type="reset" class="btn btn-warning me-3"><i
                                        class="fa-solid fa-arrow-rotate-left"></i>
                                    ล้างข้อมูล</button>
                                <button type="submit" class="btn btn-primary" name="action" value="student_add">บันทึก
                                    <i class="fa-solid fa-cloud-arrow-up"></i></button>
                            </div>
                        </div>
                    </div>
                </form>
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
        };

        reader.readAsDataURL(input.files[0]);
    } else {
        $('#preview').hide();
    }

}
</script>