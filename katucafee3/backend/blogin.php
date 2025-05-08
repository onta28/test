<?php 
include('../server/server.php');
session_start();
$username=$_POST['username'];
$password=$_POST['password'];
$sql="SELECT * FROM tb_users WHERE username=? and password=?";
$statement=$connection->prepare($sql);
$statement->execute([$username,$password]);
$user=$statement->fetch(PDO::FETCH_ASSOC);
var_dump($user);
if ($user) {
 $_SESSION['user_id']=$user['user_id'];
 echo $_SESSION['user_id'];
$_SESSION['name']=$user['name'];
header('location:http://localhost/katucafee3/component/index.php');
exit();
}
else{
    $_SESSION['nopassword']="ລະຫັດຜ່ານຂອງທ່ານບໍ່ຖືກຕ້ອງ";
    header('location:http://localhost/katucafee3/index.php');
}
?>