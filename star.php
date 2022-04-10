<?php
    require('./includes/connect.php');
    $db = new db;
    $db->id_empty();

    if(empty($_GET['id']))
    {
        $db->header2("index.php");
    }
    else
    {
        $id_product = $_GET['id'];
        $id_member = $_SESSION['id'];
        $sq_star_order = $db->select_join_where("tb_orders","tb_detail_orders","id_order","id_member = '$id_member' AND tb_detail_orders.id_product = '$id_product' AND status_order = 'จัดส่งเสร็จสิ้น'");
        if($sq_star_order->num_rows > 0)
        {
            $sq_star_check = $db->select_where("tb_stars","id_member = '$id_member' AND id_product= '$id_product'");
            if($sq_star_check->num_rows > 0)
            {
                $db->header2("index.php");
            }
        }
        else
        {
            $db->header2("index.php");
        }
    }


    if(isset($_POST['submit']))
    {
        $star = $_POST['star'];
        $date = date("Y-m-d H:m:s");
        $insert = $db->insert("tb_stars","id_product,id_member,star,star_date","'$id_product','$id_member','$star','$date'");
        if($insert)
        {
            $db->alert("ให้คะแนนเสร็จสิ้น");
            $db->header("product.php?id=".$id_product);
        }
        else
        {
            $db->alert("เกิดข้อผิดพลาดในการให้คะแนน");
            $db->header("product.php?id=".$id_product);
        }
    }
?>
<?php include('./includes/head.php');?>
<body>

    <div class="container">
        <form action="" method="post">
            <div style="margin: 20px auto; width:500px;" class="panel panel-primary">
                <div class="panel-heading text-center">ให้คะแนน</div>
                <div class="panel-body">
                <div class="form-group">
                        <label for="star">คะแนน</label>
                        <select name="star" id="star" required class="form-control">
                            <option value="5">5</option>
                            <option value="4">4</option>
                            <option value="3">3</option>
                            <option value="2">2</option>
                            <option value="1">1</option>
                        </select>
                    </div>
                    <input type="submit" name="submit" onclick="return confirm('คุณต้องการที่จะให้คะแนนใช่หรือไม่?');" class="btn btn-success btn-block" value="ยืนยัน">
                    <a href="product.php?id=<?php echo $_GET['id']; ?>" class="btn btn-danger btn-block">กลับ</a>
                </div>
            </div>
        </form>
    </div>
    
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>