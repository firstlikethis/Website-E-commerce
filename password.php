<?php
    require('./includes/connect.php');
    $db = new db;
    $db->id_empty();
    
        if(isset($_POST['repass']))
        {
            $password_def = $_POST['password_def'];
            $pass = $db->encode($password_def);
            $password = $_POST['password'];
            $password2 = $_POST['password2'];
            $id = $_SESSION['id'];
            $password_encode = $db->encode($password2);
        $check = $db->select_where("tb_members","password = '$pass' AND id_member = '$id'");
            if($check->num_rows == 1)
            {
                if($password == $password2)
                {
                    $update = $db->update("tb_members","password = '$password_encode'","id_member = '$id'");
                    if($update)
                    {
                        $db->alert("เปลื่ยนรหัสผ่านเสร็จสิ้น");
                        $db->header("profile.php");
                    }
                    else
                    {
                        $db->alert("เกิดข้อผิดพลาดในการเปลื่ยนรหัสผ่าน");
                        $db->header("profile.php");
                    }
                }
                else
                {
                    $db->alert("รหัสผ่านไม่ตรงกัน");
                }
            }
            else
            {
                $db->alert("รหัสผ่านเดิมไม่ถูกต้อง");

            }
        }
?>
<?php include('./includes/head.php');?>
<body>

    <div class="container">
        <form action="" method="post">
            <div style="margin: 20px auto; width:500px;" class="panel panel-primary">
                <div class="panel-heading text-center">เปลื่ยนรหัสผ่าน</div>
                <div class="panel-body">
                <div class="form-group">
                        <label for="password_def">รหัสผ่านเดิม</label>
                        <input type="password" id="password_def" name="password_def" required placeholder="รหัสผ่าน ต้องมีจำนวน 8 ตัวขึ้นไป" pattern=".{8,}" class="form-control">
                    </div>
                <div class="form-group">
                        <label for="password">รหัสผ่านใหม่</label>
                        <input type="password" id="password" name="password" required placeholder="รหัสผ่าน ต้องมีจำนวน 8 ตัวขึ้นไป" pattern=".{8,}" class="form-control">
                    </div>
                <div class="form-group">
                        <label for="password2">ยืนยันรหัสผ่าน</label>
                        <input type="password" id="password2" name="password2" required placeholder="รหัสผ่าน ต้องมีจำนวน 8 ตัวขึ้นไป" pattern=".{8,}" class="form-control">
                    </div>
                    <input type="submit" name="repass" class="btn btn-success btn-block" onclick="return confirm('คุณต้องการที่จะเปลื่ยนรหัสผ่าน ใช่หรือไม่?'); " value="ยืนยัน">
                    <a href="forget.php" class="btn btn-danger btn-block">กลับ</a>
                </div>
            </div>
        </form>
    </div>
    
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>