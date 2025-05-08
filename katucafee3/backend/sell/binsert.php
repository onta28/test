<?php
include("../../server/server.php");
session_start();

$userid = $_SESSION['user_id'];
$totalPrice = $_SESSION['alltotal'];
$totalQty = $_SESSION['listprice'];

if (isset($_SESSION['bill'])) {
    $saleDate = date('Y-m-d H:i:s');
    $sql = "INSERT INTO tb_bill (sale_date, user_id) VALUES (?, ?)";
    $statement = $connection->prepare($sql);
    if ($statement->execute([$saleDate, $userid])) {
        $lastInsertedId = $connection->lastInsertId();
        echo "ການເພີ່ມແມ່ນສໍາແລັດຮາາາາາ";
        foreach ($_SESSION['bill'] as $item) {
            $name = $item['name'];
            $type = $item['type'];
            $qty = $item['qty'];
            $price = $item['price'];
            $total = $item['total'];
            $productID = $item['ProductID'];
            $sql = "INSERT INTO `tb_sales_details`(`bill_id`, `sale_date`, `product_id`, `quantity_sold`) VALUES (?, ?, ?, ?)";
            $statement = $connection->prepare($sql);
            $statement->execute([$lastInsertedId, $saleDate, $productID, $qty]);
        }

        if (isset($_POST['sive'])) {

            $sql = "insert into tb_summary_daily (sale_date, total_sales)
                    values (curdate(), ?)
                    on duplicate key update total_sales = total_sales + ?";
            $statement = $connection->prepare($sql);
            $statement->execute([$totalPrice, $totalPrice]);

            $sql = "insert into tb_summary_monthly (salem, total_sales)
                    values (date_format(curdate(), '%Y-%m-01'), ?)
                    on duplicate key update total_sales = total_sales + ?";
            $statement = $connection->prepare($sql);
            $statement->execute([$totalPrice, $totalPrice]);
            header("Location: http://localhost/katucafee3/component/Summary.php");
            exit;
        }
    } else {
        echo "ການເພີ່ມແມ່ນສໍາແລັດຮາາາາາ";
    }
}
