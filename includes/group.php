

<div class="panel panel-primary">
    <div class="panel-heading text-center">หมวดหมู่สินค้า</div>
    <div class="list-group text-center">
        <?php
        $sq_group = $db->select("tb_groups");
        while($group = $sq_group->fetch_assoc())
        {
        ?>
            <a href="search.php?search=<?php echo $group['name_group']; ?>" class="list-group-item"><b><?php echo $group['name_group']; ?></b></a>
        <?php
        }
        ?>
        
    </div>
</div>

<div class="panel panel-primary">
    <div class="panel-heading text-center">สินค้าน่าสนใจ</div>
    <div class="panel-body">
        <?php
        if(!empty($_SESSION['product']))
        {
            $id_group = $_SESSION['product'];
            $sq_like = $db->select_where("tb_products","id_group = '$id_group' ORDER BY view_product DESC limit 3");
        }
        else
        {
            $sq_like = $db->select("tb_products ORDER BY id_product DESC limit 3");
        }
        while($like = $sq_like->fetch_assoc())
        {
            $price_product = ($like['price_product']-$like['discount_product'])-($like['price_product']-$like['discount_product'])*7/100;
        ?>
        <a href="product.php?id=<?php echo $like['id_product']; ?>" style="text-decoration: none;" class="thumbnail text-center">
            <div class="caption">
                <img src="Images/Products/<?php echo $like['image_product']; ?>" width="100px" height="100px" alt="No Image">
                <div style="width: 120px; display:inline-block; vertical-align: top; word-wrap:break-word;">
                    <h4><b><?php echo $like['name_product']; ?></b></h4>
                    <?php
                    if($like['discount_product'] > 0) 
                    {
                    ?>
                        <h5><span style="text-decoration:line-through;  color: coral;"><?php echo number_format($like['price_product']+($like['price_product']*7/100)); ?>THB</span> <span><?php echo number_format(($like['discount_product']/$like['price_product'])*100); ?>%</span></h5>
                    <?php
                    }
                    ?>
                    <h4><b><?php echo number_format($price_product); ?>THB</b></h4>
                </div>
            </div>
        </a>
        <?php
        }
        ?>
    </div>
</div>