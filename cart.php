<?php
    require('./includes/connect.php');
    $db = new db;

    $p_id = (!empty($_GET['p_id']) ? $_GET['p_id'] : '');
    $status = (!empty($_GET['status']) ? $_GET['status'] : '');

    if(!empty($p_id) && $status =="add")
    {
        if(isset($_SESSION['cart'] [$p_id]))
        {
            $_SESSION['cart'] [$p_id]++;
        }
        else
        {
            $_SESSION['cart'] [$p_id]=1;
        }
    }
    if(!empty($p_id) && $status =="remove")
    {
        unset($_SESSION['cart'] [$p_id]);
    }
    if(isset($_POST['reprice']))
    {
        if(!empty($_SESSION['cart']))
        {
            $amount_arry = $_POST['amount'];
            foreach($amount_arry as $p_id => $amount)
            {
                $_SESSION['cart'] [$p_id]= $amount;
            }

        }
        else
        {
            $db->alert("ไม่พบสินค้าในตะกร้า");
        }
    }
    
    if(isset($_POST['submit']))
    {
        if(!empty($_SESSION['cart']))
        {
            $amount_arry = $_POST['amount'];
            foreach($amount_arry as $p_id => $amount)
            {
                $_SESSION['cart'] [$p_id]= $amount;
            }
            if(isset($_SESSION['id']))
            {
                $db->header2("confirm.php");
            }
            else
        {
            $db->alert("กรุณาเข้าสู่ระบบก่อน");
            $db->header("login.php");
        }
    }
        else
        {
            $db->alert("ไม่พบสินค้าในตะกร้า");
        }
    }
?>
<?php include('./includes/head.php');?>
<body>

    <div class="container">
        <form action="cart.php" method="post">
        <div class="panel panel-primary" style="margin: 120px auto;">
            <div class="panel-heading text-center">ตระกร้าสินค้า</div>
            <div class="panel-body">
                <table width="100%">
                    <tr>
                        <th class="text-center" width="5%">ลำดับ</th>
                        <th class="text-center">ชื่อสินค้า</th>
                        <th class="text-center" width="10%">ราคา / หน่วย</th>
                        <th class="text-center" width="10%">จำนวน</th>
                        <th class="text-center" width="15%">ราคารวม</th>
                        <th class="text-center" width="5%"></th>
                    </tr>

                    <?php
                    $total = 0;
                    $i = 0;
                    if(!empty($_SESSION['cart']))
                    {
                        foreach($_SESSION['cart'] as $p_id => $qty)
                        {
                            $sq_product = $db->select_where("tb_products","id_product = '$p_id'");
                            $product = $sq_product->fetch_assoc();
                            $price_product = ($product['price_product']-$product['discount_product'])-($product['price_product']-$product['discount_product'])*7/100;
                            $sum = $price_product*$qty;
                            $total += $sum;
                            $i++;
                    ?>
                    <tr class="text-center">
                        <td><?php echo $i; ?></td>
                        <td><?php echo $product['name_product']; ?></td>
                        <td><?php echo number_format($price_product); ?></td>
                        <td><input type="number" min="1" max="<?php echo $product['stock_product']; ?>" required  name="amount[<?php echo $p_id; ?>]" value="<?php echo $qty; ?>" class="form-control"></td>
                        <td><?php echo number_format($sum); ?></td>
                        <td><a onclick="return confirm('คุณต้องการที่จะลบรายการสินค้าใชหรือไม่?'); " href="cart.php?p_id=<?php echo $p_id; ?>&status=remove" style="color: red;"><span class="glyphicon glyphicon-remove"></span></a></td>
                    </tr>
                    <?php
                    }
                    }
                    else
                    {
                    ?>
                    <tr>
                        <td colspan="6" class="text-center" style="padding:20px;">ไม่พบสินค้าในตระกร้า</td>
                    </tr>
                    <?php
                    }
                    ?>



                    <tr>
                        <th class="text-center" colspan="4">ราคารวม</th>
                        <th class="text-center"><?php echo number_format($total); ?></th>
                        <th></th>
                    </tr>
                    <tr>
                        <th class="text-center" colspan="4">ภาษี</th>
                        <th class="text-center"><?php echo number_format($total*7/107); ?></th>
                        <th></th>
                    </tr>
                    <tr>
                        <th class="text-center" colspan="4">ค่าจัดส่ง</th>
                        <th class="text-center">100</th>
                        <th></th>
                    </tr>
                    <tr>
                        <th class="text-center" colspan="4">ราคาสุทธิ</th>
                        <th class="text-center"><?php echo number_format($total+100); ?></th>
                        <th class="text-center">บาท</th>
                    </tr>
                </table>
            </div>
            <div class="panel-footer text-center">
                <input type="submit" value="คำนวนราคาใหม่" name="reprice"  class="btn btn-warning">
                <input type="submit" value="สั่งซื้อ" name="submit" onclick="return confirm('คุณต้องการที่จะ สั่งซื้อใช่หรือไม่?'); " class="btn btn-success">
                <a href="index.php" class="btn btn-danger">กลับ</a>
            </div>
        </div>
    </form>
    </div>

 
    
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>