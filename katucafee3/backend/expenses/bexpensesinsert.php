<?php 
session_start();
include_once('../../server/server.php');
var_dump($_POST);
if (isset($_SESSION['name']) && isset($_POST['productname']) && isset($_POST['price'])) {
    $name = $_SESSION['name'];
    $productname = $_POST['productname'];
    $price=$_POST['price'];
    $sql = "INSERT INTO tb_expenses (expensesName,price, date, Name) VALUES ('$productname',$price, CURDATE(), '$name')";
    $statement = $connection->prepare($sql);
    if ($statement->execute()) {
        echo "ການເພີ່ມສໍາເເລັດ";
        header('location:/katucafee/component/expenses.php');
    } else {
        echo "ການເພີ່ມບໍ່ສໍາແລັດ!";
    }
} else {
    echo "ກະລຸນາປ້ອນຂໍ້ມູນ";
}
 
?>
