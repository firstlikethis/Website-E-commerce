<?php
    require('./includes/connect.php');
    $db = new db;
    $db->admin_empty();
    if(isset($_GET['id']))
    {
        $id = $_GET['id'];
        if($db->delete('tb_products',"id_product = '$id'"))
        {
            $db->alert('ลบรายการสินค้าสำเร็จ');
            $db->header('admin_product.php');
        }
        else
        {
            $db->alert('เกิดข้อผิดพลาดในการลบรายการสินค้า!');
            $db->header('admin_product.php');
        }
    }
    
?>
<?php include('./includes/h_admin.php');?>
<body>
    <div class="contanier">
        <div class="text-right" style="margin-top: 10px; width: 95%;">
            <a href="add_product.php" class="btn btn-primary">เพิ่มสินค้า</a>
            <a href="admin.php" class="btn btn-danger">กลับ</a>
        </div>
        <div class="col-lg-3" style="margin-top: 10px;">
            <?php include('group_admin.php');?>
        </div>
            <div class="col-lg-9" style="margin-top: 10px;">
                <div class="col-lg-12">
                    <div class="col-lg-3">
                        <form action="" method="GET">
                            <input type="text" name="search" id="search" placeholder="ค้นหาสินค้า" class="form-control">
                            <button type="submit" class="btn btn-primary btn-block"><span class="glyphicon glyphicon-search"></span></button>
                        </form>
                    </div>
                </div>
                <div class="col-lg-12" style="margin-top: 10px;">
                    <div class="panel panel-primary">
                        <div class="panel-heading  text-center"><b>ข้อมูลรายการสินค้า</b></div>
                        <table class="table table-hover">
                            <tr>
                                <th class="text-center">รหัส</th>
                                <th class="text-center">ชื่อสินค้า</th>
                                <th class="text-center">จำนวนสินค้า</th>
                                <th class="text-center">ราคาสินค้า</th>
                                <th class="text-center">ส่วนลด</th>
                                <th class="text-center">รายระเอียดสินค้า</th>
                                <th class="text-center">รูปถ่ายสินค้า</th>
                                <th class="text-center">ความคิดเห็น</th>
                                <th class="text-center">จัดการ</th>
                            </tr>
                            <?php
                             if(!empty($_GET['search']))
                             {
                             $search = $_GET['search'];
                             $se_product = $db->select_where('tb_products',"name_product LIKE '%$search%'");
                             }
                            else
                            {
                                $se_product = $db->select('tb_products');
                            }
                            while($product = $se_product->fetch_assoc()) 
                            { 
                               $idm = $product['id_product'];                             
                            ?>
                            <tr class="text-center">
                                <td><?php echo $product['id_product'];?></td>
                                <td><?php echo $product['name_product'];?></td>
                                <td><?php echo number_format($product['stock_product']);?></td>
                                <td><?php echo number_format($product['price_product']);?></td>
                                <td><?php echo number_format($product['discount_product']);?></td>
                                <td> 
                                    <a href="detail_product.php?id=<?php echo $product['id_product'];?>" target="popup" onclick="window.open('detail_product.php?id=<?php  echo $idm; ?>','_blank','width=1000,height=200;')" class="btn btn-primary"><span class="glyphicon glyphicon-menu-hamburger"></span></a>
                                </td>
                                <td>
                                <button onclick="window.open('Images/Products/<?php echo $product['image_product'];?>','_blank','width=500,height=600');" class="btn btn-info"><span class="glyphicon glyphicon-picture"></span></button>
                                </td>
                                <td>
                                    <button onclick="window.open('admin_comment.php?id=<?php echo $product['id_product']; ?>','_blank','width=500,height=600');" class="btn btn-success"><span class="glyphicon glyphicon-comment"></span></button>
                                </td>
                                <td>
                                    <a href="edit_product.php?id=<?php echo $product['id_product'];?>" class="btn btn-warning"><span class="glyphicon glyphicon-pencil"></span></a>
                                    <a href="admin_product.php?id=<?php echo $product['id_product'];?>" onclick="return confirm('ต้องการลบรายการสินค้านี้ ใช่ หรือ ไม่')" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span></a>
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