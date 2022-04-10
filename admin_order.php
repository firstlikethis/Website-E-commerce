<?php
    require('./includes/connect.php');
    $db = new db;
    $db->admin_empty();
    if(isset($_GET['id']))
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
            $db->header("admin_order.php");
        }
        else
        {
            $db->alert("เกิดข้อผิดพลาดในการยกเลิก!");
            $db->header("admin_order.php");
        }
    }

    $day = date("d");
    $month = date("m");
    $year = date("Y");
    
?>
<?php include('./includes/h_admin.php');?>
<body>
    <div class="contanier">
        <div class="text-right" style="margin-top: 10px; width: 95%;">
            <a href="admin.php" class="btn btn-danger">กลับ</a>
        </div>
        <div class="col-lg-3" style="margin-top: 10px;">
            <?php include('group_admin.php');?>
        </div>
            <div class="col-lg-9" style="margin-top: 10px;">
                <div class="col-lg-12">
                    <div class="col-lg-3">
                        <form action="" method="GET">
                            <input type="text" name="search" id="search" placeholder="ค้นหาหมายเลขสั่งซื้อ" class="form-control">
                            <button type="submit" class="btn btn-primary btn-block"><span class="glyphicon glyphicon-search"></span></button>
                        </form>
                    </div>
                </div>
                <div class="col-lg-12" style="margin-top: 10px;">
                    <div class="panel panel-primary">
                        <div class="panel-heading  text-center"><b>ข้อมูลรายการสั่งซื้อ</b></div>
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
                                <th class="text-center">จัดการ</th>
                            </tr>
                            <?php
                             if(!empty($_GET['search']))
                             {
                             $search = $_GET['search'];
                             $se_product = $db->select_where('tb_orders',"firstname LIKE '%$search%' OR lastname LIKE '%$search%' OR id_order LIKE '$search'");
                             }
                            else
                            {
                                $se_product = $db->select('tb_orders');
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
                                <td>
                                    <a href="edit_order.php?id=<?php echo $product['id_order'];?>" class="btn btn-warning"><span class="glyphicon glyphicon-pencil"></span></a>
                                    <a href="admin_order.php?id=<?php echo $product['id_order'];?>" onclick="return confirm('ต้องการลบรายการสั่งซื้อสินค้านี้ ใช่ หรือ ไม่')" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span></a>
                                </td>
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