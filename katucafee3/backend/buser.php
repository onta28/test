<?php
require('../server/server.php'); 
session_start(); 
if (isset($_POST['username'], $_POST['password'])) {
    $adminname = trim($_POST['username']); 
    $adminpassword = trim($_POST['password']);
    var_dump($_POST);
    $sql = "SELECT * FROM tb_admins WHERE adminname = ? AND adminpassword = ?";
    $statement = $connection->prepare($sql);
    $statement->execute([$adminname, $adminpassword]);
    $user = $statement->fetch(PDO::FETCH_ASSOC);
    var_dump($user);
    if ($user) {
        $_SESSION['admin'] = $user['adminname'];
        header('Location: ../component/insertuser.php');
        exit();
    } else {
        $_SESSION['modelnot'] = "ທ່ານປ້ອນລະຫັດບໍ່ຖືກຕ້ອງ";
        header('Location: ../component/user.php');
        exit();
    }
} elseif (isset($_POST['yes'])) {
 echo $_POST['check'];
    exit();
} else {
    header('Location: ../component/user.php');
    exit();
}