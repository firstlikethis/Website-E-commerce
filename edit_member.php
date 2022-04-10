<?php
    require('./includes/connect.php');
    $db = new db;
    $db->admin_empty();


    if(isset($_POST['submit']))
    {
       
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $address = $_POST['address'];
        $tel = $_POST['tel'];
        $query = $_POST['query'];
        $answer = $_POST['answer'];
        $status = $_POST['status'];

    
            $id = $_GET['id'];
            $insert = $db->update("tb_members","firstname='$firstname',lastname='$lastname',address='$address',tel='$tel',query='$query',answer='$answer',status='$status'","id_member = '$id'");
            if($insert)
            {
                $db->alert("แก้ไขสมาชิกเสร็จสิ้น!");
                $db->header("admin_member.php");
            }
            else
            {
                $db->alert("เกิดข้อผิดพลาดในการแก้ไขสมาชิก!");
                $db->header("edit_member.php");
            }
    }
    $id=$_GET['id'];
    $se_member = $db->select_where('tb_members',"id_member = $id");
    $member = $se_member->fetch_assoc();
?>
<?php include('./includes/h_admin.php');?>
<body>

    <div class="container">
        <form action="" method="post">
            <div style="margin: 20px auto; width:500px;" class="panel panel-primary">
                <div class="panel-heading text-center">แก้ไขสมาชิก</div>
                <div class="panel-body">
                     
                    <div class="form-group">
                        <label for="firstname">ชื่อจริง</label>
                        <input type="text" id="firstname" name="firstname" value="<?php echo $member['firstname']; ?>" required placeholder="ชื่อจริง" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="lastname">นามสกุล</label>
                        <input type="text" id="lastname"name="lastname" value="<?php echo $member['lastname']; ?>" required placeholder="นามสกุล" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="address">ที่อยู่</label>
                        <textarea name="address" id="address" cols="5" rows="5" class="form-control" required placeholder="ที่อยู่ของท่าน" class="form-control"><?php echo $member['address']; ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="tel">เบอร์โทร</label>
                        <input type="text" id="tel" name="tel" pattern="[0-9]{10}" value="<?php echo $member['tel']; ?>" required placeholder="เบอร์โทร (0812923539)" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="query">คำถาม สำหรับรีเซ็ตรหัสผ่าน</label>
                        <select name="query" id="query" required class="form-control">
                            <option value="<?php echo $member['query']; ?>"><?php echo $member['query']; ?></option>
                            <option value="คุณชื่นชอบอะไร?">คุณชื่นชอบอะไร?</option>
                            <option value="สัตว์เลี้ยงตัวแรกของคุณชื่ออะไร?">สัตว์เลี้ยงตัวแรกของคุณชื่ออะไร?</option>
                            <option value="คุณเกิดที่ไหน?">คุณเกิดที่ไหน?</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="answer">คำตอบ (สำหรับรีเซ็ตรหัสผ่าน)</label>
                        <input type="text" id="answer" name="answer" value="<?php echo $member['answer']; ?>" required placeholder="คำตอบ (สำหรับรีเซ็ตรหัสผ่าน)" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="status">สถานะ</label>
                        <select name="status" id="status" required class="form-control">
                            <option value="<?php echo $member['status']; ?>"><?php echo $member['status']; ?></option>
                            <option value="admin">admin</option>
                            <option value="member">member</option>
                        </select>
                    </div>
                    <input type="submit" name="submit" class="btn btn-success btn-block" onclick="return confirm('คุณต้องการที่จะแก้ไขสมาชิก ใช่หรือไม่?'); " value="แก้ไขสมาชิก">
                    <a href="admin_password.php?id=<?php echo $id; ?>" class="btn btn-primary btn-block">เปลี่ยนรหัสผ่าน</a>
                    <a href="admin_member.php" class="btn btn-danger btn-block">กลับ</a>
                </div>
            </div>
        </form>
    </div>
    
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>