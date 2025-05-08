<?php
var_dump($_POST);
var_dump($_FILES);
include_once('../server/server.php');
$name = $_POST['name'];           
$username = $_POST['username'];   
$password = $_POST['password'];   
$address = $_POST['address'];   
$salary = $_POST['salary'];   
$number = $_POST['number'];       
$data = $_POST['data'];
$picturePath = '';
// ການອັບໂລດຮູບພາບ

if (isset($_FILES['picture']) && $_FILES['picture']['error'] === UPLOAD_ERR_OK) { //ການກວດສອບວ່າມີຟາຍອັບໂຫລດເຂົ້າມາລະບໍ່ 
    $pictureTmp = $_FILES['picture']['tmp_name'];
    $pictureName = $_FILES['picture']['name'];
    $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
    $fileType = mime_content_type($pictureTmp);//ຊວຍໃນການກວດຊອບວ່່າຟາຍນີ້ແມ່ນສະນິດໃດ
    if (in_array($fileType, $allowedTypes)) {
        $picturePath = '../pictures/' . basename($pictureName);
        if (move_uploaded_file($pictureTmp, $picturePath)) {
            echo "ການເພີ່ມຮູບພາບສໍາເລັດ<br>";
        } else {
            echo "ການບັນທຶກຮູບພາບບໍ່ສໍາເລັດ<br>";
        }
    } else {
        echo "ຮູບພາບບໍ່ຮອງຮັບ<br>";
    }
}
$sql = "INSERT INTO tb_users (name, picture, username, password, address, number, salary, data) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
$statement = $connection->prepare($sql);
if ($statement->execute([$name, $picturePath, $username, $password, $address, $number, $salary, $data])) {
    echo "ການເພີ່ມຜູ້ໃຊ້ສໍາເລັດ<br>";
    header("Location: ../component/insertuser.php");

} else {
    echo "ການເພີ່ມຜູ້ໃຊ້ບໍ່ສໍ່າເລັດ";
}
?>
