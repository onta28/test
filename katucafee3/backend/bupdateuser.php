<?php
include_once('../server/server.php');
$password=$_POST["password"];
$user_id = $_POST['user_id'];
$name = $_POST['name'];
$username = $_POST['username'];
$number = $_POST['number'];
$address = $_POST['address'];
$salary = $_POST['salary'];
$data = $_POST['data'];
$currentPicture = $_POST['current_picture'];
$picturePath = $currentPicture;
if (isset($_FILES['picture']) && $_FILES['picture']['error'] === UPLOAD_ERR_OK) {
    $pictureTmp = $_FILES['picture']['tmp_name'];
    $pictureName = $_FILES['picture']['name'];
    $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
    $fileType = mime_content_type($pictureTmp);
    if (in_array($fileType, $allowedTypes)) {
        $picturePath = '../pictures/' . basename($pictureName);
        if (move_uploaded_file($pictureTmp, $picturePath)) {
            if (!empty($currentPicture) && file_exists($currentPicture)) {
                unlink($currentPicture);
            }
        } else {
            echo "ການອັບໂຫລດຮູບພາບບໍ່ສໍາເລັດ<br>";
        }
    } else {
        echo "ຮູບພາບບໍ່ຮອງຮັບ<br>";
    }
}
$sql = "UPDATE tb_users SET name = ?, picture = ?, username = ?, password=?, number = ?, address = ?, salary = ?, data = ? WHERE user_id = ?";
$statement = $connection->prepare($sql);
if ($statement->execute([$name, $picturePath, $username,$password, $number, $address, $salary, $data, $user_id])) {
    echo "ການອັບເດດສໍາເລັດ";
    header("Location: ../component/insertuser.php");
    exit();
} else {
    echo "ການອັບເດດບໍ່ສໍ່າເລັດ";
}
?>
