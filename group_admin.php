<div class="panel panel-primary">
    <div class="panel-heading text-center"><b>เมนู</b></div>
    <div class="list-group">
        <li><a href="admin_member.php" class="list-group-item"><b>จัดการข้อมูลสมาชิก</b></a></li>
        <li><a href="admin_product.php" class="list-group-item"><b>จัดการข้อมูลรายการสินค้า</b></a></li>
        <li><a href="admin_group.php" class="list-group-item"><b>จัดการข้อมูลหมวดหมู่สินค้า</b></a></li>
        <li><a href="admin_color.php" class="list-group-item"><b>จัดการตัวเลือกสีสินค้า</b></a></li>
        <li><a href="admin_order.php" class="list-group-item"><b>จัดการข้อมูลรายการสั่งซื้อ</b></a></li>
        <li><a href="admin_contact.php" class="list-group-item"><b>จัดการข้อมูลร้านค้า</b></a></li>
        <li><a href="admin_payment.php" class="list-group-item"><b>จัดการข้อมูลชำระเงิน</b></a></li>
        <li><a href="admin_howtobuy.php" class="list-group-item"><b>จัดการวิธีการสั่งซื้อ</b></a></li>
    </div>
</div>
<div class="panel panel-primary">
    <div class="panel-heading text-center"><b>รายการสินค้าใกล้จะหมด</b></div>
    <table class="table table-hover">
        <tr>
            <th class="text-center">รหัสสินค้า</th>
            <th class="text-center">ชื่อสินค้า</th>
            <th class="text-center">จำนวนสินค้า</th>
            <th class="text-center">จัดการ</th>
        </tr>
        <?php
            $se_pro = $db->select('tb_products');
            while($sql = $se_pro->fetch_assoc())
            {
                if($sql['stock_product'] <=5)
                {
        ?>
        <tr class="text-center">
                    <td><?php echo $sql['id_product']; ?></td>
                    <td><?php echo $sql['name_product']; ?></td>
                    <td><?php echo $sql['stock_product']; ?></td>
                    <td>
                        <a href="edit_product.php?id=<?php echo $sql['id_product']; ?>" class="btn btn-warning"><span class="glyphicon glyphicon-pencil"></span></a>
                </td>
        </tr>
        <?php
                }
            }
        ?>
    </table>
</div>