<?php
    require('./includes/connect.php');
    $db = new db;

    if(empty($_GET['search']))
    {
        $db->header2("index.php");
    }
    else
    {
        $search = $_GET['search'];
        $mode = (!empty($_GET['mode']) ? $_GET['mode'] : '');
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
                    <div class="panel-heading text-center">สินค้าทั้งหมด</div>
                    <div class="panel-body">
                        <div style="margin:20px;" class="text-center">
                            <div class="btn-group">
                                <a href="search.php?search=<?php echo $search; ?>&mode=h-s" class="btn btn-primary">สินค้าราคาสูงสุด</a>                                
                                <a href="search.php?search=<?php echo $search; ?>&mode=hot" class="btn btn-primary">สินค้ายอดนิยม</a>                                
                                <a href="search.php?search=<?php echo $search; ?>&mode=s-h" class="btn btn-primary">สินค้าราคาต่ำสุด</a>                                
                            </div>
                        </div>
                        <?php
                        if($mode == 'h-s')
                        {
                            $sq_product = $db->select_join_where("tb_products","tb_groups","id_group","name_product LIKE '%$search%' OR tb_groups.name_group LIKE '$search' OR price_product < '$search' ORDER BY price_product DESC");
                        }
                        else if($mode == 's-h')
                        {
                            $sq_product = $db->select_join_where("tb_products","tb_groups","id_group","name_product LIKE '%$search%' OR tb_groups.name_group LIKE '$search' OR price_product < '$search' ORDER BY price_product ASC");
                        }
                        else
                        {
                            $sq_product = $db->select_join_where("tb_products","tb_groups","id_group","name_product LIKE '%$search%' OR tb_groups.name_group LIKE '$search' OR price_product < '$search' ORDER BY like_product DESC");
                        }
                        while($product = $sq_product->fetch_assoc())
                        {
                            $id_product = $product['id_product'];
                            $price_product = ($product['price_product']-$product['discount_product'])-($product['price_product']-$product['discount_product'])*7/100;
                            $sl_star = "SELECT AVG(star) as total FROM tb_stars WHERE id_product = '$id_product'";
                            $sq_star = $db->conn->query($sl_star);
                            $star = $sq_star->fetch_assoc();
                            include('./includes/show_product.php');
                        }
                        if($sq_product->num_rows == 0)
                        {
                            echo "<h1 class='text-center'>ไม่พบสินค้า</h1>";
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>