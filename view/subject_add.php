<div class="py-5 pt-3" style="background-color:#f0f8ff;">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">หน้าหลัก</a></li>
                <li class="breadcrumb-item active" aria-current="page">เพิ่มรายชื่อวิชา</li>
            </ol>
        </nav>
        <div class="text-center text-md-start mb-5 mt-4">
            <h2>เพิ่มรายชื่อวิชา</h2>
        </div>
        <div class="d-flex justify-content-center">
            <div class="p-3 p-md-5 bg-light rounded-5 shadow-lg col-md-8">
                <form action="" method=" post" name="" id="" class="p-5 pb-2">
                    <div class="row mb-3 d-flex justify-content-center">
                        <label for="input" class="col-sm-2 col-form-label">รหัสวิชา</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="inputEmail" placeholder="รหัสวิชา">
                        </div>
                    </div>
                    <div class="row mb-3 d-flex justify-content-center">
                        <label for="input" class="col-sm-2 col-form-label">ชื่อวิชา</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="inputEmail" placeholder="ชื่อวิชา">
                        </div>
                    </div>
                    <div class="row mb-3 d-flex justify-content-center">
                        <label for="input" class="col-sm-2 col-form-label">คำอธิบาย</label>
                        <div class="col-sm-8">
                            <textarea type="text" class="form-control" id="inputEmail" rows="4"
                                placeholder="คำอธิบาย"></textarea>
                        </div>
                    </div>
                    <div class="row mb-3 d-flex justify-content-center">
                        <label for="input" class="col-sm-2 col-form-label">รูปภาพ</label>
                        <div class="col-sm-8">
                            <input type="file" class="form-control" id="inputEmail" accept="image/*"
                                onchange="readURL(this);">
                            <br>
                            <img class="img-fluid" id='previewprofile' width="150px">
                        </div>
                    </div>

                    <div class=" row mt-5">
                        <div class="col-md-12">
                            <div class="d-flex justify-content-end">
                                <button type="reset" class="btn btn-warning me-3"><i
                                        class="fa-solid fa-arrow-rotate-left"></i>
                                    ล้างข้อมูล</button>
                                <button type="submit" class="btn btn-primary" name="action" value="create_docout">บันทึก
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
            $('#previewprofile')
                .attr('src', e.target.result);
            $('#stored_picture').hide();
        };

        reader.readAsDataURL(input.files[0]);
    } else {
        $('#stored_picture').hide();
    }
}
</script>