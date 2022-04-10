<?php
    require('./includes/connect.php');
    $db = new db;
    $db->admin_empty();

    if(empty($_GET['id']))
    {
        $db->header2("index.php");
    }
    else
    {
        $id_product = $_GET['id'];
    }
?>
<?php include('./includes/h_admin.php');?>
<body>

    <div class="container">
        <div style="margin:20px;">
        <?php
                $sq_comment = $db->select_join_where("tb_comments","tb_members","id_member","id_product = '$id_product'");
                while($comment = $sq_comment->fetch_assoc())
                {
                    $id = $comment['id_member'];
                    $sq_order = $db->select_join_where("tb_orders","tb_detail_orders","id_order","id_member='$id' AND tb_detail_orders.id_product = '$id_product' AND status_order = 'จัดส่งเสร็จสิ้น'");
                ?>
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        คุณ <?php echo $comment['firstname'].' '.$comment['lastname'];?>
                        <?php
                        if($sq_order->num_rows > 0)
                        {
                        ?>
                        <span style="color:gold;" class="glyphicon glyphicon-shopping-cart">ซื้อแล้ว</span>
                        <?php
                        }
                        $sq_star_check_1 = $db->select_where("tb_stars","id_member = '$id' AND id_product= '$id_product'");
                        if($sq_star_check_1->num_rows == 1)
                        {
                            $star_1 = $sq_star_check_1->fetch_assoc();
                        ?>
                        <span style="color:coral;" class="glyphicon glyphicon-star"><?php echo $star_1['star']; ?>คะแนน</span>
                        <?php
                        }
                        ?>
                    </div>
                    <div class="panel-body">
                        <h4><?php echo $comment['comment']; ?></h4>
                    </div>
                    <div class="panel-footer">
                        เวลา <?php echo $comment['date_comment']; ?>
                    </div>
                </div>
                <?php
                }
                if($sq_comment->num_rows == 0)
                {
                    echo "<h1 class='text-center' style='color:green;'>ไม่พบความคิดเห็น</h1>";
                }
                ?>

        </div>
    </div>
    
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>