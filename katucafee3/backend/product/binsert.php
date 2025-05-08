<?php 
include_once('../../server/server.php');
$productname = $_POST['productname'];
$productprice = $_POST['productprice'];
$producttype = $_POST['drinktype']; 
$picturePath = '';
if (isset($_FILES['picture']) && $_FILES['picture']['error'] === UPLOAD_ERR_OK) { 
    $pictureTmp = $_FILES['picture']['tmp_name'];
    $pictureName = $_FILES['picture']['name'];
    $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
    $fileType = mime_content_type($pictureTmp);
    if (in_array($fileType, $allowedTypes)) {
        $picturePath = '../../upload/' . basename($pictureName);
        if (move_uploaded_file($pictureTmp, $picturePath)) {
            echo "ການເພີ່ມຮູບພາບສໍາເລັດ<br>";
        } else {
            echo "ການບັນທຶກຮູບພາບບໍ່ສໍາເລັດ<br>";
        }
    } else {
        echo "ຮູບພາບບໍ່ຮອງຮັບ<br>";
    }
} else {
    echo "ຟາຍບໍ່ຖືກອັບໂຫລດ<br>";
    $picturePath = ''; 
}
$sql = "INSERT INTO tb_product (ProductName, Product_image, Product_price, DrinkType) VALUES (?, ?, ?, ?)";
$statement = $connection->prepare($sql);
if ($statement->execute([$productname, $picturePath, $productprice, $producttype])) {
    echo "ການເພີ່ມສີ້ນຄ້າສໍາເລັດ<br>";
    header("location:/katucafee3/component/productlayout.php");
} else {
    echo "ການເພີ່ມສີ້ນຄ້າບໍ່ສໍາເລັດ<br>";
}
?>
