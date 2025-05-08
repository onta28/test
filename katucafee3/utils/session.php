
<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    $_SESSION['message'] = "ກະລຸນາປ້ອນລະຫັດກ່ອນເຂົ້າສູລະບົບ";
    header("location:katucafee3/../../index.php");
    exit();
}
$name = $_SESSION['name'];
echo "ຜູ້ໃຊ້ງານ:" . " " . $name."  "."ວັນທີ ".date('d/m/Y');
 
 

// header("location:../conponent/Summary.php");