<?php
    require('./includes/connect.php');
    $db = new db;
    $db->id_empty();

    if(empty($_GET['id']))
    {
        $db->header2("index.php");
    }
    else
    {
        $id_order = $_GET['id'];
        $id_member = $_SESSION['id'];
        $check = $db->select_where("tb_orders","id_member = '$id_member' AND id_order = '$id_order'");
        if($check->num_rows == 0)
        {
            $db->header2("index.php");
    
        }
    }
    if(isset($_POST['submit']))
    {
       
            $payment = $_POST['payment'];
            $date = date("Y-m-d H:m:s");
            $real_image = pathinfo(basename($_FILES['image_order']['name']),PATHINFO_EXTENSION);
            $image_encode = 'Order'.uniqid().'.'.$real_image;
            $image_path = 'Images/Orders/';
            $image_success = $image_path.$image_encode;
            $success = move_uploaded_file($_FILES['image_order']['tmp_name'],$image_success);
            if($success == FALSE)
            {
    
                $db->alert('เกิดข้อผิดพลาดในการอัพโหลดรูปภาพ!');
                $db->header('order.php');
            }
    
            $update = $db->update("tb_orders","date_payment='$date',payment='$payment',status_order ='รอตรวจสอบ',image_order = '$image_encode'","id_order = '$id_order'");
            if($update)
            {
                $db->alert("แจ้งชำระเงินเสร็จสิ้น");
                $db->header("order.php");
            }
            else
            {
                $db->alert("เกิดข้อผิดพลาดในการแจ้งชำระเงิน");
                $db->header("order.php");
            }
       
    }
    
?>
<?php include('./includes/head.php');?>
<body>

    <div class="container">
        <form action="" method="post" enctype="multipart/form-data">
            <div style="margin: 20px auto; width:500px;" class="panel panel-primary">
                <div class="panel-heading text-center"><b>แจ้งชำระเงิน</b></div>
                <div class="panel-body">
                    <div class="form-group">
                        <label for="payment">ช่องทางการชำระเงิน</label>
                        <select name="payment" id="payment" required class="form-control">
                            <option value="ธนาคารกสิกร">ธนาคารกสิกร นางสาวธารีรันต์ ฤทธิประทีป 065-124651-2</option>
                            <option value="ธนาคารกรุงเทพ">ธนาคารไทยพาณิชย์ นายจักรี เอื้อศิริประชา 534-258846-3</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="image_order">หลักฐานการชำระเงิน</label>
                        <input type="file" accept="image/*" name="image_order" class="form-control" required id="image_order">
                    </div>
                    <input type="submit" name="submit" onclick="return confirm('คุณต้องการที่จะแจ้งชำระเงิน ใช่หรือไม่?');" class="btn btn-success btn-block" value="แจ้งชำระเงิน">
                    <a href="order.php" class="btn btn-danger btn-block">กลับ</a>
                </div>
            </div>
        </form>
    </div>
    
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>