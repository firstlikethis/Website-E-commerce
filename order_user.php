<?php
    require('./includes/connect.php');
    $db = new db;
    $db->admin_empty();

    if(empty($_GET['id']))
    {
        $db->header2("index.php");
    }
    else
    {
        $id_order = $_GET['id'];
        $sq_user = $db->select_where("tb_orders","id_order = '$id_order'");
        $user = $sq_user->fetch_assoc();
    }
?>
<?php include('./includes/head.php');?>
<body>

    <div class="container">
        <form action="" method="post">
            <div style="margin: 20px auto; width:500px;" class="panel panel-primary">
                <div class="panel-heading text-center">ข้อมูลผู้รับ</div>
                <div class="panel-body">
                <div class="form-group">
                    <label for="firstname">ชื่อจริง</label>
                    <input type="text" id="firstname" disabled value="<?php echo $user['firstname']; ?>" name="firstname" required placeholder="ชื่อจริง" class="form-control">
                </div>
                <div class="form-group">
                    <label for="lastname">นามสกุล</label>
                    <input type="text" id="lastname"name="lastname" disabled value="<?php echo $user['lastname']; ?>" required placeholder="นามสกุล" class="form-control">
                </div>
                <div class="form-group">
                    <label for="address">ที่อยู่</label>
                    <textarea name="address" id="address" cols="5" disabled rows="5" class="form-control" required placeholder="ที่อยู่ของท่าน" class="form-control"><?php echo $user['address']; ?></textarea>
                </div>
                <div class="form-group">
                    <label for="tel">เบอร์โทร</label>
                    <input type="text" id="tel" name="tel" pattern="[0-9]{10}" disabled  value="<?php echo $user['tel']; ?>" required placeholder="เบอร์โทร (0812923539)" class="form-control">
                </div>
            </div>
            </div>
        </form>
    </div>
    
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>