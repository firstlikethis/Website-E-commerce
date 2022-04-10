<?php
    require('./includes/connect.php');
    $db = new db;
    $db->id_empty();


    if(!empty($_GET['id']))
    {
        $id_order = $_GET['id'];

        $sq_product = $db->select_join_where("tb_detail_orders","tb_products","id_product","id_order = '$id_order'");
        while($product = $sq_product->fetch_assoc())
        {
            $id_product = $product['id_product'];
            $stock = $product['stock_product']+$product['qty'];
            $like = $product['like_product']-1;
            $update = $db->update("tb_products","stock_product = '$stock', like_product = '$like'","id_product = '$id_product'");
        }
        
        $de1 = $db->delete("tb_detail_orders","id_order = '$id_order'");
        $de2 = $db->delete("tb_orders","id_order = '$id_order'");

        if($de1 && $de2 && $update)
        {
            $db->alert("ยกเลิกเสร็จสิ้น!");
            $db->header("order.php");
        }
        else
        {
            $db->alert("เกิดข้อผิดพลาดในการยกเลิก!");
            $db->header("order.php");
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
                <div style="margin-top: 20px;" class="panel panel-primary">
                    <div class="panel-heading">รายการสั่งซื้อ</div>
                    <div class="panel-body">
                       <?php
                       $sq_order = $db->select_where("tb_orders","id_member = '$id_member' ORDER BY id_order DESC");
                       
                       while($order = $sq_order->fetch_assoc())
                       {
                        $i = 0;
                           $id_order = $order['id_order'];
                       ?>
                       <div class="panel panel-primary">
                           <div class="panel-heading">หมายเลขสั่งซื้อ <?php echo $order['id_order']; ?></div>
                           <div class="panel-body">
                               <table width="100%">
                                   <tr>
                                       <th class="text-center" width="5%">ลำดับ</th>
                                       <th class="text-center">ชื่อสินค้า</th>
                                       <th class="text-center">จำนวน</th>
                                       <th class="text-center">ราคา / หน่วย</th>
                                   </tr>
                               <?php
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
                           <div class="panel-footer text-center">
                               <?php
                               if($order['status_order'] == "รอชำระเงิน" || $order['status_order'] == "เกิดข้อผิดพลาด")
                               {
                               ?>
                               <a class="btn btn-success" href="payment.php?id=<?php echo $id_order; ?>">ชำระเงิน</a>
                               <a class="btn btn-danger" onclick="return confirm('คุณต้องการที่จะยกเลิกรายการสั่งซื้อ ใช่หรือไม่?'); " href="order.php?id=<?php echo $id_order; ?>">ยกเลิก</a>
                               <?php
                               }
                               ?>
                               <a href="print.php?id=<?php echo $id_order;?>" target="_blank" class="btn btn-warning"><span class="glyphicon glyphicon-print"></span></a>
                           </div>
                       </div>
                       <?php
                       }
                       if($sq_order->num_rows == 0)
                       {
                        echo "<h1 class='text-center'>ไม่พบรายการสั่งซื้อ</h1>";

                       }
                       ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>