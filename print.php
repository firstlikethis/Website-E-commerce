<?php
    require('./includes/connect.php');
    $db = new db;

    if(!empty($_GET['id']))
    {
        $id_order = $_GET['id'];
        $sq_order = $db->select_where("tb_orders","id_order = '$id_order'");
        $order = $sq_order->fetch_assoc();
    }
    else
    {
        $db->header2("index.php");
    }
?>
<?php include('./includes/h_print.php');?>
<body onload="window.print();">

   

    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center " style="margin-top: 30px; padding-top:20px;">
                <img src="Images/UI/logo1.png"  height="50px" alt="No Image">
            </div>
            <div class="col-lg-12" style="padding:40px;">
                <h3><u><b>ข้อมูลผู้รับ</b></u></h3>
                <h4><b>ชื่อ</b> : <?php echo $order['firstname']; ?></h4>
                <h4><b>นามสกุล</b> : <?php echo $order['lastname']; ?></h4>
                <h4><b>ที่อยู่</b> : <?php echo $order['address']; ?></h4>
                <h4><b>เบอร์โทรศัพท์</b> : <?php echo $order['tel']; ?></h4>
            </div>
            <div class="col-lg-12" style="padding:30px;">
                <div class="panel panel-primary">
                    <div class="panel-heading text-center"><b>รายการสั่งซื้อ</b></div>
                    <div class="panel-body">
                        <table width="100%">
                            <tr>
                                <th class="text-center" width="5%">ลำดับ</th>
                                <th class="text-center">ชื่อสินค้า</th>
                                <th class="text-center">จำนวน</th>
                                <th class="text-center">ราคา / หน่วย</th>
                            </tr>
                        <?php
                        $i = 0;
                        $sq_product = $db->select_join_where("tb_detail_orders","tb_products","id_product","id_order = '$id_order'");
                        while($product = $sq_product->fetch_assoc())
                        {
                            $i++;
                        ?>
                        <tr>
                            <td class="text-center"><?php echo $i; ?></td>
                            <td class="text-center"><?php echo $product['name_product']; ?></td>
                            <td class="text-center"><?php echo number_format($product['qty']); ?></td>
                            <td class="text-center"><?php echo number_format($product['price']); ?></td>
                        </tr>
                        <?php
                        }
                        ?>
                        <tr>
                            <th class="text-center" colspan="3">ราคารวม</th>
                            <th class="text-center" colspan="3"><?php echo number_format($order['total_order']); ?></th>
                        </tr>
                        <tr>
                            <th class="text-center" colspan="3">สถานะ</th>
                            <th class="text-center" colspan="3"><?php echo $order['status_order']; ?></th>
                        </tr>
                        <?php
                        if($order['status_order'] == "จัดส่งเสร็จสิ้น")
                        {
                        ?>
                        <tr>
                         <th class="text-center" colspan="3">หมายเลขพัสดุ</th>
                         <th class="text-center" colspan="3"><?php echo $order['tracking_number']; ?></th>
                     </tr>
                        <?php
                        }
                        ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
 
    
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>