<?php

if (!isset($_SESSION['id_teacher'])) {

    $_SESSION['error'] = "กรุณาเข้าสู่ระบบใหม่อีกครั้ง!";
    echo "<script>window.location.href='auth/login.php';</script>";
    exit;
}

if (isset($_GET['subid'])) {

    $subid = $_GET['subid'];
} else {

    $_SESSION['error'] = "เกิดข้อผิดพลาด! ไม่พบข้อมูล!";
    echo "<script> window.history.back()</script>";
    exit;
}

if (isset($_GET['delete_report'])) {

    $delete_report = $_GET['delete_report'];
    $del_rep = $lms->delete('classroom', "id='$delete_report'");

    if (!empty($del_rep)) {

        $_SESSION['success'] = "ลบรายงานนี้สำเร็จ!";
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
                <li class="breadcrumb-item active" aria-current="page">รายงาน</li>
            </ol>
        </nav>
        <div class="row mb-4 d-flex justify-content-center">
            <div class="col-sm-5">
                <h2>รายงาน</h2>
            </div>
            <div class="col-sm-5 text-end">
                <a class="btn btn-primary" href="index.php"><i class="fa-regular fa-circle-left"></i>&nbsp;กลับ</a>
            </div>
        </div>
        <div class="px-5 py-4 bg-light rounded-5 shadow-lg">
            <div class="row">
                <div class="col-lg-12">
                    <div class="main-box clearfix">
                        <table class="table user-list" id="reportTable">
                            <thead>
                                <tr>
                                    <th style="width:10%;"><span>ลำดับ</span></th>
                                    <th style="width:30%;"><span>เวลาเริ่ม</span></th>
                                    <th style="width:30%;"><span>เวลาสิ้นสุด</span></th>
                                    <th style="width:20%;"><span>เวลารวม</span></th>
                                    <th style="width:10%;"><span>ตัวเลือก</span></th>
                                </tr>
                            </thead>
                            <?php
                            $noindex = 0;
                            $report_page = $lms->select('classroom', '*', "id_subject='$subid'");
                            foreach ($report_page as $report_list) {
                                $noindex++;
                            ?>
                                <tr>
                                    <td>
                                        <?= $noindex ?>
                                    </td>
                                    <td>
                                        <?= $report_list['stime'] ?>
                                    </td>
                                    <td>
                                        <?= $report_list['etime'] ?>
                                    </td>
                                    <td>
                                        <?= $report_list['totaltime'] ?>
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-dark dropdown-toggle px-2 px-md-4" data-bs-toggle="dropdown" aria-expanded="false"><b>เลือก</b>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item" href="?page=report_detail&repid=<?= $report_list['id'] ?>&subid=<?= $subid ?>">view</a>
                                                </li>
                                                <li><a class="dropdown-item delete_student" id="<?= $report_list['id'] ?>">delete</a>
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
        $('#reportTable').DataTable();
    });

    $(document).on('click', '.delete_student', function() {
        var id = $(this).attr("id");
        swal.fire({
            title: 'ต้องการลบรายงานนี้ !',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'yes!',
            cancelButtonText: 'no'
        }).then((result) => {
            if (result.value) {
                window.location.href = "?page=report&delete_report=" + id+"&subid=<?= $subid ?>";
            }
        });
    });
</script>