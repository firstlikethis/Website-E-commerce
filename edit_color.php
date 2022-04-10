<?php
    require('./includes/connect.php');
    $db = new db;
    $db->admin_empty();
    $id = $_GET['id'];
    if(isset($_POST['add']))
    {
        $id = $_GET['id'];
        $nc= $_POST['name_color'];
        
        if($db->update('tb_colors',"name_color='$nc'","id_color = '$id'"))
        {
            $db->alert('แก้ไขหมวดหมู่สินค้าสำเร็จ');
            $db->header('admin_color.php');
        }
        else
        {
            $db->alert('เกิดข้อผิดพลาดในการแก้ไขหมวดหมู่สินค้า!');
            $db->header('edit_color.php');
        }
    }
    $se_color = $db->select_where('tb_colors',"id_color = '$id'");
    $color = $se_color->fetch_assoc();

?>
<?php include('./includes/h_admin.php');?>
<body>
    <form action="" method="post">
    <div class="contanier">
        <div class="panel panel-primary" style="margin: 0px auto; width: 500px; margin-top: 50px;">
            <div class="panel-heading text-center">แก้ไขสี</div>
                <div class="panel-body">
                    <div class="form-group">
                        <label for="name_color">สี</label>
                        <input type="text" name="name_color" id="name_color" value="<?php echo $color['name_color']; ?>" required placeholder="สีที่ต้องการแก้ไข" class="form-control">
                    </div>
                </div>
                <div class="panel-footer text-center">
                    <a href="admin_group.php" class="btn btn-danger">กลับ</a>
                    <input type="submit" value="แก้ไขสี" name="add" id="add" onclick="return confirm('ต้องการแก้ไขสีใช่ หรือ ไม่')" class="btn btn-success">
                </div>
            </form>

        </div>
    </div>
    
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>