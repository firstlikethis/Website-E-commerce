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
                        <div class="panel-heading  text-center">สินค้าทั้งหมด</div>
                        <div class="panel-body">
                            <?php
                                $sq_product = $db->select("tb_products");
                                while($product = $sq_product->fetch_assoc())
                                {
                                    $id_product = $product['id_product'];
                                    $price_product = ($product['price_product']-$product['discount_product'])-($product['price_product']-$product['discount_product'])*7/100;
                                    $sl_star = "SELECT AVG(star) as total FROM tb_stars WHERE id_product = '$id_product'";
                                    $sq_star = $db->conn->query($sl_star);
                                    $star = $sq_star->fetch_assoc();
                                    include('./includes/show_product.php');
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