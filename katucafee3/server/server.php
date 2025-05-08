
<?php
$server = "localhost";
$username = "root";
$password = "";
$database = "katucafee";
try {
    $connection = new PDO("mysql:host=$server;dbname=$database", $username, $password);
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Your connection is fail" . $e->getMessage();
}

// ການສະເເດງຂໍ້ມູນໂດຍໃຊ້ຟັງຊັນໄດ້ໃຊ້ຫຼາຍຄັ້ງໂດຍບໍ່ຕ້ອງຂຽນຊໍ່າ
function selectData($connection, $table, $columns = "*", $where = "", $params = []) {
    $sql = "SELECT $columns FROM $table";
    if (!empty($where)) {
        $sql .= " WHERE $where";
    }
    $stmt = $connection->prepare($sql);
    $stmt->execute($params);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
// ການລົບຂໍ້ມູນໂດຍໃຊ້ຟັງຊັນໄດ້ໃຊ້ຫຼາຍຄັ້ງໂດຍບໍ່ຕ້ອງຂຽນຊໍ່າ
function delete($connection, $table, $where, $params = []) {
    $sql = "DELETE FROM $table WHERE $where";
    $stmt = $connection->prepare($sql);
    return $stmt->execute($params);
}
function searchData($connection, $table, $searchColumn, $searchTerm) {
    $where = "$searchColumn LIKE ?";
    $params = ["%$searchTerm%"];
    return selectData($connection, $table, "*", $where, $params);
} 
?>
