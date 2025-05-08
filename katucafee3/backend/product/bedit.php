<?php
include_once('../../server/server.php');

$productID = $_POST['ProductID'];
$productname = $_POST['productname'];
$productprice = $_POST['productprice'];
$producttype = $_POST['drinktype'];
// ດຶງຂໍ້ມູນສີ້ນຄ້າເກົ່າຈາກຖານຂໍ້ມູນ
$sql = "SELECT Product_image FROM tb_product WHERE ProductID = ?";
$statement = $connection->prepare($sql);
$statement->execute([$productID]);
$product = $statement->fetch(PDO::FETCH_ASSOC);

$picturePath = $product['Product_image'];

if (isset($_FILES['picture']) && $_FILES['picture']['error'] === UPLOAD_ERR_OK) {
    $pictureTmp = $_FILES['picture']['tmp_name'];
    $pictureName = $_FILES['picture']['name'];
    $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
    $fileType = mime_content_type($pictureTmp);

    if (in_array($fileType, $allowedTypes)) {
        $newPath = '../../upload/' . basename($pictureName);
        if (move_uploaded_file($pictureTmp, $newPath)) {
            if ($product['Product_image'] && file_exists($product['Product_image'])) {
                unlink($product['Product_image']); // ລົບຮູບເກົ່າອອກ
            }
            $picturePath = $newPath;
        }
    }
}

// ອັບເດດສີ້ນຄ້າ
$sql = "UPDATE tb_product SET ProductName = ?, Product_image = ?, Product_price = ?, DrinkType = ? WHERE ProductID = ?";
$statement = $connection->prepare($sql);
if ($statement->execute([$productname, $picturePath, $productprice, $producttype, $productID])) {
    header("location:http://localhost/katucafee3/component/productlayout.php");
} else {
    echo "ບໍ່ສາມາດອັບເດດໄດ້!";
}
?>
