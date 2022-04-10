<?php
    require('./includes/connect.php');
    $db = new db;
    $db->id_not();
    if(isset($_POST['submit']))
    {
        $id = $_POST['id'];
        $query = $_POST['query'];
        $answer = $_POST['answer'];
        $check = $db->select_where("tb_members","id_member = '$id' AND query = '$query' AND answer = '$answer'");
        if($check->num_rows == 1)
        {
            $user = $check->fetch_assoc();
        }
        else
        {
            $db->header("forget.php");
            $db->alert("คำตอบไม่ถูกต้อง");
        }

    }
    else
    {
        if(isset($_POST['repass']))
        {
            $password = $_POST['password'];
            $password2 = $_POST['password2'];
            $id = $_POST['id'];
            $password_encode = $db->encode($password2);
            if($password == $password2)
            {
                $update = $db->update("tb_members","password = '$password_encode'","id_member = '$id'");
                if($update)
                {
                    $db->alert("เปลื่ยนรหัสผ่านเสร็จสิ้น");
                    $db->header("login.php");
                }
                else
                {
                    $db->alert("เกิดข้อผิดพลาดในการเปลื่ยนรหัสผ่าน");
                    $db->header("forget.php");
                }
            }
            else
            {
                $db->alert("รหัสผ่านไม่ตรงกัน");
            }
        }
        else
        {
            $db->header2("index.php");
        }
    }
?>
<?php include('./includes/head.php');?>
<body>

    <div class="container">
        <form action="forget_reset.php" method="post">
            <div style="margin: 20px auto; width:500px;" class="panel panel-primary">
                <div class="panel-heading text-center">ลืมรหัสผ่าน</div>
                <div class="panel-body">
                <div class="form-group">
                        <label for="password">รหัสผ่านใหม่</label>
                        <input type="password" id="password" name="password" required placeholder="รหัสผ่าน ต้องมีจำนวน 8 ตัวขึ้นไป" pattern=".{8,}" class="form-control">
                    </div>
                <div class="form-group">
                        <label for="password2">ยืนยันรหัสผ่าน</label>
                        <input type="password" id="password2" name="password2" required placeholder="รหัสผ่าน ต้องมีจำนวน 8 ตัวขึ้นไป" pattern=".{8,}" class="form-control">
                        <input type="hidden" value="<?php echo $user['id_member']; ?>" name="id">
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