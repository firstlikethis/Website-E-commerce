<?php
    require('./includes/connect.php');
    $db = new db;
    $db->admin_empty();
    $id = $_GET['id'];
    if(isset($_POST['add']))
    {
        $id = $_GET['id'];
        $ng= $_POST['name_group'];
        
        if($db->update('tb_groups',"name_group='$ng'","id_group = '$id'"))
        {
            $db->alert('แก้ไขหมวดหมู่สินค้าสำเร็จ');
            $db->header('admin_group.php');
        }
        else
        {
            $db->alert('เกิดข้อผิดพลาดในการแก้ไขหมวดหมู่สินค้า!');
            $db->header('edit_group.php');
        }
    }
    $se_group = $db->select_where('tb_groups',"id_group = '$id'");
    $group = $se_group->fetch_assoc();

?>
<?php include('./includes/h_admin.php');?>
<body>
    <form action="" method="post">
    <div class="contanier">
        <div class="panel panel-primary" style="margin: 0 auto; width: 500px; margin-top: 50px;">
            <div class="panel-heading text-center">แก้ไขหมวดหมู่สินค้า</div>
                <div class="panel-body">
                    <div class="form-group">
                        <label for="name_group">ชื่อหมวดหมู่สินค้า</label>
                        <input type="text" name="name_group" id="name_group" value="<?php echo $group['name_group']; ?>" required placeholder="ชื่อหมวดหมู่สินค้าที่ต้องการแก้ไข" class="form-control">
                    </div>
                </div>
                <div class="panel-footer text-center">
                    <a href="admin_group.php" class="btn btn-danger">กลับ</a>
                    <input type="submit" value="แก้ไขหมวดหมู่สินค้า" name="add" id="add" onclick="return confirm('ต้องการแก้ไขหมวดหมู่สินค้าใช่ หรือ ไม่')" class="btn btn-success">
                </div>
            </form>

        </div>
    </div>
    
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>