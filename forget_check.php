<?php
    require('./includes/connect.php');
    $db = new db;
    $db->id_not();
    if(isset($_POST['username']))
    {
        $username = $_POST['username'];
        $check = $db->select_where("tb_members","username = '$username'");
        if($check->num_rows == 1)
        {
            $user = $check->fetch_assoc();
        }
        else
        {
            $db->header("forget.php");
            $db->alert("ไม่พบชื่อผู้ใช้นี้");
        }

    }
    else
    {
        $db->header2("index.php");
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
                        <label for="query">คำถาม สำหรับรีเซ็ตรหัสผ่าน)</label>
                        <select name="query" id="query" required class="form-control">
                            <option value="คุณชื่นชอบอะไร?">คุณชื่นชอบอะไร?</option>
                            <option value="สัตว์เลี้ยงตัวแรกของคุณชื่ออะไร?">สัตว์เลี้ยงตัวแรกของคุณชื่ออะไร?</option>
                            <option value="คุณเกิดที่ไหน?">คุณเกิดที่ไหน?</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="answer">คำตอบ (สำหรับรีเซ็ตรหัสผ่าน)</label>
                        <input type="text" id="answer" name="answer" required placeholder="คำตอบ (สำหรับรีเซ็ตรหัสผ่าน)" class="form-control">
                        <input type="hidden" value="<?php echo $user['id_member']; ?>" name="id">
                    </div>
                    <input type="submit" name="submit" class="btn btn-success btn-block" value="ยืนยัน">
                    <a href="forget.php" class="btn btn-danger btn-block">กลับ</a>
                </div>
            </div>
        </form>
    </div>
    
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>