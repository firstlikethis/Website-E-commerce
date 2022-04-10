<?php
    require('./includes/connect.php');
    $db = new db;
    $db->admin_empty();
    if(isset($_POST['add']))
    {
        $n= $_POST['name_product'];
        $s= $_POST['stock_product'];
        $d= $_POST['discount_product'];
        $p= $_POST['price_product'];
        $i= $_POST['id_group'];
        $c= $_POST['id_color'];
        $dt= $_POST['detail_product'];
        
        if(empty($_FILES['image_product']['name']))
        {
            $image_encode = 'empty.png';
        }
        else
        {
            $real_image = pathinfo(basename($_FILES['image_product']['name']),PATHINFO_EXTENSION);
            $image_encode = 'Product_'.uniqid().'.'.$real_image;
            $image_path = 'Images/Products/';
            $image_success = $image_path.$image_encode;
            $success = move_uploaded_file($_FILES['image_product']['tmp_name'],$image_success);
            if($success == FALSE)
            {

                $db->alert('เกิดข้อผิดพลาดในการอัพโหลดรูปภาพ!');
                $db->header('add_product.php');
            }
        }
        
        $insert = $db->insert('tb_products','name_product,stock_product,discount_product,price_product,id_group,id_color,detail_product,image_product',"'$n','$s','$d','$p','$i','$c','$dt','$image_encode'");
        if($insert)
        {
            $db->alert('เพิ่มรายการสินค้าสำเร็จ');
            $db->header('add_product.php');
        }
        else
        {
            $db->alert('เกิดข้อผิดพลาดในการเพิ่มรายการสินค้า!');
            $db->header('add_product.php');
        }
    }

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include('./includes/hadd_admin.php');?>
</head>
<body>
    <form action="" method="post" enctype="multipart/form-data" style="padding-bottom:30px;">
    <div class="contanier">
        <div class="panel panel-primary" style="margin: 0 auto; width: 420px; margin-top: 50px;">
            <div class="panel-heading text-center">เพิ่มรายการสินค้า</div>
                <div class="panel-body">
                    <div class="form-group">
                        <label for="name_product">ชื่อสินค้า</label>
                        <input type="text" name="name_product" id="name_product" required placeholder="ชื่อสินค้าที่ต้องการเพิ่ม" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="stock_product">จำนวนสินค้า</label>
                        <input type="number" min="0" name="stock_product" id="stock_product" required placeholder="จำนวนของสินค้า" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="discount_product">ส่วนลด</label>
                        <input type="number" min="0" name="discount_product" oninput="vat()" id="discount_product" required placeholder="ส่วนลด เป็นบาท" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="price_product">ราคาสินค้า</label>
                        <input type="number" min="0" name="price_product" oninput="vat()" id="price_product" required placeholder="ราคาสินค้า" class="form-control">
                        <p id="show"></p>
                    </div>
                    <div class="form-group">
                        <label for="id_group">หมวดหมู่สินค้า</label>
                       <select name="id_group" id="id_group" required class="form-control" >
                           <option value="">---------</option>
                           <?php
                            $se_group = $db->select('tb_groups');

                            while($group = $se_group->fetch_assoc())
                            {
                           ?>
                           <option value="<?php echo $group['id_group']; ?>"><?php echo $group['name_group']; ?></option>
                           <?php
                            }
                           ?>
                       </select>
                    </div>
                    <div class="form-group">
                        <label for="id_color">สี</label>
                       <select name="id_color" id="id_color" required class="form-control" >
                           <option value="">---------</option>
                           <?php
                            $se_color = $db->select('tb_colors');

                            while($color = $se_color->fetch_assoc())
                            {
                           ?>
                           <option value="<?php echo $color['id_color']; ?>"><?php echo $color['name_color']; ?></option>
                           <?php
                            }
                           ?>
                       </select>
                    </div>
                    <div class="form-group mt-2">
                          <label>รายละเอียด</label>
                          <textarea name="detail_product" id="detail_product" class="form-control form-control" rows="3" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="image_product">รูปถ่ายสินค้า</label>
                        <input type="file" name="image_product" accept="image/*" id="image_product">
                        <p class="help-block">รูปถ่ายสินค้า</p>
                    </div>
                </div>
                <div class="panel-footer text-center">
                    <a href="admin_product.php" class="btn btn-danger">กลับ</a>
                    <input type="submit" value="เพิ่มรายการสินค้า" name="add" id="add" onclick="return confirm('ต้องการเพิ่มรายการสินค้าใช่ หรือ ไม่')" class="btn btn-success">
                </div>
            </form>

        </div>
    </div>
    
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/summernote/summernote-bs4.min.js"></script>
    <script src="js/summernote/lang/summernote-th-TH.js"></script>
    <script>

        $(function() {
            $('[name="detail_product"]').summernote({lang: 'th-TH'});            
        });

        function vat()
        {
            var price = parseInt(document.getElementById('price_product').value);
            var discount = parseInt(document.getElementById('discount_product').value);
            var total = (price-discount)-(price-discount)*7/100;
            if(!isNaN(price) && !isNaN(discount))
            {
                document.getElementById('show').innerHTML = "ราคาสุทธิ "+total+' บาท';
            }
           else
           {
                document.getElementById('show').innerHTML = "";
           }
        }
    </script>
</body>
</html>