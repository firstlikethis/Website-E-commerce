<?php
    require('./includes/connect.php');
    $db = new db;
    $db->admin_empty();
    if(isset($_POST['add']))
    {
        $ng= $_POST['name_group'];
        
        if($db->insert('tb_groups','name_group',"'$ng'"))
        {
            $db->alert('เพิ่มหมวดหมู่สินค้าสำเร็จ');
            $db->header('add_group.php');
        }
        else
        {
            $db->alert('เกิดข้อผิดพลาดในการเพิ่มหมวดหมู่สินค้า!');
            $db->header('add_group.php');
        }
    }

?>
<?php include('./includes/h_admin.php');?>
<body>
    <form action="" method="post">
    <div class="contanier">
        <div class="panel panel-primary" style="margin: 0 auto; width: 420px; margin-top: 50px;">
            <div class="panel-heading text-center">เพิ่มหมวดหมู่สินค้า</div>
                <div class="panel-body">
                    <div class="form-group">
                        <label for="name_group">ชื่อหมวดหมู่สินค้า</label>
                        <input type="text" name="name_group" id="name_group" required placeholder="ชื่อหมวดหมู่สินค้าที่ต้องการเพิ่ม" class="form-control">
                    </div>
                </div>
                <div class="panel-footer text-center">
                    <a href="admin_group.php" class="btn btn-danger">กลับ</a>
                    <input type="submit" value="เพิ่มหมวดหมู่สินค้า" name="add" id="add" onclick="return confirm('ต้องการเพิ่มหมวดหมู่สินค้าใช่ หรือ ไม่')" class="btn btn-success">
                </div>
            </form>

        </div>
    </div>
    
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>