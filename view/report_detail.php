<?php

if (!isset($_SESSION['id_teacher'])) {

    $_SESSION['error'] = "กรุณาเข้าสู่ระบบใหม่อีกครั้ง!";
    echo "<script>window.location.href='auth/login.php';</script>";
    exit;
}

if (isset($_GET['repid'])&&isset($_GET['subid'])) {

    $repid = $_GET['repid'];
    $subid = $_GET['subid'];

} else {

    $_SESSION['error'] = "เกิดข้อผิดพลาด! ไม่พบข้อมูล!";
    echo "<script> window.history.back()</script>";
    exit;
}

if (isset($_GET['delete_repstd'])) {

    $delete_repstd = $_GET['delete_repstd'];
    $del_repstd = $lms->delete('checkin', "id='$delete_repstd'");

    if (!empty($del_repstd)) {

        $_SESSION['success'] = "นำรายชื่อออกสำเร็จ!";
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
                <li class="breadcrumb-item"><a href="?page=report.php">รายงาน</a></li>
                <li class="breadcrumb-item active" aria-current="page">รายละเอียดรายงาน</li>
            </ol>
        </nav>
        <div class="row mb-4 d-flex justify-content-center">
            <div class="col-sm-5">
                <h2>รายงานการเข้าเรียน</h2>
            </div>
            <div class="col-sm-5 text-end">
                <a class="btn btn-primary" href="?page=report&subid=<?= $subid ?>"><i class="fa-regular fa-circle-left"></i>&nbsp;กลับ</a>
            </div>
        </div>
        <div class="px-5 py-4 bg-light rounded-5 shadow-lg">
            <div class="row">
                <div class="col-lg-12">
                    <div class="main-box clearfix">
                        <table class="table user-list" id="reportdtTable">
                            <thead>
                                <tr>
                                    <th style="width:10%;"><span>ลำดับ</span></th>
                                    <th style="width:20%;"><span>รหัสนักศึกษา</span></th>
                                    <th style="width:10%;"><span>คำนำหน้า</span></th>
                                    <th style="width:25%;"><span>ชื่อ</span></th>
                                    <th style="width:25%;"><span>นามสกุล</span></th>
                                    <th style="width:10%;"><span>ตัวเลือก</span></th>
                                </tr>
                            </thead>
                            <?php
                            $noindex = 0;
                            $reportdt_page = $lms->select('student s JOIN checkin c  ON s.id = c.id_std', 'c.id as thisid,id_std,std_id,prefix,fname,lname', "c.id_croom ='$repid'");
                            foreach ($reportdt_page as $reportdt_list) {
                                $noindex++;
                            ?>
                                <tr>
                                    <td>
                                        <?= $noindex ?>
                                    </td>
                                    <td>
                                        <?= $reportdt_list['std_id'] ?>
                                    </td>
                                    <td>
                                        <?= $reportdt_list['prefix'] ?>
                                    </td>
                                    <td>
                                        <?= $reportdt_list['fname'] ?>
                                    </td>
                                    <td>
                                        <?= $reportdt_list['lname'] ?>
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-dark dropdown-toggle px-2 px-md-4" data-bs-toggle="dropdown" aria-expanded="false"><b>เลือก</b>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item stdview" id="<?= $reportdt_list['id_std'] ?>" data-bs-toggle="modal" data-bs-target="#studentModal">view</a>
                                                </li>
                                                <li><a class="dropdown-item delete_checkin"
                                                        id="<?= $reportdt_list['thisid'] ?>"
                                                        data-name-std="<?= $reportdt_list['fname'].' '.$reportdt_list['lname'] ?>">delete
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
<script>
    $(document).ready(function() {
        $('#reportdtTable').DataTable();
    });

    $(document).on('click', '.delete_checkin', function() {
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
                window.location.href = "?page=report_detail&delete_repstd=" + id +"&repid=<?= $repid ?>";
            }
        });
    });

    $(document).on('click', '.stdview', function() {
        var id = $(this).attr("id");

        if (id != "") {
            $.ajax({
                type: "POST",
                url: "http://localhost/web_project/php/ajax.php",
                data: {
                    stdview: id
                },
                success: function(response) {
                    var jsonData = JSON.parse(response);
                    if (jsonData.success == "1") {

                        $('#result1').attr("src","upload/img_student/"+jsonData.result1);
                        $('#result2').html(jsonData.result2);
                        $('#result3').html(jsonData.result3);
                        $('#result4').html(jsonData.result4);
                        $('#result5').html(jsonData.result5);
                        $('#result6').html(jsonData.result6);
                        $('#result7').html(jsonData.result7);

                    } else if (jsonData.success == "2") {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: 'ไม่พบข้อมูลนี้',
                            showConfirmButton: true,
                            timer: '5000'
                        })

                    } else {
                        console.log("no value")
                    }
                }
            });
        }
    });
</script>
<?php include('view/student_view.php') ?>