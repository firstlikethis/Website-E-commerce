<?php
    require('./includes/connect.php');
    $db = new db;
    $db->admin_empty();
?>
<?php include('./includes/h_admin.php');?>

<body>
    <div class="contanier">
        <div class="panel panel-primary">
            <div class="panel-heading text-center">รายระเอียดสินค้า</div>
            <?php
                    $id = $_GET['id'];
                    $se_product = $db->select_where('tb_products',"id_product = '$id'");
                    $memner = $se_product->fetch_assoc();
                
                ?>
            <div class="row mt-2 mt-md-4">
                <div class="col-12"><?= $memner['detail_product']; ?></div>
            </div>
        </div>
    </div>

    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>

</html>