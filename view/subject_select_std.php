<?php
unset($_SESSION['subid']);

if(isset($_GET['subid'])){
    
    $subid = $_GET['subid'];
    
}

if(isset($_GET['subid'])&&isset($_GET['stdid'])){
    
    $subid = $_GET['subid'];
    $stdid = $_GET['stdid'];

    $add_to_sub = $lms->insert('sub_std',['id_subject'=>$subid,'id_student'=>$stdid,'cr_time'=>$date]);
                            
    if(!empty($add_to_sub)) {
        
        $_SESSION['success'] = "เพิ่มสำเร็จ!";
        echo "<script>window.history.back();</script>";
        exit;
        
    }else {

        whenerror();
        exit;
    }
}

if(isset($_GET['delete_student'])){
    
    $delid = $_GET['delete_student'];
    $del_std = $lms->delete('student',"id='$delid'");

    if(!empty($del_std)) {
                                
        $_SESSION['success'] = "ลบรายชื่อนี้สำเร็จ!";
        echo "<script>window.history.back();</script>";
        exit;
        
    } else {
        
        whenerror();
        exit;
        
    }   
}
?>
<div class="album py-5 " style="background-color:#f0f8ff;">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">หน้าหลัก</a></li>
                <li class="breadcrumb-item"><a href="?page=subject_view&subid=<?= $subid ?>">รายละเอียดวิชา</a></li>
                <li class="breadcrumb-item active" aria-current="page">เพิ่มรายชื่อเข้าชั้นเรียน</li>
            </ol>
        </nav>
        <div class="row mb-4 d-flex justify-content-center">
            <div class="col-sm-5">
                <h2>รายชื่อนักศึกษาที่ไม่ได้อยู่ในวิชานี้</h2>
            </div>
            <div class="col-sm-5 text-end">
                <a class="btn btn-primary" href="?page=subject_view&subid=<?= $subid ?>">
                    <i class="fa-regular fa-circle-left"></i>&nbsp;กลับ</a>
            </div>
        </div>
        <div class="px-5 py-2 bg-light rounded-5 shadow-lg">
            <div class="d-flex justify-content-between pb-4">
                <h4 class="py-3">รายชื่อนักศึกษา</h4>
                <div class="d-flex align-items-center">
                    <a class="btn btn-info  rounded-3 border-primary" href="?page=student_add&subid=<?= $subid ?>">
                        <i class="fa-solid fa-file-circle-plus"></i>&nbsp;เพิ่มรายชื่อนักศึกษา</a>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="main-box clearfix">
                        <table class="table user-list" id="example">
                            <thead>
                                <tr>
                                    <th style="width:7%;"><span>รูปภาพ</span></th>
                                    <th style="width:12%;"><span>Student ID</span></th>
                                    <th style="width:10%;"><span>คำนำหน้า</span></th>
                                    <th style="width:20%;"><span>ชื่อ</span></th>
                                    <th style="width:20%;"><span>นามสกุล</span></th>
                                    <th style="width:21%;"><span>เพิ่มรายชื่อในวิชา</span></th>
                                    <th style="width:10%;" class="text-end"><span>ตัวเลือก</span></th>
                                </tr>
                            </thead>
                            <?php 
                                    $student_page = $lms->select("student LEFT JOIN sub_std ON student.id = sub_std.id_student AND sub_std.id_subject = '$subid'",'student.*','sub_std.id_student IS NULL');
                                    foreach($student_page as $student_list){ 
                                    ?>
                            <tr>
                                <td>
                                    <img src=" upload/img_student/<?= $student_list['std_pic'] ?>"
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
                                    <a class="btn btn-success"
                                        href="?page=subject_select_std&stdid=<?= $student_list['id'] ?>&subid=<?= $subid ?>">เพิ่ม</a>
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-dark dropdown-toggle px-2 px-md-4"
                                            data-bs-toggle="dropdown" aria-expanded="false"><b>เลือก</b>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item"
                                                    href="?page=student_view&id=<?= $student_list['id'] ?>">view</a>
                                            </li>
                                            <li><a class="dropdown-item"
                                                    href="?page=student_edit&subid=<?= $subid ?>&id=<?= $student_list['id'] ?>">edit</a>
                                            </li>
                                            <li><a class="dropdown-item delete_student" id="<?= $student_list['id'] ?>"
                                                    data-name-std="<?= $student_list['fname'].' '.$student_list['lname'] ?>">delete</a>
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
<script>
$(document).ready(function() {
    $(' #example').DataTable();

    $(document).on('click', '.delete_student', function() {
        var id = $(this).attr("id");
        var name_std = $(this).attr("data-name-std");
        swal.fire({
            title: 'ต้องการลบรายชื่อนี้ !',
            text: "ชื่อนักศึกษา : " + name_std,
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'yes!',
            cancelButtonText: 'no'
        }).then((result) => {
            if (result.value) {
                window.location.href = "?page=subject_select_std&delete_student=" + id;
            }
        });
    });
});
</script>