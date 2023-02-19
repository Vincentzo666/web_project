<?php 

    if(!isset($_SESSION['id_teacher'])){

        $_SESSION['error'] = "กรุณาเข้าสู่ระบบใหม่อีกครั้ง!";
        echo "<script>window.location.href='auth/login.php';</script>";
        exit;
        
    }

    if(isset($_GET['subid'])){

        $id = $_GET['subid'];
        
        $subject = $lms->select('subject',"*","id='$id'");
    
    }else{
        $_SESSION['error'] = "เกิดข้อผิดพลาด! ไม่พบข้อมูล!";
        echo "<script> window.history.back()</script>";
        exit;
    }

    if(isset($_POST["action"]) && $_POST["action"]=='subject_edit'){
        
        if (!empty($_POST['id']) && !empty($_POST['subject_id']) && !empty($_POST['subject_name'])) {
            
            $id = mysqli_real_escape_string($lms->dbConnect, trim($_POST['id'])); 
            $subject_id = mysqli_real_escape_string($lms->dbConnect, trim($_POST['subject_id']));
            $subject_name = mysqli_real_escape_string($lms->dbConnect, trim($_POST['subject_name']));
            $subject_detail = mysqli_real_escape_string($lms->dbConnect, trim($_POST['subject_detail']));
            
            $check_subject = $lms->select('subject',"*","id !='$id' AND sub_id='$subject_id'");
            
            if(empty($check_subject)) {
                
                if (!empty($_FILES["subject_img"]["name"])) {

                    $targetDir = "upload/img_subject/";
                    $temp = explode(".", $_FILES["subject_img"]["name"]);
                    $fileName = 'subject-'.$namedate. '.' . end($temp);
                    $targetFilePath = $targetDir . $fileName;
                    $fileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));
                    $allowTypes = array('jpg', 'png', 'jpeg');

                    if (in_array($fileType, $allowTypes)) {
                        
                        if (move_uploaded_file($_FILES["subject_img"]["tmp_name"], $targetFilePath)) {
                            
                            $subject_add = $lms->update('subject',['sub_id'=>$subject_id,'id_teacher'=>$id_teacher,'name'=>$subject_name,'detail'=>$subject_detail,'image'=>$fileName,'up_time'=>$date],"id='$id'");
                            
                            if(!empty($subject_add)) {
                                // echo "<script>console.log('{$fileName}')</script>";
                                $_SESSION['success'] = "แก้ไขรายวิชาสำเร็จ!";
                                echo "<script>window.location.href='?page=subject_list';</script>";
                                exit;
                                
                            }else {
                    
                                $_SESSION['error'] = "เกิดข้อผิดพลาด กรุณาลองใหม่อีกครั้ง!";
                                unlink("upload/img_subject/$fileName");
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
                    
                } else {
                    
                    $subject_add = $lms->update('subject',['sub_id'=>$subject_id,'id_teacher'=>$id_teacher,'name'=>$subject_name,'detail'=>$subject_detail,'up_time'=>$date],"id='$id'");
                    
                    if(!empty($subject_add)) {
                                
                        $_SESSION['success'] = "แก้ไขรายวิชาสำเร็จ!";
                        echo "<script>window.location.href='?page=subject_list';</script>";
                        exit;
                        
                    }else {
            
                        whenerror();
                        exit;
                    }
                }
                
            }else{

                $_SESSION['error'] = "รหัสวิชานี้มีในระบบแล้ว!";
                echo "<script>window.history.back();</script>";
                exit;
                
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
                <li class="breadcrumb-item active" aria-current="page">แก้ไขรายชื่อวิชา</li>
            </ol>
        </nav>
        <div class="row mb-4 d-flex justify-content-center">
            <div class="col-sm-5">
                <h2>เพิ่มรายชื่อวิชา</h2>
            </div>
            <div class="col-sm-5 text-end">
                <a class="btn btn-primary" href="index.php"><i class="fa-regular fa-circle-left"></i>&nbsp;กลับ</a>
            </div>
        </div>

        <div class="d-flex justify-content-center">
            <div class="py-3 p-md-5 bg-light rounded-5 shadow-lg col-md-8">
                <form action="?page=subject_edit&subid=<?= $subject[0]['id'] ?>" method="post" class="px-0 pt-3" enctype="multipart/form-data">
                    <div class="row mb-3 d-flex justify-content-center">
                        <label for="input" class="col-sm-2 col-form-label">รหัสวิชา
                            <span class="text-danger">*</span>
                        </label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="subject_id" name="subject_id"
                                placeholder="รหัสวิชา" required value="<?= $subject[0]['sub_id'] ?>">
                        </div>
                    </div>
                    <div class="row mb-3 d-flex justify-content-center">
                        <label for="input" class="col-sm-2 col-form-label">ชื่อวิชา
                            <span class="text-danger">*</span></label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="subject_name" name="subject_name"
                                placeholder="ชื่อวิชา" required value="<?= $subject[0]['name'] ?>">
                        </div>
                    </div>
                    <div class="row mb-3 d-flex justify-content-center">
                        <label for="input" class="col-sm-2 col-form-label">คำอธิบาย</label>
                        <div class="col-sm-8">
                            <textarea type="text" class="form-control" id="subject_detail" name="subject_detail"
                                rows="4" placeholder="คำอธิบาย"><?= $subject[0]['detail'] ?></textarea>
                        </div>
                    </div>
                    <div class="row mb-3 d-flex justify-content-center ">
                        <label for="input" class="col-sm-2 col-form-label">รูปภาพ</label>
                        <div class="col-sm-8">
                            <input type="file" class="form-control" id="subject_img" name="subject_img"
                                onchange="readURL(this);">
                            <br>
                            <img id='preview' style="display:none; width: 300px; height: 150px; object-fit: cover;">
                            <div id="stored_picture" class="pb-3">
                                <?php if ($subject[0]['image']!='') { ?>

                                <img src="upload/img_subject/<?= $subject[0]['image'] ?>"
                                    style="width: 300px; height: 150px; object-fit: cover;">

                                <?php } ?>
                            </div>
                        </div>
                    </div>

                    <div class=" row">
                        <div class="col-md-11">
                            <div class="d-flex justify-content-end">
                                <button type="reset" class="btn btn-warning me-3"><i
                                        class="fa-solid fa-arrow-rotate-left"></i>
                                    ล้างข้อมูล</button>
                                <button type="submit" class="btn btn-primary" name="action"
                                    value="subject_edit">บันทึกการแก้ไข
                                    <i class="fa-solid fa-cloud-arrow-up"></i></button>
                                <input type="hidden" name="id" id="id" value="<?= $subject[0]['id'] ?>">
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
            $('#stored_picture').hide();
        };

        reader.readAsDataURL(input.files[0]);
    } else {
        $('#preview').hide();
        $('#stored_picture').show();
    }

}
</script>