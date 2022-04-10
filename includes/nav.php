

<ul class="breadcrumb">
    <li><a href="index.php"><i class="fa-solid fa-house"></i> หน้าแรก</a></li>
    <?php
    if(isset($_SESSION['id']))
    {
        echo "<li><a href='order.php'><i class='fa-solid fa-list-ol'></i> รายการสั่งซื้อ</a></li>";
        if($_SESSION['status'] == "admin")
        {
            echo "<li><a href='admin.php'> <i class='fa-solid fa-warehouse'></i> ระบบหลังบ้าน</a></li>";
        }
    }
    ?>
    <li><a href="promotion.php"><i class="fa-solid fa-rectangle-ad"></i> โปรโมชั่น</a></li>
    <li><a href="howtobuy.php"><i class="fa-solid fa-bag-shopping"></i> วิธีการสั่งซื้อ</a></li>
    <li><a href="howtopayment.php"><i class="fa-solid fa-money-bill-1"></i> ช่องทางการชำระเงิน</a></li>
    <li><a href="contact.php"><i class="fa-solid fa-store"></i> ติดต่อเรา</a></li>
</ul>