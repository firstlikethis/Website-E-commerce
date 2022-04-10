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
                        <div class="panel-heading text-center"><b>รายระเอียดร้านค้า</b></div>
                        <div class="panel-body">
                            <table class="table table-hover">
                                <tr>
                                    <th class="text-center">เลขบัญชี</th>
                                    <th class="text-center">ธนาคาร</th>
                                    <th class="text-center">ชื่อเจ้าของบัญชี</th>
                                </tr>
                                <?php
                                    $se_payment = $db->select('tb_howtopayments');
                                    while($payment = $se_payment->fetch_assoc()) 
                                    { 
                                       $idm = $payment['id_payment'];                             
                                    ?>
                                    <tr class="text-center">
                                        <td><?php echo $payment['bank_acc'];?></td>
                                        <td><?php echo $payment['bank_name'];?></td>
                                        <td><?php echo $payment['holder_name'];?></td>
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
    </div>

    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>

</html>