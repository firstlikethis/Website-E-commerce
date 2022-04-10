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

        $check = $db->select_where("tb_contacts","s_name = '$s_name'");
        if($check->num_rows == 0)
        {
            $insert = $db->insert("tb_contacts","s_name,s_adress,s_facebook,s_line,s_tel","'$s_name','$s_adress','$s_facebook','$s_line','$s_tel'");
            if($insert)
            {
                $db->alert("กรอกข้อมูลเสร็จสิ้น!");
                $db->header("admin_contact.php");
            }
            else
            {
                $db->alert("เกิดข้อผิดพลาดในการกรอกข้อมูล!");
                $db->header("add_contact.php");
            }
        }
        else
        {
            $db->alert("ข้อมูลซ้ำ!");
        }
    }
?>
<?php include('./includes/h_admin.php');?>

<body>

    <div class="container">
        <form action="" method="post">
            <div style="margin: 20px auto; width:420px;" class="panel panel-primary">
                <div class="panel-heading text-center">กรอกข้อมูลร้าน</div>
                <div class="panel-body">
                    <div class="form-group">
                        <label for="s_name">ชื่อร้าน</label>
                        <input type="text" id="s_name" name="s_name" required placeholder="ชื่อร้าน"
                            class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="s_adress">ที่อยู่</label>
                        <textarea name="s_adress" id="s_adress" cols="5" rows="5" class="form-control" required
                            placeholder="ที่อยู่ของร้าน" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="s_facebook">เฟซบุ๊ค</label>
                        <input type="text" id="s_facebook" name="s_facebook" required placeholder="ชื่อเฟซบุ๊ค"
                            class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="s_line">ไลน์</label>
                        <input type="text" id="s_line" name="s_line" required placeholder="ชื่อไลน์"
                            class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="s_tel">เบอร์โทร</label>
                        <input type="text" id="s_tel" name="s_tel" pattern="[0-9]{10}" required
                            placeholder="เบอร์โทรศัพท์" class="form-control">
                    </div>
                    <input type="submit" name="submit" class="btn btn-success btn-block"
                        onclick="return confirm('คุณต้องการที่จะบันทึก ใช่หรือไม่?'); " value="เพิ่มข้อมูลร้าน">
                    <a href="admin_contact.php" class="btn btn-danger btn-block">กลับ</a>
                </div>
            </div>
        </form>
    </div>

    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>

</html>