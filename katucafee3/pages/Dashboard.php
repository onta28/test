<?php
include_once('../server/server.php');
$sql = "select 
    p.productid, 
    p.productname, 
    p.drinktype, 
    p.product_image,
    sum(sd.quantity_sold) as total_cups_sold
from tb_sales_details sd
join tb_product p on sd.product_id = p.productid
group by 
    p.productid, 
    p.productname, 
    p.drinktype, 
    p.product_image
order by total_cups_sold desc
limit 3;";


$stmt = $connection->query($sql);
$results = $stmt->fetchAll();

?>

<div class="container">
    <div class="background-image"></div>
    <div class="row">
        <?php foreach ($results as $result): ?>
            <div class="m-3 bg-primary text-white col-12 col-sm-6 col-md-3 p-3 rounded">
                <h4><?php echo $result['productname'] . " (" . $result['total_cups_sold'] . ")"; ?></h4>
                <p>ປະເພດເຄື່ອງດື່ມ: <?php echo $result['drinktype']; ?></p>
            </div>
        <?php endforeach; ?>

    </div>
</div>

<style>
    .background-image {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-image: url('../assets/katudasboard.jpg');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        z-index: -1;
    }
</style>