<?php
    require('./includes/connect.php');
    $db = new db;
    $db->id_empty();
    ob_start();
    if(empty($_SESSION['cart']))
    {
        $db->header2('index.php');
    }
    else
    {
        $id_member = $_SESSION['id'];
        $sq_user = $db->select_where("tb_members","id_member = '$id_member'");
        $user = $sq_user->fetch_assoc();
    }
?>
<?php include('./includes/head.php');?>
<body>

    <div class="container">
        <div  class="panel panel-primary" style="margin-top: 20px;">
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
                        <td></td>
                    </tr>
                    <?php
                    }
                    }
                    else
                    {
                    ?>
                    <tr>
                        <td colspan="6" class="text-center">ไม่พบสินค้าในตระกร้า</td>
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
          
        </div>

        <form action="confirm.php" method="post">
        <div class="panel panel-primary" style="width: 500px; margin:0 auto;">
            <div class="panel-heading text-center">ข้อมูลผู้รับ</div>
            <div class="panel-body">
                <div class="form-group">
                    <label for="firstname">ชื่อจริง</label>
                    <input type="text" id="firstname" value="<?php echo $user['firstname']; ?>" name="firstname" required placeholder="ชื่อจริง" class="form-control">
                </div>
                <div class="form-group">
                    <label for="lastname">นามสกุล</label>
                    <input type="text" id="lastname"name="lastname"  value="<?php echo $user['lastname']; ?>" required placeholder="นามสกุล" class="form-control">
                </div>
                <div class="form-group">
                    <label for="address">ที่อยู่</label>
                    <textarea name="address" id="address" cols="5" rows="5" class="form-control" required placeholder="ที่อยู่ของท่าน" class="form-control"><?php echo $user['address']; ?></textarea>
                </div>
                <div class="form-group">
                    <label for="tel">เบอร์โทร</label>
                    <input type="text" id="tel" name="tel" pattern="[0-9]{10}"  value="<?php echo $user['tel']; ?>" required placeholder="เบอร์โทร (0812923539)" class="form-control">
                </div>
            </div>
            <div class="panel-footer text-center">
                <input type="submit" name="submit" onclick="return confirm('คุณต้องการที่จะ สั่งซื้อใช่หรือไม่?'); " class="btn btn-success" value="ยืนยัน">
                <a href="cart.php" class="btn btn-danger">กลับ</a>
            </div>
        </div>
    </form>
    </div>

 
    
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>

<?php
    if(isset($_POST['submit']))
    {
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $address = $_POST['address'];
        $tel = $_POST['tel'];
        $date = date("Y-m-d H:m:s");

        $od = $db->insert("tb_orders","id_member,firstname,lastname,address,tel,date_order,total_order","'$id_member','$firstname','$lastname','$address','$tel','$date','$total+100'");
        $sq_order = $db->select_where("tb_orders","id_member = '$id_member' ORDER BY id_order DESC");
        $order = $sq_order->fetch_assoc();

        $id_order = $order['id_order'];
        
        foreach($_SESSION['cart'] as $p_id => $qty)
        {
            $sq_product = $db->select_where("tb_products","id_product = '$p_id'");
            $product = $sq_product->fetch_assoc();
            $price_product = ($product['price_product']-$product['discount_product'])-($product['price_product']-$product['discount_product'])*7/100;
            $sum = $price_product*$qty;
            $total += $sum;
            $stock = $product['stock_product']-$qty;
            $like = $product['like_product']+1;

            $de = $db->insert("tb_detail_orders","id_order,id_product,qty,price","'$id_order','$p_id','$qty','$price_product'");
            $update = $db->update("tb_products","stock_product='$stock',like_product='$like'","id_product = '$p_id'");

        }

        if($od && $de && $update)
        {
            $db->alert("สั่งซื้อสินค้าเสร็สิ้น!");
            $db->header("order.php");
            unset($_SESSION['cart']);
        }
        else
        {
            $db->alert("เกิดข้อผิดพลาดในการสั่งซื้อสินค้า!");
            $db->header("confirm.php");
        }
    }
?>