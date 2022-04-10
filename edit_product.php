<?php
    require('./includes/connect.php');
    $db = new db;
    $db->admin_empty();
    if(empty($_GET['id']))
    {
        $db->header2("admin_product.php");
    }

    if(isset($_POST['add']))
    {
        $n= $_POST['name_product'];
        $s= $_POST['stock_product'];
        $d= $_POST['discount_product'];
        $p= $_POST['price_product'];
        $i= $_POST['id_group'];
        $c= $_POST['id_color'];
        $dt= $_POST['detail_product'];
        $id = $_GET['id'];
        
        $insert = $db->update('tb_products',"name_product='$n',stock_product='$s',discount_product='$d',price_product='$p',id_group='$i',id_color='$c',detail_product='$dt'","id_product='$id'");
        if($insert)
        {
            $db->alert('แก้ไขรายการสินค้าสำเร็จ');
            $db->header('admin_product.php');
        }
        else
        {
            $db->alert('เกิดข้อผิดพลาดในการแก้ไขรายการสินค้า!');
            $db->header('edit_product.php');
        }
    }
    $id = $_GET['id'];
    $se_product = $db->select_join_where('tb_products','tb_groups','id_group',"id_product = '$id'");
    $product = $se_product->fetch_assoc();
    
?>
<?php include('./includes/h_admin.php');?>
<body>
    <form action="edit_product.php?id=<?php echo $id;?>" method="post" enctype="multipart/form-data"
        style="padding-bottom:30px;">
        <div class="contanier">
            <div class="panel panel-primary" style="margin: 0 auto; width: 500px; margin-top: 50px;">
                <div class="panel-heading text-center">แก้ไขรายการสินค้า</div>
                <div class="panel-body">
                    <div class="form-group">
                        <label for="name_product">ชื่อสินค้า</label>
                        <input type="text" name="name_product" id="name_product"
                            value="<?php echo $product['name_product'];?>" required
                            placeholder="ชื่อสินค้าที่ต้องการแก้ไข" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="stock_product">จำนวนสินค้า</label>
                        <input type="number" name="stock_product" id="stock_product"
                            value="<?php echo $product['stock_product'];?>" required placeholder="จำนวนของสินค้า"
                            class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="discount_product">ส่วนลด</label>
                        <input type="number" name="discount_product" oninput="vat()"
                            value="<?php echo $product['discount_product'];?>" id="discount_product" required
                            placeholder="ส่วนลด เป็นบาท" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="price_product">ราคาสินค้า</label>
                        <input type="number" name="price_product" oninput="vat()" id="price_product"
                            value="<?php echo $product['price_product'];?>" required placeholder="ราคาสินค้า"
                            class="form-control">
                        <p id="show"></p>
                    </div>
                    <div class="form-group">
                        <label for="id_group">หมวดหมู่สินค้า</label>
                        <select name="id_group" id="id_group" required class="form-control">
                            <option value="<?php echo $product['id_group']; ?>"><?php echo $product['name_group'];  ?>
                            </option>
                            <?php
                            $se_group = $db->select('tb_groups');

                            while($group = $se_group->fetch_assoc())
                            {
                           ?>
                            <option value="<?php echo $group['id_group']; ?>"><?php echo $group['name_group']; ?>
                            </option>
                            <?php
                            }
                           ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="id_color">สี</label>
                        <select name="id_color" id="id_color" required class="form-control">
                            <option value="<?php echo $product['id_color'];?>">
                                <?php
                                $id = $_GET['id'];
                                $se_product = $db->select_join_where('tb_products','tb_colors','id_color',"id_product = '$id'");
                                $product = $se_product->fetch_assoc();

                                echo $product['name_color'];
                                ?>
                            </option>
                            <?php
                            $se_color = $db->select('tb_colors');

                            while($color = $se_color->fetch_assoc())
                            {
                           ?>
                            <option value="<?php echo $color['id_color']; ?>"><?php echo $color['name_color']; ?>
                            </option>
                            <?php
                            }
                           ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="detail_product">รายระเอียดสินค้า</label>
                        <textarea name="detail_product" id="detail_product" required class="form-control" cols="10"
                            rows="5"><?php echo $product['detail_product'];?></textarea>
                    </div>
                </div>
                <div class="panel-footer text-center">
                    <a href="admin_product.php" class="btn btn-danger">กลับ</a>
                    <input type="submit" value="แก้ไขรายการสินค้า" name="add" id="add"
                        onclick="return confirm('ต้องการแก้ไขรายการสินค้าใช่ หรือ ไม่')" class="btn btn-success">
                </div>
    </form>

    </div>
    </div>

    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script>
    function vat() {
        var price = parseInt(document.getElementById('price_product').value);
        var discount = parseInt(document.getElementById('discount_product').value);
        var total = (price - discount) + (price - discount) * 7 / 100;
        if (!isNaN(price) && !isNaN(discount)) {
            document.getElementById('show').innerHTML = "ราคาสุทธิ " + total + ' บาท';
        } else {
            document.getElementById('show').innerHTML = "";
        }
    }
    </script>
</body>

</html>