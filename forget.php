<?php
    require('./includes/connect.php');
    $db = new db;
    $db->id_not();
?>
<?php include('./includes/head.php');?>
<body>

    <div class="container">
        <form action="forget_check.php" method="post">
            <div style="margin: 20px auto; width:500px;" class="panel panel-primary">
                <div class="panel-heading text-center">ลืมรหัสผ่าน</div>
                <div class="panel-body">
                    <div class="form-group">
                        <label for="username">ชื่อผู้ใช้</label>
                        <input type="email" id="username" name="username" required placeholder="text@gmail.com" class="form-control">
                    </div>
                    <input type="submit" name="submit" class="btn btn-success btn-block" value="ยืนยัน">
                    <a href="login.php" class="btn btn-danger btn-block">กลับ</a>
                </div>
            </div>
        </form>
    </div>
    
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>