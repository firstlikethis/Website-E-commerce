<?php
    require('./includes/connect.php');
    $db = new db;
    $db->admin_empty();


    if(isset($_POST['submit']))
    {
       
        $s_name = $_POST['s_name'];
        $s_adress = $_POST['s_adress'];
        $s_facebook = $_POST['s_facebook'];
        $s_line = $_POST['s_line'];
        $s_tel = $_POST['s_tel'];
    
            $id = $_GET['id'];
            $insert = $db->update("tb_contacts","s_name='$s_name',s_adress='$s_adress',s_facebook='$s_facebook',s_line='$s_line',s_tel='$s_tel'","id_contact = '$id'");
            if($insert)
            {
                $db->alert("แก้ไขข้อมูลเสร็จสิ้น!");
                $db->header("admin_contact.php");
            }
            else
            {
                $db->alert("เกิดข้อผิดพลาดในการแก้ไขข้อมูล!");
                $db->header("admin_contact.php");
            }
    }
    $id=$_GET['id'];
    $se_contact = $db->select_where('tb_contacts',"id_contact = $id");
    $contact = $se_contact->fetch_assoc();
?>
<?php include('./includes/h_admin.php');?>

<body>

    <div class="container">
        <form action="" method="post">
            <div style="margin: 20px auto; width:500px;" class="panel panel-primary">
                <div class="panel-heading text-center">แก้ไขข้อมูลร้าน</div>
                <div class="panel-body">
                    <div class="form-group">
                        <label for="s_name">ชื่อร้าน</label>
                        <input type="text" id="s_name" name="s_name" value="<?php echo $contact['s_name']; ?>" required placeholder="ชื่อร้าน"
                            class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="s_adress">ที่อยู่</label>
                        <textarea name="s_adress" id="s_adress" cols="5" rows="5" class="form-control" value="<?php echo $contact['s_adress']; ?>" required
                            placeholder="ที่อยู่ของร้าน" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="s_facebook">เฟซบุ๊ค</label>
                        <input type="text" id="s_facebook" name="s_facebook" value="<?php echo $contact['s_facebook']; ?>" required placeholder="ชื่อเฟซบุ๊ค"
                            class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="s_line">ไลน์</label>
                        <input type="text" id="s_line" name="s_line" value="<?php echo $contact['s_line']; ?>" required placeholder="ชื่อไลน์"
                            class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="s_tel">เบอร์โทร</label>
                        <input type="text" id="s_tel" name="s_tel" pattern="[0-9]{10}" value="<?php echo $contact['s_tel']; ?>" required
                            placeholder="เบอร์โทรศัพท์" class="form-control">
                    </div>
                    <input type="submit" name="submit" class="btn btn-success btn-block"
                        onclick="return confirm('คุณต้องการที่จะแก้ไขข้อมูล ใช่หรือไม่?'); " value="แก้ไขข้อมูล">
                    <a href="admin_contact.php" class="btn btn-danger btn-block">กลับ</a>
                </div>
            </div>
        </form>
    </div>

    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>

</html>