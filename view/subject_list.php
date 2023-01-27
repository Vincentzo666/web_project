<div class="album py-5 " style="background-color:#f0f8ff;">
    <div class="container">
        <div class="text-center text-md-start">
            <h1>รายชื่อวิชา</h1>
            <a class="btn btn-info px-md-4 rounded-3 border-primary" href="?page=student_list">
                <i class="fa-solid fa-address-book"></i>&nbsp;ดูรายชื่อนักศึกษา</a>
        </div>
        <div class="my-4 my-md-3 text-center text-md-end">
            <a class="btn btn-info px-md-4 rounded-3 border-primary" href="?page=subject_add">
                <i class="fa-solid fa-file-circle-plus"></i>&nbsp;เพิ่มรายวิชา</a>
        </div>
        <div class="px-5 py-4 bg-light rounded-5 shadow-lg">
            <div class="navbar mb-3">
                <div class="navbar-brand d-flex align-items-center ms-4">
                    <label for="search">ค้นหารายวิชา</label>
                    <input type="text" class="form form-control ms-2" placeholder="Search..." aria-label="Search">
                </div>
                <div class="dropdown">
                    <a class="dropdown-toggle btn bg-dark text-white show" id="dd_search" data-bs-toggle="dropdown"
                        aria-expanded="false">จัดเรียงตาม</a>
                    <ul class="dropdown-menu" aria-labelledby="dd_search">
                        <li><a class="dropdown-item" href="#">ชื่อ ก-ฮ</a></li>
                        <li><a class="dropdown-item" href="#">วันที่เพิ่ม</a></li>
                        <li><a class="dropdown-item" href="#">วันที่แก้ไข</a></li>
                    </ul>
                </div>
            </div>
            <div class=" row row-cols-1 row-cols-sm-2 row-cols-md-4 g-3">
                <?php 
                $subject_page = $lms->pagination('subject','*',"id_teacher='$id_teacher'",8);
                foreach($subject_page[0] as $subject_list){ 
                    if($subject_list['image']!=''){$img_sj="upload/img_subject/".$subject_list['image'];
                    }else{$img_sj = $lms->getRandomImage();}
                ?>
                <div class="col">
                    <div class="card shadow-sm">
                        <img src="<?= $img_sj?>" style="width: 287px; height: 120px; object-fit: cover;">
                        <div class="card-body">
                            <h6 class="card-text"><?= $subject_list['name'];?></h6>
                            <p><?= $subject_list['detail'];?></p>
                            <div class=" d-flex justify-content-between align-items-center">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-sm btn-outline-success">View</button>
                                    <button type="button" class="btn btn-sm btn-outline-secondary">Edit</button>
                                    <button type="button" class="btn btn-sm btn-outline-danger">Delete</button>
                                </div>
                                <small class="text-muted">9 mins</small>
                            </div>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
            <div class="col-12 pt-4 d-flex justify-content-end">
                <?php echo $subject_page[1];?>
            </div>
        </div>
    </div>
</div>