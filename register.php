<?php
    require('./includes/connect.php');
    $db = new db;
    $db->id_not();


    if(isset($_POST['submit']))
    {
        $username = $_POST['username'];
        $password = $db->encode($_POST['password']);
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $address = $_POST['address'];
        $tel = $_POST['tel'];
        $query = $_POST['query'];
        $answer = $_POST['answer'];
             
        $check = $db->select_where("tb_members","username = '$username'");
        if($check->num_rows == 0)
        {
            $insert = $db->insert("tb_members","username,password,firstname,lastname,address,tel,query,answer","'$username','$password','$firstname','$lastname','$address','$tel','$query','$answer'");
            if($insert)
            {
                $db->alert("สมัครสมาชิกเสร็จสิ้น!");
                $db->header("login.php");
            }
            else
            {
                $db->alert("เกิดข้อผิดพลาดในการสมัครสมาชิก!");
                $db->header("register.php");
            }
        }
        else
        {
            $db->alert("ชื่อผู้ใช้ ถูกใช้งานแล้ว!");
        }
    }

    
    
?>
<?php include('./includes/edit_head.php');?>

<body>

    <div class="container">
        <form action="" method="post">
            <div style="margin: 20px auto; width:420px;" class="panel panel-primary">
                <div class="panel-heading text-center">สมัครสมาชิก</div>
                <div class="panel-body">
                    <div class="form-group">
                        <label for="username"><i class="fa-solid fa-envelope"></i> อีเมล</label>
                        <input type="email" id="username" name="username" required placeholder="text@gmail.com"
                            class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="password"><i class="fa-solid fa-key"></i> รหัสผ่าน</label>
                        <input type="password" id="password" name="password" required
                            placeholder="รหัสผ่าน ต้องมีจำนวน 8 ตัวขึ้นไป" pattern=".{8,}" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="firstname"><i class="fa-solid fa-user"></i> ชื่อจริง</label>
                        <input type="text" id="firstname" name="firstname" required placeholder="ชื่อจริง"
                            class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="lastname"><i class="fa-solid fa-user"></i> นามสกุล</label>
                        <input type="text" id="lastname" name="lastname" required placeholder="นามสกุล"
                            class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="address"><i class="fa-solid fa-location-dot"></i> ที่อยู่</label>
                        <textarea name="address" id="address" cols="5" rows="5" class="form-control" required
                            placeholder="ที่อยู่ของท่าน" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="tel"><i class="fa-solid fa-mobile"></i> เบอร์โทรศัพท์</label>
                        <input type="text" id="tel" name="tel" pattern="[0-9]{10}" required
                            placeholder="เบอร์โทร (08xxxxxxxx)" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="query"><i class="fa-solid fa-circle-question"></i> คำถาม (สำหรับรีเซ็ตรหัสผ่าน)</label>
                        <select name="query" id="query" required class="form-control">
                            <option value="คุณชื่นชอบอะไร?">คุณชื่นชอบอะไร?</option>
                            <option value="สัตว์เลี้ยงตัวแรกของคุณชื่ออะไร?">สัตว์เลี้ยงตัวแรกของคุณชื่ออะไร?</option>
                            <option value="คุณเกิดที่ไหน?">คุณเกิดที่ไหน?</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="answer"><i class="fa-solid fa-circle-check"></i> คำตอบ (สำหรับรีเซ็ตรหัสผ่าน)</label>
                        <input type="text" id="answer" name="answer" required placeholder="คำตอบ (สำหรับรีเซ็ตรหัสผ่าน)"
                            class="form-control">
                    </div>
                    <input type="submit" name="submit" class="btn btn-success btn-block"
                        onclick="return confirm('คุณต้องการที่จะสมัครสมาชิก ใช่หรือไม่?'); " value="สมัครสมาชิก">
                    <a href="index.php" class="btn btn-danger btn-block">กลับ</a>
                </div>
            </div>
        </form>
    </div>

    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>

</html>