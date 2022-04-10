<?php
    require('./includes/connect.php');
    $db = new db;
?>
<?php include('./includes/head.php');?>

<body>

    <?php include('./includes/navbar.php'); ?>
    <div class="container">
        <div class="col-lg-12" style="padding-top: 10px;">
            <?php include('./includes/carousel.php'); ?>
            <div class="row" style="padding-top:30px;">
                <div class="col-lg-3">
                    <?php include('./includes/group.php'); ?>
                </div>
                <div class="col-lg-9">
                    <?php include('./includes/nav.php'); ?>
                    <div style="margin-top: 20px;" class="panel panel-primary">
                        <div class="panel-heading text-center">วิธีการสั่งซื้อ</div>
                        <div class="panel-body">
                            <?php
                                $sq_htb = $db->select("tb_howtobuys");
                                while($htb = $sq_htb->fetch_assoc())
                                {
                            ?>
                            <div class="col-lg-12">
                                <h4><i class="fa-solid fa-1" style='font-size:45px;'></i><span style="padding-left: 20px; font-size:30px;"><?php echo $htb['text1']; ?></span></h4><br>
                                <h4><i class="fa-solid fa-2" style='font-size:50px;'></i><span style="padding-left: 20px; word-break:break-all; font-size:30px;"><?php echo $htb['text2']; ?></span></h4><br>
                                <h4><i class="fa-solid fa-3" style='font-size:50px;'></i><span style="padding-left: 20px; font-size:30px;"><?php echo $htb['text3']; ?></span></h4><br>
                                <h4><i class="fa-solid fa-4" style='font-size:50px;'></i><span style="padding-left: 20px; font-size:30px;"><?php echo $htb['text4']; ?></span></h4><br>
                                <h4><i class="fa-solid fa-5" style='font-size:50px;'></i><span style="padding-left: 20px; font-size:30px;"><?php echo $htb['text5']; ?></span></h4><br>
                                <h4><i class="fa-solid fa-6" style='font-size:50px;'></i><span style="padding-left: 20px; font-size:30px;"><?php echo $htb['text6']; ?></span></h4><br>
                            </div>
                            <?php
                                }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>

</html>