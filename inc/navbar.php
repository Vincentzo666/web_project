<?php 
    if(isset($_GET['action'])&&$_GET['action']=='logout'){
        session_unset();
        session_destroy();
        echo "<script>window.location.reload();</script>";
    }
    
?>
<div class="navbar navbar-dark bg-dark shadow-sm p-0">
    <div class="navbar-brand d-flex align-items-center ms-4">
        <!-- <img src=" ../image/profile/<?php //echo $user['profile'] ?>" alt="profile" width="45" height="45"
        class="rounded-circle" ;> -->
        <img src="image/profile/cat.png" alt="profile" width="35" height="35" class="rounded-circle" ;>
        <!-- <h2 style="margin:0 0 0 10px ;"><?php //echo $user['fname'] . " " . $user['lname'] ?></h2> -->
        <h3 class=" ms-3 mb-0 pb-1"><?=  $_SESSION['name_teacher'] ?></h3>
        <button type="button" class="btn btn-primary btn-sm ms-3">Edit Account</button>

    </div>
    <button type="button" class="btn btn-danger btn-sm me-3 logout">Logout</button>
</div>
<script type="text/javascript">
$(document).ready(function() {

    $(document).on('click', '.logout', function() {
        swal.fire({
            title: 'ออกจากระบบ ?',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'ใช่ ออกจากระบบ!',
            cancelButtonText: 'ไม่ อยู่ในระบบต่อไป!'
        }).then((result) => {
            if (result.value) {
                window.location.href = "?action=logout";
            }
        });
    });
});
</script>