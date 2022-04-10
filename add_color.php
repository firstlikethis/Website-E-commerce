<?php
    require('./includes/connect.php');
    $db = new db;
    $db->admin_empty();
    if(isset($_POST['add']))
    {
        $nc= $_POST['name_color'];
        
        if($db->insert('tb_colors','name_color',"'$nc'"))
        {
            $db->alert('เพิ่มสีสำเร็จ');
            $db->header('add_color.php');
        }
        else
        {
            $db->alert('เกิดข้อผิดพลาดในการเพิ่มหมวดสี!');
            $db->header('add_color.php');
        }
    }

?>
<?php include('./includes/h_admin.php');?>
<body>
    <form action="" method="post">
    <div class="contanier">
        <div class="panel panel-primary" style="margin: 0 auto; width: 420px; margin-top: 50px;">
            <div class="panel-heading text-center">เพิ่มสี</div>
                <div class="panel-body">
                    <div class="form-group">
                        <label for="name_color">สี</label>
                        <input type="text" name="name_color" id="name_color" required placeholder="สีที่ต้องการเพิ่ม" class="form-control">
                    </div>
                </div>
                <div class="panel-footer text-center">
                    <a href="admin_color.php" class="btn btn-danger">กลับ</a>
                    <input type="submit" value="เพิ่มสี" name="add" id="add" onclick="return confirm('ต้องการเพิ่มสีใช่ หรือ ไม่')" class="btn btn-success">
                </div>
            </form>

        </div>
    </div>
    
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>