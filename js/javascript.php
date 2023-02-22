<!-- <script type="text/javascript">
$(document).ready(function() {
    $(document).on('click', '#submit_register', function() {

        if (confirm("Are you sure you want to remove this?")) {
            $.ajax({
                url: "action.php",
                method: "POST",
                dataType: "json",
                data: {
                    id: id,
                    action: 'delete_invoice'
                },
                success: function(response) {
                    if (response.status == 1) {
                        <?php //$_SESSION['success'] = "สมัครสมาชิกสำเร็จ!";?>
                        window.location.href = 'login.php';
                        $('#' + id).closest("tr").remove();
                    }
                }
            });
        } else {
            return false;
        }
    });
});
</script> -->