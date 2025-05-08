<?php 
include_once('../../server/server.php');
$expensesID=$_POST['expensesID'];
$productname=$_POST['productname'];
$price=$_POST["price"];
var_dump($_POST);
$update="UPDATE tb_expenses set expensesName=?,price=? WHERE expensesID=?";
$statement = $connection->prepare($update);
if ($statement->execute([$productname,$price, $expensesID])) {
    echo "ການອັບເດດສໍາເລັດ";
    header("Location: /katucafee3/component/expenses.php");
    exit();
} else {
    echo "ການອັບເດດບໍ່ສໍ່າເລັດ";
}
?>