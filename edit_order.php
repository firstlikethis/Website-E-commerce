<?php
    require('./includes/connect.php');
    $db = new db;
    $db->admin_empty();
    if(isset($_POST['add']))
    {
        $dt= $_POST['status'];
        $tn= $_POST['tecting_number'];
        $id = $_GET['id'];
        
        $insert = $db->update('tb_orders',"status_order = '$dt',tracking_number = '$tn'","id_order = '$id'");
        if($insert)
        {
            $db->alert('แก้ไขรายการสั่งซื้อสินค้าสำเร็จ');
            $db->header('admin_order.php');
        }
        else
        {
            $db->alert('เกิดข้อผิดพลาดในการแก้ไขรายการสั่งซื้อสินค้า!');
            $db->header('edit_order.php');
        }
    }
    $id = $_GET['id'];
    $se_product = $db->select_where('tb_orders',"id_order = '$id'");
    $product = $se_product->fetch_assoc();

?>
<?php include('./includes/h_admin.php');?>
<body>
    <form action="" method="post" enctype="multipart/form-data">
    <div class="contanier">
        <div class="panel panel-primary" style="margin: 0 auto; width: 500px; margin-top: 50px;">
            <div class="panel-heading text-center">แก้ไขรายการสินค้า</div>
                <div class="panel-body">
                    <div class="form-group">
                        <label for="status">สถานะ</label>
                        <select name="status" id="status" required class="form-control">
                            <option value="<?php echo $product['status_order'];?>"><?php echo $product['status_order'];?></option>
                            <option value="รอชำระเงิน">รอชำระเงิน</option>
                            <option value="รอตรวจสอบ">รอตรวจสอบ</option>
                            <option value="ชำระเงินเสร็จสิ้น">ชำระเงินเสร็จสิ้น</option>
                            <option value="กำลังจัดส่ง">กำลังจัดส่ง</option>
                            <option value="จัดส่งเสร็จสิ้น">จัดส่งเสร็จสิ้น</option>
                            <option value="เกิดข้อผิดพลาด">เกิดข้อผิดพลาด</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="tecting_number">เลขพัสดุ</label>
                        <input type="text" name="tecting_number" id="tecting_number" value="<?php echo $product['tracking_number'];?>" placeholder="หมายเลขพัสดุ" class="form-control">
                    </div>
                    
                </div>
                <div class="panel-footer text-center">
                    <a href="admin_order.php" class="btn btn-danger">กลับ</a>
                    <input type="submit" value="แก้ไขรายการสั่งซื้อสินค้า" name="add" id="add" onclick="return confirm('ต้องการแก้ไขรายการสั่งซื้อสินค้าใช่ หรือ ไม่')" class="btn btn-success">
                </div>
            </form>

        </div>
    </div>
    
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>