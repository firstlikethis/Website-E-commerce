<?php
    require('./includes/connect.php');
    $db = new db;
    $db->id_not();


    if(isset($_POST['submit']))
    {
        $username = $db->conn->real_escape_string($_POST['username']);
        $password = $db->conn->real_escape_string($db->encode($_POST['password']));
        $ip = $_SERVER['REMOTE_ADDR'];
        $date = date("Y-m-d H:m:s");
        $sql = "SELECT * FROM tb_members WHERE username=? AND password=?";
        $prepare = $db->conn->prepare($sql);
        $prepare->bind_param('ss',$username,$password);
        $prepare->execute();
        $result_user = $prepare->get_result();

        if($result_user->num_rows == 1)
        {
            $user = $result_user->fetch_assoc();
            $_SESSION['id'] = $user['id_member'];
            $_SESSION['status'] = $user['status'];
            $id_member = $user['id_member'];
            $db->alert("เข้าสู่ระบบเสร็จสิ้น!");
            if($user['status'] == "admin")
            {
                $db->header("admin.php");
            }
            else
            {
                $db->header("index.php");
            }
            $db->update("tb_members","ipaddress='$ip',login_last='$date'","id_member = '$id_member'");
        }
        else
        {
            $db->alert("ชื่อผู้ใช้ หรือ รหัสผ่าน ไม่ถูกต้อง!");
        }
    }
?>
<?php include('./includes/edit_head.php');?>
<body>

    <div class="container">
        <form action="" method="post">
            <div style="margin: 120px auto; width:420px;" class="panel panel-primary">
                <div class="panel-heading text-center"><i class="fa-solid fa-right-to-bracket"></i> เข้าสู่ระบบ</div>
                <div class="panel-body">
                    <div class="form-group">
                        <label for="username"><i class="fa-solid fa-envelope"></i> อีเมล</label>
                        <input type="email" id="username" name="username" required placeholder="text@gmail.com" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="password"><i class="fa-solid fa-lock"></i> รหัสผ่าน</label>
                        <input type="password" id="password" name="password" required placeholder="รหัสผ่าน ต้องมีจำนวน 8 ตัวขึ้นไป" pattern=".{8,}" class="form-control">
                    </div>
                    <input type="submit" name="submit" class="btn btn-success btn-block" value="เข้าสู่ระบบ">
                    <a href="index.php" class="btn btn-danger btn-block">กลับ</a>
                </div>
                <div class="panel-footer text-center">
                    <a href="register.php"><i class="fa-solid fa-user-plus"></i> สมัครสมาชิก</a>
                    หรือ
                    <a href="forget.php"><i class="fa-solid fa-key"></i> ลืมรหัสผ่าน</a>
                </div>
            </div>
        </form>
    </div>
    
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>