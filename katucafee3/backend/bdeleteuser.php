<?php
include_once('../server/server.php');
$user_id = $_POST['user_id'];
$sql = "SELECT picture FROM tb_users WHERE user_id = ?";
$statement = $connection->prepare($sql);
$statement->execute([$user_id]);
$user = $statement->fetch(PDO::FETCH_ASSOC);
if ($user) {
    $picturePath = $user['picture'];
    $sqlDelete = "DELETE FROM tb_users WHERE user_id = ?";
    $statementDelete = $connection->prepare($sqlDelete);
    if ($statementDelete->execute([$user_id])) {
        if (!empty($picturePath) && file_exists($picturePath)) {
            unlink($picturePath);
            echo "ລົບຮູບພາບສໍາເລັດ<br>";
        }
        echo "ການລົບສໍາເລັດ";
        header("Location: ../component/insertuser.php");
        exit();
    } else {
        echo "ການລົບບໍ່ສໍ່າເລັດ";
    }
} else {
    echo "ຂໍ້ມູນຜູ້ໃຊ້ບໍ່ມີຢູ່";
}
?>
