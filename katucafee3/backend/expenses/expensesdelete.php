<?php 
include_once('../../server/server.php'); 
$expensesID = $_POST['expensesID'];
$delete = "DELETE FROM tb_expenses WHERE expensesID = ?";
$statement = $connection->prepare($delete);
if ($statement->execute([$expensesID])) {
    echo "ການລົບສໍາເລັດ";
    header("Location: /katucafee/component/expenses.php");
    exit();
} else {
    echo "ການລົບບໍ່ສໍາເລັດ";
}
?>
