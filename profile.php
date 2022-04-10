<?php
    require('./includes/connect.php');
    $db = new db;
    $db->id_empty();

    if(isset($_POST['submit']))
    {
        $id_member = $_SESSION['id'];
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $address = $_POST['address'];
        $tel = $_POST['tel'];

        $update = $db->update("tb_members","firstname='$firstname',lastname='$lastname',address='$address',tel='$tel'","id_member = '$id_member'");
        if($update)
        {
            $db->alert("แก้ไขข้อมูลเสร็จสิ้น");
            $db->header('profile.php');
        }
        else
        {
            $db->alert("เกิดข้อผิดพลาดในการแก้ไขข้อมูล");
            $db->header('profile.php');
        }
    }
?>
<?php include('./includes/head.php');?>

<body>

    <?php include('./includes/navbar.php'); ?>
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <?php include('./includes/group.php'); ?>
            </div>
            <div class="col-lg-9">
                <?php include('./includes/nav.php'); ?>
                <form action="" method="post">
                    <div style="margin-top: 20px;" class="panel panel-primary">
                        <div class="panel-heading">แก้ไขข้อมูลส่วนตัว</div>
                        <div class="panel-body">
                            <div class="form-group">
                                <label for="firstname">ชื่อจริง</label>
                                <input type="text" id="firstname" name="firstname"
                                    value="<?php echo $user['firstname']; ?>" required placeholder="ชื่อจริง"
                                    class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="lastname">นามสกุล</label>
                                <input type="text" id="lastname" name="lastname" required
                                    value="<?php echo $user['lastname']; ?>" placeholder="นามสกุล" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="address">ที่อยู่</label>
                                <textarea name="address" id="address" cols="5" rows="5" class="form-control" required
                                    placeholder="ที่อยู่ของท่าน"
                                    class="form-control"><?php echo $user['address']; ?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="tel">เบอร์โทร</label>
                                <input type="text" id="tel" name="tel" pattern="[0-9]{10}"
                                    value="<?php echo $user['tel']; ?>" required placeholder="เบอร์โทร (0812923539)"
                                    class="form-control">
                            </div>
                        </div>
                        <div class="panel-footer text-center">
                            <input type="submit" name="submit" value="ยืนยันการแก้ไข"
                                onclick="return confirm('คุณต้องการที่จะแก้ไข ใช่ หรือ ไม่?'); "
                                class="btn btn-success">
                            <a href="password.php" class="btn btn-primary">เปลื่ยนรหัสผ่าน</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>

</html>