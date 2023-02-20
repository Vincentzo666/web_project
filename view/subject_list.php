<?php 

    if(!isset($_SESSION['id_teacher'])){

        $_SESSION['error'] = "กรุณาเข้าสู่ระบบใหม่อีกครั้ง!";
        echo "<script>window.location.href='auth/login.php';</script>";
        exit;
        
    }

    $_SESSION['sx']='name ASC';
    $sqlx = '';

    if(isset($_POST['search'])){
        $input_search = $_POST['search'];
        $_SESSION['keyword_subject'] = $input_search;
        $_SESSION['subject_sx'] = " AND name LIKE '%$input_search%'";
        
    }

    if(!isset($_SESSION['keyword_subject'])){
        $_SESSION['keyword_subject']='';
    }

    if(isset($_SESSION['subject_sx'])){
        $sqlx = $_SESSION['subject_sx'];
    }

    if(isset($_GET['delete_subject'])){
        
        $id = $_GET['delete_subject'];
        $del_std = $lms->delete('subject',"id='$id'");

        if(!empty($del_std)) {
                                    
            $_SESSION['success'] = "ลบรายวิชานี้สำเร็จ!";
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
        <div class="text-center text-md-start">
            <h1>รายชื่อวิชา</h1>
            <a class="btn btn-info px-md-4 rounded-3 border-primary" href="?page=student_list">
                <i class="fa-solid fa-address-book"></i>&nbsp;ดูรายชื่อนักศึกษา</a>
        </div>
        <div class="my-4 my-md-3 text-center text-md-end">
            <a class="btn btn-info px-md-4 rounded-3 border-primary" href="?page=subject_add">
                <i class="fa-solid fa-file-circle-plus"></i>&nbsp;เพิ่มรายชื่อวิชา</a>
        </div>
        <div class="px-5 py-4 bg-light rounded-5 shadow-lg">
            <div class="navbar mb-3">
                <div class="navbar-brand ms-4 d-flex justify-content-start">
                    <form action="" method="post">
                        <div class="d-flex justify-content-start">
                            <label for="search" class="pt-1">ค้นหารายวิชา</label>
                            <input type="search" class="form form-control mx-2" id="search" name="search"
                                placeholder="Search..." aria-label="Search">
                            <button type="submit" class="btn btn-primary">ค้นหา/ รีเซ็ต</button>
                        </div>
                    </form>
                    <div class="d-flex justify-content-start ps-2">
                        <h5 class="mb-0 pt-2 ps-3"
                            style="width:350px;white-space:nowrap; overflow:hidden; text-overflow:ellipsis;">
                            <?php if($_SESSION['keyword_subject']!=''){echo 'ผลการค้นหาของ '.$_SESSION['keyword_subject'];} ?>
                        </h5>
                    </div>
                </div>
                <div class="dropdown">
                    <a class="dropdown-toggle btn bg-dark text-white show" id="dd_search" data-bs-toggle="dropdown"
                        aria-expanded="false">จัดเรียงตาม</a>
                    <ul class="dropdown-menu" aria-labelledby="dd_search">
                        <li>
                            <a class="dropdown-item" href="index.php?sx=name+ACS">ชื่อ ก-ฮ(ค่าเริ่มต้น)</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="index.php?sx=name+DESC">ชื่อ ฮ-ก</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="index.php?sx=cr_time+DESC">วันที่เพิ่ม
                                (ใหม่-เก่า)</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="index.php?sx=cr_time+ASC">วันที่เพิ่ม (เก่า-ใหม่)</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="index.php?sx=up_time+DESC">วันที่แก้ไข (ล่าสุด)</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class=" row row-cols-1 row-cols-sm-2 row-cols-md-4 g-3">
                <?php 
                $subject_page = $lms->pagination('subject','*',"id_teacher='$id_teacher'".$sqlx,8);
                foreach($subject_page[0] as $subject_list){ 
                    if($subject_list['image']!=''){$img_sj="upload/img_subject/".$subject_list['image'];
                    }else{$img_sj = $lms->getRandomImage();}
                ?>
                <div class=" col">
                    <div class="card shadow-sm" style="overflow:hidden;">
                        <img src="<?= $img_sj?>" style="width: 287px; height: 120px; object-fit: cover;">
                        <div class="card-body" style="height: 180px;">
                            <h6 class="card-text fw-bold"
                                style="height:20px;white-space:nowrap; overflow:hidden; text-overflow:ellipsis;">
                                <?= $subject_list['name'];?>
                            </h6>
                            <?php 
                            if($subject_list['detail']==''){
                                echo '<p class="text-muted" style="height:72px;">คำอธิบายรายวิชา...</p>';
                            }else{
                                echo '<p style="height:72px;display: -webkit-box;-webkit-line-clamp: 3;-webkit-box-orient: vertical;overflow: hidden;">
                                '.$subject_list['detail'].'</p>';
                            }?>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="btn-group">
                                    <a type="button" class="btn btn-sm btn-outline-success px-2 "
                                        href="?page=subject_view&subid=<?= $subject_list['id'] ?>">view</a>
                                    <a type="button" class="btn btn-sm btn-outline-primary px-2 "
                                        href="?page=classroom&subid=<?= $subject_list['id'] ?>">start</a>
                                    <a type="button" class="btn btn-sm btn-outline-secondary px-2 "
                                        href="?page=report&subid=<?= $subject_list['id'] ?>">report</a>
                                    <a type="button" class="btn btn-sm btn-outline-warning px-2 "
                                        href="?page=subject_edit&subid=<?= $subject_list['id'] ?>">edit</a>
                                    <a type="button" class="btn btn-sm btn-outline-danger px-2 delete_subject"
                                        id="<?= $subject_list['id'] ?>"
                                        data-name-sub="<?= $subject_list['name'] ?>">delete</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
            <div class="col-12 pt-5 d-flex justify-content-end">
                <?php echo $subject_page[1];?>
            </div>
        </div>
    </div>
</div>
<script>
$(document).ready(function() {

    $(document).on('click', '.delete_subject', function() {
        var id = $(this).attr("id");
        var name_sub = $(this).attr("data-name-sub");
        swal.fire({
            title: 'ต้องการลบรายวิชานี้ !',
            text: "ชื่อวิชา : " + name_sub,
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'yes!',
            cancelButtonText: 'no'
        }).then((result) => {
            if (result.value) {
                window.location.href = "?page=subject_list&delete_subject=" + id;
            }
        });
    });
});
</script>