<?php
    require('./includes/connect.php');
    $db = new db;
    if(!empty($_GET['id']))
    {
        $id_product = $_GET['id'];
        if(isset($_SESSION['id']))
        {
            $id_member = $_SESSION['id'];
        }
        $sq_product = $db->select_where("tb_products","id_product = '$id_product'");
        $product = $sq_product->fetch_assoc();
        $view = $product['view_product']+1;
        $sl_star = "SELECT AVG(star) as total FROM tb_stars WHERE id_product = '$id_product'";
        $sq_star = $db->conn->query($sl_star);
        $price_product = ($product['price_product']-$product['discount_product'])-($product['price_product']-$product['discount_product'])*7/100;
        $star = $sq_star->fetch_assoc();
        $db->update("tb_products","view_product = '$view'","id_product = '$id_product'");
        $_SESSION['product'] = $product['id_group'];
    }
    else
    {
        $db->header2('index.php');
    }


    if(isset($_POST['comment']))
    {
        $date = date("Y-m-d H:m:s");
        $comment = $_POST['comment'];

        $insert = $db->insert("tb_comments","id_member,id_product,comment,date_comment","'$id_member','$id_product','$comment','$date'");
        if($insert)
        {
            $db->alert("แสดงความคิดเห็นเสร็จสิ้น");
            $db->header("product.php?id=".$id_product);
        }
       else
       {
        $db->alert("เกิดข้อผิดพลาดในการแสดงความคิดเห็น");
        $db->header("product.php?id=".$id_product);

       }
    }
?>
<?php include('./includes/head.php');?>
<body>

    <?php include('./includes/navbar.php'); ?>
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <?php include('./includes/group.php'); ?>
            </div>
            <div class="col-lg-9">
                <?php include('./includes/nav.php'); ?>
                <div style="margin-top: 20px;" class="panel panel-primary">
                    <div class="panel-heading"><b><?php echo $product['name_product']; ?></b></div>
                    <div class="panel-body">
                      <div class="col-lg-4">
                          <img src="Images/Products/<?php echo $product['image_product']; ?>" width="100%" alt="No Image">
                      </div>
                      <div class="col-lg-8">
                          <h3><b><?php echo $product['name_product']; ?></b></h3>
                          <?php
                            if($product['discount_product'] > 0) 
                            {
                            ?>
                                <h4><span style="text-decoration: line-through; color: coral;"><?php echo number_format($product['price_product']+($product['price_product']*7/100)); ?>THB</span> <span><?php echo number_format(($product['discount_product']/$product['price_product'])*100); ?>%</span></h4>
                            <?php
                            }
                            ?>
                            <h3><b>สินค้าสี: <?php 
                                $id = $_GET['id'];
                                $se_product = $db->select_join_where('tb_products','tb_colors','id_color',"id_product = '$id'");
                                $product = $se_product->fetch_assoc();

                                 echo $product['name_color'];
                            ?></b> </h3>
                          <h3><b><?php echo number_format($price_product) ; ?>THB</b></h3>
                          <?php
                          if($product['stock_product'] > 0)
                          {
                          ?>
                          <a onclick="return confirm('คุณต้องการที่จะ เพิ่มสินค้าลงตระกร้า ใช่หรือไม่?'); " href="cart.php?p_id=<?php echo $id_product;?>&status=add" class="btn btn-info btn-lg"><span class="glyphicon glyphicon-shopping-cart"></span> เพิ่มสินค้าลงตระกร้า</a>
                          <?php
                          }
                          else
                          {
                          ?>
                          <button class="btn btn-danger btn-lg" disabled>สินค้าหมด</button>
                          <?php
                          }
                          ?>
                          <h4>
                            <span class="glyphicon glyphicon-eye-open" style="color: gray;"></span> <?php echo number_format($product['view_product']); ?>
                            <span class="glyphicon glyphicon-heart" style="color: red;"></span> <?php echo number_format($product['like_product']); ?>
                          </h4>
                          <h4>
                              <?php $db->star(number_format($star['total'])); ?>
                          </h4>
                          <?php
                          if(isset($_SESSION['id']))
                          {
                              $sq_star_order = $db->select_join_where("tb_orders","tb_detail_orders","id_order","id_member = '$id_member' AND tb_detail_orders.id_product = '$id_product' AND status_order = 'จัดส่งเสร็จสิ้น'");
                              if($sq_star_order->num_rows > 0)
                              {
                                  $sq_star_check = $db->select_where("tb_stars","id_member = '$id_member' AND id_product= '$id_product'");
                                  if($sq_star_check->num_rows == 0)
                                  {
                          ?>
                          <a href="star.php?id=<?php echo $id_product; ?>" class="btn btn-warning btn-lg"><span class="glyphicon glyphicon-star"></span> ให้คะแนน</a>
                          <?php
                                  }
                                  
                              }
                          }
                          ?>
                      </div>
                      
                    </div>
                    <div class="panel-footer">
                        <h4><?php echo $product['detail_product']; ?></h4>
                    </div>
                </div>


                <?php
                if(isset($_SESSION['id']))
                {
                ?>
                <form action="product.php?id=<?php echo $id_product; ?>" method="post">
                <div class="panel panel-primary">
                    <div class="panel-heading text-center">แสดงความคิดเห็น</div>
                    <div class="panel-body">
                        <div class="form-group">
                            <label for="comment">ความคิดเห็น</label>
                            <textarea name="comment" id="comment" cols="5"  required placeholder="ความคิดเห็นของท่าน" class="form-control" rows="5"></textarea>
                        </div>
                    </div>
                    <div class="panel-footer text-center">
                        <input type="submit" class="btn btn-success" onclick="return confirm('คุณต้องการที่จะ แสดงความคิดเห็น ใช่หรือไม่?'); " value="ยืนยัน">
                    </div>
                </div>
            </form>
                <?php
                }
                ?>

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
                ?>


            </div>

        </div>
    </div>
    
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>