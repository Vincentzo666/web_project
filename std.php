<?php 

    require_once('connection.php');
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index Page</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
</head>
<body>
    

    <div class="container text-center">
        <h1>รายชื่อผู้เรียน</h1>

        <a href="add.php" class="btn btn-success">เพิ่มรายชื่อ</a>
        <table class="table table-striped table-bordered table-hover">
            <thead>
                <tr>
                    <td>รูป</td>
                    <td>ชื่อ</td>
                    <td>รหัสนักศึกษา</td>
                    <td>เเก้ไข</td>
                    <td>ลบ</td>
                </tr>
            </thead>

            <tbody>
                <?php 
                    $select_stmt = $db->prepare('SELECT * FROM std_list'); 
                    $select_stmt->execute();

                    while ($row = $select_stmt->fetch(PDO::FETCH_ASSOC)) {
                ?>
                    <tr>
                        <td><img src="upload/<?php echo $row['std_img']; ?>" width="100px" height="100px" alt=""></td>
                        <td><?php echo $row['std_name']; ?></td>  
                        <td><?php echo $row['std_id']; ?></td>                                          
                        <td><a href="edit.php?update_id=<?php echo $row['id']; ?>" class="btn btn-warning">เเก้ไข</a></td>                        
                        <td><a href="?delete_id=<?php echo $row['id']; ?>" class="btn btn-danger">ลบ</a></td>                        
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>
</html>