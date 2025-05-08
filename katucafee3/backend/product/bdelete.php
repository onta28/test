
<?php
include_once('../../server/server.php');
if (!isset($_POST['Productid']) || empty($_POST['Productid'])) {
    echo "NO information";
    exit();
}

$productid = $_POST['Productid'];
var_dump($_POST); 

$sqlpicture = "SELECT Product_image FROM tb_product WHERE ProductID=?";
$sqlpicture = $connection->prepare($sqlpicture);
$sqlpicture->execute([$productid]); 
$picture = $sqlpicture->fetch(PDO::FETCH_ASSOC);

if ($picture) {
    $picturePath = $picture['Product_image'];

    $sql = "DELETE FROM tb_product WHERE ProductID = ?";
    $statement = $connection->prepare($sql);
    if ($statement->execute([$productid])) {
        if (!empty($picturePath) && file_exists($picturePath)) {
            unlink($picturePath);
        }
        header("location:/katucafee3/component/productlayout.php");
        echo "ການລົບສໍາແລັດ";
        exit();
    } else {
        echo "ການລົບບໍ່ສໍາແລັດ";
    }
} else {
    echo "NO information";
}
