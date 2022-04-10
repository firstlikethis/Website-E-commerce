<?php
    require('./includes/connect.php');
    $db = new db;
    
?>

<?php include('./includes/head.php');?>

<body>

    <?php include('./includes/navbar.php'); ?>
    <div class="container">
        <div class="col-lg-12" style="padding-top:10px;">
            <?php include('./includes/carousel.php'); ?>
            <div class="row" style="padding-top: 30px;">
                <div class="col-lg-3">
                    <?php include('./includes/group.php'); ?>
                </div>
                <div class="col-lg-9">
                    <?php include('./includes/nav.php'); ?>
                    <div style="margin-top: 20px;" class="panel panel-primary">
                        <div class="panel-heading text-center">รายระเอียดร้านค้า</div>
                        <div class="panel-body">
                            <?php
                                $sq_contact = $db->select("tb_contacts");
                                while($contact = $sq_contact->fetch_assoc())
                                {
                            ?>
                            <div class="col-lg-12">
                                <h4><i class="fa-solid fa-store" style='font-size:50px;'></i><span style="padding-left: 20px; font-size:30px;"><?php echo $contact['s_name']; ?></span></h4><br>
                                <h4><i class="fa-solid fa-location-dot" style='font-size:50px;'></i><span style="padding-left: 20px; word-break:break-all; font-size:30px;"><?php echo $contact['s_adress']; ?></span></h4><br>
                                <h4><i class="fa-brands fa-facebook" style='font-size:50px;'></i><span style="padding-left: 20px; font-size:30px;"><?php echo $contact['s_facebook']; ?></span></h4><br>
                                <h4><i class="fa-brands fa-line" style='font-size:50px;'></i><span style="padding-left: 20px; font-size:30px;"><?php echo $contact['s_line']; ?></span></h4><br>
                                <h4><i class="fa-solid fa-square-phone" style='font-size:50px;'></i><span style="padding-left: 20px; font-size:30px;"><?php echo $contact['s_tel']; ?></span></h4><br>
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