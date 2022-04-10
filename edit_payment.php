<?php
    require('./includes/connect.php');
    $db = new db;
    $db->admin_empty();


    if(isset($_POST['submit']))
    {
       
        $bank_acc = $_POST['bank_acc'];
        $bank_name = $_POST['bank_name'];
        $holder_name = $_POST['holder_name'];
    
            $id = $_GET['id'];
            $insert = $db->update("tb_howtopayments","bank_acc='$bank_acc',bank_name='$bank_name',holder_name='$holder_name'","id_payment = '$id'");
            if($insert)
            {
                $db->alert("แก้ไขข้อมูลเสร็จสิ้น!");
                $db->header("admin_payment.php");
            }
            else
            {
                $db->alert("เกิดข้อผิดพลาดในการแก้ไขข้อมูล!");
                $db->header("admin_payment.php");
            }
    }
    $id=$_GET['id'];
    $se_payment = $db->select_where('tb_howtopayments',"id_payment = $id");
    $payment = $se_payment->fetch_assoc();
?>
<?php include('./includes/h_admin.php');?>

<body>

    <div class="container">
        <form action="" method="post">
            <div style="margin: 20px auto; width:500px;" class="panel panel-primary">
                <div class="panel-heading text-center">แก้ไขข้อมูลร้าน</div>
                <div class="panel-body">
                    <div class="form-group">
                        <label for="bank_acc">เลขที่บัญชี</label>
                        <input type="text" id="bank_acc" name="bank_acc" value="<?php echo $payment['bank_acc']; ?>" required placeholder="ชื่อร้าน"
                            class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="bank_name">ธนาคาร</label>
                        <input type="text" id="bank_name" name="bank_name" value="<?php echo $payment['bank_name']; ?>" required placeholder="ชื่อธนาคาร"
                            class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="holder_name">ชื่อเจ้าของบัญชี</label>
                        <input type="text" id="holder_name" name="holder_name" value="<?php echo $payment['holder_name']; ?>" required placeholder="ชื่อเจ้าของบัญชี"
                            class="form-control">
                    </div>
                    <input type="submit" name="submit" class="btn btn-success btn-block"
                        onclick="return confirm('คุณต้องการที่จะแก้ไขข้อมูลการชำระเงิน ใช่หรือไม่?'); " value="แก้ไขข้อมูลการชำระเงิน">
                    <a href="admin_payment.php" class="btn btn-danger btn-block">กลับ</a>
                </div>
            </div>
        </form>
    </div>

    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>

</html>