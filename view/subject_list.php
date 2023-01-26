<div class="album py-5 " style="background-color:#f0f8ff;">
    <div class="container">
        <div class="text-center text-md-start">
            <h1>รายชื่อวิชา</h1>
            <a class="btn btn-info px-md-4 rounded-3 border-primary" href="?page=student_list">ดูรายชื่อนักศึกษา</a>
        </div>
        <div class="my-4 my-md-3 text-center text-md-end">
            <a class="btn btn-info px-md-4 rounded-3 border-primary" href="?page=subject_add">
                <i class="fa-solid fa-file-circle-plus"></i>&nbsp;เพิ่มรายวิชา</a>
        </div>
        <div class="p-3 p-md-5 bg-light rounded-5 shadow-lg">
            <div class="navbar mb-3">
                <div class="navbar-brand d-flex align-items-center ms-4">
                    <label for="search">ค้นหารายวิชา</label>
                    <input type="text" class="form form-control ms-2" placeholder="Search" aria-label="Search">
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
                <?php for($i=0;$i<11;$i++){ ?>
                <div class="col">
                    <div class="card shadow-sm">
                        <svg class="bd-placeholder-img card-img-top" width="100%" height="225"
                            xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail"
                            preserveAspectRatio="xMidYMid slice" focusable="false">
                            <title>Placeholder</title>
                            <rect width="100%" height="100%" fill="#55595c"></rect><text x="50%" y="50%" fill="#eceeef"
                                dy=".3em">Thumbnail</text>
                        </svg>

                        <div class="card-body">
                            <p class="card-text">This is a wider card with supporting text below as a natural
                                lead-in to
                                additional content. This content is a little bit longer.</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-sm btn-outline-secondary">View</button>
                                    <button type="button" class="btn btn-sm btn-outline-secondary">Edit</button>
                                </div>
                                <small class="text-muted">9 mins</small>
                            </div>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>