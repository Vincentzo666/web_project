<div class="album py-5 " style="background-color:#f0f8ff;">
    <div class="container">
        <div class="text-center text-md-start">
            <h1>รายชื่อนักศึกษา</h1>
            <a class="btn btn-info px-md-4 rounded-3 border-primary" href="?page=subject_list">
                <i class="fa-solid fa-address-book"></i>&nbsp;ดูรายชื่อวิชา</a>
        </div>
        <div class="my-4 my-md-3 text-center text-md-end">
            <a class="btn btn-info px-md-4 rounded-3 border-primary" href="?page=student_add">
                <i class="fa-solid fa-file-circle-plus"></i>&nbsp;เพิ่มรายชื่อนักศึกษา</a>
        </div>
        <div class="px-5 py-4 bg-light rounded-5 shadow-lg">
            <div class="row">
                <div class="col-lg-12">
                    <div class="main-box clearfix">
                        <div>
                            <table class="table user-list" id="example">
                                <thead>
                                    <tr>
                                        <th style="width:7%;"><span>รูปภาพ</span></th>
                                        <th style="width:12%;"><span>Student ID</span></th>
                                        <th style="width:10%;"><span>คำนำหน้า</span></th>
                                        <th style="width:20%;"><span>ชื่อ</span></th>
                                        <th style="width:20%;"><span>นามสกุล</span></th>
                                        <th style="width:21%;"><span>Email</span></th>
                                        <th style="width:10%;" class="text-end"><span>ตัวเลือก</span></th>
                                    </tr>
                                </thead>
                                <?php 
                                    $student_page = $lms->select('student ORDER BY fname ASC','*');
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
                                        <?= $student_list['email'] ?>
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-dark dropdown-toggle px-2 px-md-4"
                                                data-bs-toggle="dropdown" aria-expanded="false"><b>เลือก</b>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item" target="_blank">รายละเอียด</a>
                                                </li>
                                                <li><a class="dropdown-item">แก้ไข</a>
                                                </li>
                                                <li><a class="dropdown-item deletequoin">ลบ</a></li>
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
});
</script>