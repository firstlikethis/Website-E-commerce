<?php

   $cart = (!empty($_SESSION['cart']) ? count($_SESSION['cart']) : 0 );
?>

<nav class="navbar navbar-default">
    <div class="container">
        <div class="container-fluid">
            <div class="navbar-header">
                <button class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar1" aria-expanded="false" role="button">
                    <span class="sr-only">Toggle</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a href="index.php" class="navbar-brand">
                    <img src="Images/UI/logo1.png" height="30px" alt="No Image">
                </a>
            </div>

            <div id="navbar1" class="navbar-collapse collapse">
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="cart.php"><span><i class="fa-solid fa-cart-shopping"></i> <?php echo number_format($cart); ?></span> ตระกร้าสินค้า</a></li>
                    <?php
                    if(isset($_SESSION['id']))
                    {                
                        $id_member = $_SESSION['id'];
                        $sq_user = $db->select_where("tb_members","id_member = '$id_member'");
                        $user = $sq_user->fetch_assoc();
                    ?>
                    <li class="dropdown">
                        <a href="" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false" aria-haspopup="true" role="button">
                            <span class="glyphicon glyphicon-user"></span>
                            คุณ <?php echo $user['firstname'].' '.$user['lastname']; ?>
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <?php
                            if($_SESSION['status'] == "admin")
                            {
                                echo "<li><a href='admin.php'> <i class='fa-solid fa-warehouse'></i> ระบบหลังบ้าน</a></li>";
                            }
                            ?>
                            <li><a href="order.php"><i class="fa-solid fa-list-ol"></i> รายการสั่งซื้อ</a></li>
                            <li><a href="profile.php"><i class="fa-solid fa-user-pen"></i> แก้ไขข้อมูลส่วนตัว</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="logout.php"><i class="fa-solid fa-right-from-bracket"></i> ออกจากระบบ</a></li>
                        </ul>
                    </li>
                    <?php
                    }
                    else
                    {
                    ?>
                        <li><a href="login.php"><i class="fa-solid fa-right-to-bracket"></i> เข้าสู่ระบบ</a></li>
                        <li><a href="register.php"><i class="fa-solid fa-user-plus"></i> สมัครสมาชิก</a></li>
                    <?php
                    }
                    ?>
                </ul>
                <form class="navbar-form navbar-right" action="search.php" method="get">
                    <div class="form-group">
                        <input type="search" name="search" required placeholder="ค้นหาสินค้า" class="form-control" id="search">
                        <button class="btn btn-primary"> <span><i class="fa-solid fa-magnifying-glass"></i></span></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</nav>