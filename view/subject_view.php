<?php

    unset($_SESSION['subid']);
    unset($_SESSION['backp']);

    if(isset($_GET['subid'])){

        $subid = $_GET['subid'];
        
        $subject = $lms->select('subject',"*","id='$subid'");

    }
    
    if(isset($_GET['delete_student'])){
    
        $delid = $_GET['delete_student'];
        $del_std = $lms->delete('sub_std',"id='$delid'");
    
        if(!empty($del_std)) {
                                    
            $_SESSION['success'] = "นำรายชื่อนี้ออกสำเร็จ!";
            echo "<script>window.history.back();</script>";
            exit;
            
        } else {
            
            whenerror();
            exit;
            
        }   
    }

    if(isset($_GET['show_std'])){

        $idsh = $_GET['show_std'];
        
        $show_std = $lms->select('student',"*","id='$idsh'");        

    }

?>
<div class="py-5 pt-3" style="background-color:#f0f8ff;">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">หน้าหลัก</a></li>
                <li class="breadcrumb-item active" aria-current="page">รายละเอียดวิชา</li>
            </ol>
        </nav>
        <div class="row mb-4 d-flex justify-content-center">
            <div class="col-sm-5">
                <h2>รายละเอียดวิชา</h2>
            </div>
            <div class="col-sm-5 text-end">
                <a class="btn btn-primary" href="index.php"><i class="fa-regular fa-circle-left"></i>&nbsp;กลับ</a>
            </div>
        </div>
        <div class="row gutters-sm justify-content-center">
            <div class="col-md-3 mb-3">
                <div class="card">
                    <div class="card-body pb-4">
                        <div class="d-flex flex-column align-items-center text-center pt-4">
                            <img src="<?php if($subject[0]['image']==''){echo $lms->getRandomImage();;}
                            else{echo 'upload/img_subject/'.$subject[0]['image'];}?>"
                                style=" width: 250px; height: 125px; object-fit: cover;">
                            <div class="col-sm-12 mt-3 ps-3 align-items-center text-start">
                                <hr>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <h6 class="mb-0">รหัสวิชา</h6>
                                    </div>
                                    <div class="col-sm-8 text-secondary">
                                        <?= $subject[0]['sub_id'] ?>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <h6 class="mb-0">ชื่อวิชา</h6>
                                    </div>
                                    <div class="col-sm-8 text-secondary">
                                        <?= $subject[0]['name'] ?>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <h6 class="mb-0">คำอธิบายรายวิชา</h6>
                                    </div>
                                    <div class="col-sm-8 text-secondary">
                                        <?= $subject[0]['detail'] ?>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <h6 class="mb-0">ผู้ดูแล</h6>
                                    </div>
                                    <div class="col-sm-8 text-secondary">
                                        <?=  $_SESSION['name_teacher'] ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="col-sm-12">
                            <div class="d-flex justify-content-between pb-4">
                                <h4 class="py-3">นักศึกษาในรายวิชา</h4>
                                <div class="d-flex align-items-center">
                                    <a class="btn btn-info  rounded-3 border-primary"
                                        href="?page=subject_select_std&subid=<?= $subject[0]['id'] ?>">
                                        <i class="fa-solid fa-file-circle-plus"></i>&nbsp;เพิ่มรายชื่อเข้าชั้นเรียน</a>
                                </div>
                            </div>
                            <table class="table user-list" id="example">
                                <thead>
                                    <tr>
                                        <th style="width:13%;"><span>รูปภาพ</span></th>
                                        <th style="width:15%;"><span>รหัสนักศึกษา</span></th>
                                        <th style="width:10%;"><span>คำนำหน้า</span></th>
                                        <th style="width:26%;"><span>ชื่อ</span></th>
                                        <th style="width:26%;"><span>นามสกุล</span></th>
                                        <th style="width:10%;" class="text-end"><span>ตัวเลือก</span></th>
                                    </tr>
                                </thead>
                                <?php 
                                    $student_page = $lms->select('student JOIN sub_std ON student.id = sub_std.id_student','*',"sub_std.id_subject='$subid' ORDER BY fname ASC");
                                    foreach($student_page as $student_list){ 
                                    ?>
                                <tr>
                                    <td>
                                        <img src="upload/img_student/<?= $student_list['std_pic'] ?>"
                                            style=" width: 100px; height: 100px; object-fit: cover;">
                                    </td>
                                    <td>
                                        <?= $student_list['std_id'] ?>
                                    </td>
                                    <td>
                                        <?= $student_list['prefix'] ?>
                                    </td>
                                    <td>
                                        <?= $student_list['fname'] ?>
                                    </td>
                                    <td>
                                        <?= $student_list['lname'] ?>
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-dark btn-md dropdown-toggle"
                                                data-bs-toggle="dropdown" aria-expanded="false"><b>เลือก</b>
                                            </button>
                                            <ul class="dropdown-menu">
<<<<<<< HEAD
                                                <li>
                                                    <a class="dropdown-item"
                                                        href="?page=subject_view&subid=<?= $subid ?>&show_std=<?= $student_list['id_student'] ?>">view</a>
=======
                                                <li><a class="dropdown-item stdview" id="<?= $student_list['id_student'] ?>"
                                                        data-bs-toggle="modal" data-bs-target="#studentModal">view</a>
                                                </li>
                                                <li><a class="dropdown-item" 
                                                     href="?page=student_train&id=<?= $student_list['id_student'] ?>">train</a>
>>>>>>> parent of 1d98f7a (success)
                                                </li>
                                                <li><a class="dropdown-item"
                                                        href="?page=student_edit&id=<?= $student_list['id_student'] ?>&backp=<?= $subid ?>">edit</a>
                                                </li>
                                                <li><a class="dropdown-item delete_student"
                                                        id="<?= $student_list['id'] ?>"
                                                        data-name-std="<?= $student_list['fname'].' '.$student_list['lname'] ?>">delete
                                                        from class</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                <?php } ?>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
$(document).ready(function() {

    $(' #example').DataTable();

    $(document).on('click', '.delete_student', function() {
        var id = $(this).attr("id");
        var name_std = $(this).attr("data-name-std");
        swal.fire({
            title: 'ต้องการนำรายชื่อนี้ออก !',
            text: "ชื่อนักศึกษา : " + name_std,
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'yes!',
            cancelButtonText: 'no'
        }).then((result) => {
            if (result.value) {
                window.location.href = "?page=subject_view&delete_student=" + id;
            }
        });
    });

    $(document).on('click', '.dmbtn', function() {

        window.history.back();
    });

    function stdshow() {

        $('#studentModal').modal('show');

    }

    $('#studentModal').modal({
        backdrop: 'static',
        keyboard: false
    })

    <?php if(isset($_GET['show_std'])){?>

    $('#studentModal').modal('show');


    <?php } ?>
});
</script>
<?php include('view/student_view.php') ?>