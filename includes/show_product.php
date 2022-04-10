
<div class="col-lg-3 col-md-4 col-sm-5">
    <a style="text-decoration: none; height: 300px;" href="product.php?id=<?php echo $product['id_product']; ?>" class="thumbnail">
        <div class="caption">
            <div class="text-center">
                <img src="Images/Products/<?php echo $product['image_product']; ?>" style="max-width: 100%; max-height: 150px;" alt="No Image">
            </div>
            <h4><b><?php echo $product['name_product']; ?></b></h4>
            <?php
            if($product['discount_product'] > 0)
            {
            ?>
                <h5><span style="text-decoration: line-through; color: coral;"><?php echo number_format($product['price_product']+($product['price_product']*7/100)); ?>THB</span> <span><?php echo number_format(($product['discount_product']/$product['price_product'])*100); ?>%</span></h5>
            <?php
            }
            ?>
            <h4><b><?php echo number_format($price_product); ?>THB</b></h4>
            <div class="text-center">
                <span class="glyphicon glyphicon-eye-open" style="color: gray;"></span> <?php echo number_format($product['view_product']); ?>
                <span class="glyphicon glyphicon-star" style="color: coral;"></span> <?php echo number_format($star['total']); ?>
                <span class="glyphicon glyphicon-heart" style="color: red;"></span> <?php echo number_format($product['like_product']); ?>
            </div>
        </div>
    </a>
</div>