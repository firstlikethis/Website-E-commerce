<?php
    require('./includes/connect.php');
    $db = new db;
    $db->admin_empty();
    if(isset($_GET['id']))
    {
        $id = $_GET['id'];
        if($db->delete('tb_orders',"id_order = '$id'"))
        {
            $db->alert('ลบรายการสั่งซื้อสินค้าสำเร็จ');
            $db->header('admin_order.php');
        }
        else
        {
            $db->alert('เกิดข้อผิดพลาดในการลบรายการสั่งซื้อสินค้า!');
            $db->header('admin_order.php');
        }
    }

    $day = date("d");
    $day_last = date("d")-1;
    $month = date("m");
    $years = date("Y");
    $year_last = date("Y")-1;
    if(!empty($_GET['search']))
    {
        $search = $_GET['search'];
    }
    else
    {
        $search = '';
    }
    if(!empty($_GET['mode']))
    {
        $mode = $_GET['mode'];
    }
    else
    {
        $mode = '';
    }

    if($mode == "lastday")
    {
        $text = "ยอดขายเมื่อวาน";
    }
    else if($mode == "today")
    {
        $text = "ยอดขายวันนี้";

    }
    else if($mode == "lastyear")
    {
        $text = "ยอดขายปีนี้";

    }
    else if($mode == "toyear")
    {
        $text = "ยอดขายปีที่แล้ว";

    }
?>
<?php include('./includes/head.php');?>
<body>
    <div class="contanier">
        <div class="text-right" style="margin-top: 10px; width: 95%;">
            <a href="admin.php" class="btn btn-danger">กลับ</a>
        </div>
        <div class="col-lg-3" style="margin-top: 10px;">
            <?php include('group_admin.php');?>
        </div>
            <div class="col-lg-9" style="margin-top: 10px;">
                <div class="col-lg-12 text-center">
                    <h1 style="color:white;"><?php echo $text; ?></h1>
                </div>
                <div class="col-lg-12" style="margin-top: 10px;">
                    <div class="panel panel-primary">
                        <div class="panel-heading  text-center">ข้อมูลรายการสั่งซื้อ</div>
                        <table class="table table-hover">
                            <tr>
                                <th class="text-center">หมายเลขสั่งซื้อ</th>
                                <th class="text-center">ข้อมูลผู้รับ</th>
                                <th class="text-center">วันที่สั่งซื้อ</th>
                                <th class="text-center">วันที่ชำระเงิน</th>
                                <th class="text-center">ช่องทางที่ชำระเงิน</th>
                                <th class="text-center">ราคารวม</th>
                                <th class="text-center">หลักฐาน</th>
                                <th class="text-center">รายละเอียดสินค้า</th>
                                <th class="text-center">สถานะ</th>
                                <th class="text-center">หมายเลขพัสดุ</th>
                            </tr>
                            <?php
                            if($mode == "lastday")
                            {
                                $se_product = $db->select_where("tb_orders","DAY(date_order) = '$day_last' AND MONTH(date_order) = '$month' AND YEAR(date_order) = '$years' AND status_order = 'ชำระเงินเสร็จสิ้น'");
                            }
                            else if($mode == "today")
                            {
                                $se_product = $db->select_where("tb_orders","DAY(date_order) = '$day' AND MONTH(date_order) = '$month' AND YEAR(date_order) = '$years' AND status_order = 'ชำระเงินเสร็จสิ้น'");
                            }
                            else if($mode == "lastyear")
                            {
                                $se_product = $db->select_where("tb_orders","YEAR(date_order) = '$year_last' AND status_order = 'ชำระเงินเสร็จสิ้น'");
                            }
                            else if($mode == "toyear")
                            {
                                $se_product = $db->select_where("tb_orders","YEAR(date_order) = '$years' AND status_order = 'ชำระเงินเสร็จสิ้น'");
                            }
                            else
                            {
                                $se_product = $db->select("tb_orders");

                            }
                            while($product = $se_product->fetch_assoc()) 
                            { 
                               $idm = $product['id_order'];                             
                            ?>
                            <tr class="text-center">
                                <td><?php echo $product['id_order'];?></td>
                                <td>
                                <a href="order_user.php?id=<?php echo $product['id_order'];?>" target="popup" onclick="window.open('order_user.php?id=<?php  echo $idm; ?>','_blank','width=600,height=500')" class="btn btn-primary"><span class="glyphicon glyphicon-user"></span></a>
                                </td>
                                <td><?php echo $product['date_order'];?></td>
                                <td><?php echo $product['date_payment'];?></td>
                                <td><?php echo $product['payment'];?></td>
                                <td><?php echo number_format($product['total_order']);?></td>

                                <td>
                                <button onclick="window.open('Images/Orders/<?php echo $product['image_order'];?>','_blank','width=500,height=600');" class="btn btn-info"><span class="glyphicon glyphicon-picture"></span></button>

                                </td>
                                <td>
                                <button onclick="window.open('detail_order.php?id=<?php echo $product['id_order']; ?>','_blank','width=600,height=600');" class="btn btn-success"><span class="glyphicon glyphicon-shopping-cart"></span></button>

                                </td>
                                <td><?php echo $product['status_order'];?></td>
                                <td><?php echo $product['tracking_number'];?></td>
                            </tr>
                            <?php
                            }
                            ?>
                        </table>
                        <?php
                          if($se_product->num_rows == 0)
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