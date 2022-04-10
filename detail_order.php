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
        $sq_order = $db->select_where("tb_orders","id_order = '$id_order'");
        $order = $sq_order->fetch_assoc();
    }
?>
<?php include('./includes/h_admin.php');?>
<body>

    <div class="container">
        <form action="" method="post">
            <div style="margin: 20px auto; width:500px;" class="panel panel-primary">
                <div class="panel-heading text-center">ข้อมูลผู้รับ</div>
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
                        </table>
            </div>
            </div>
        </form>
    </div>
    
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>