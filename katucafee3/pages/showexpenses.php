<?php
include_once('../server/server.php');
$sql = "SELECT * FROM tb_expenses";
$statement = $connection->prepare($sql);
$statement->execute();
$users = $statement->fetchAll(PDO::FETCH_ASSOC);
// ການຄົ້ນຫາຂໍ້ມູນ
$search = isset($_GET['search']) ? $_GET['search'] : '';
$sql = "SELECT * FROM tb_expenses";
if (!empty($search)) {
    $sql .= " WHERE expensesName LIKE :search OR Name LIKE :search";
}
$statement = $connection->prepare($sql);
if (!empty($search)) {
    $statement->bindValue(':search', "%$search%");
}
$statement->execute();
$users = $statement->fetchAll(PDO::FETCH_ASSOC);
?>
<div class="container">
    <div class="bg-white shadow rounded p-3 mb-1 d-flex justify-content-between">
        <button type="button" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#alertModal">
            ເພີ່ມລາຍການ
        </button>
        <form class="d-flex col-lg-5 col-md-5" role="search" method="GET" action="">
            <input class="form-control me-2" type="search" name="search" placeholder="ຄົ້ນຫາລາຍຈ່າຍ" aria-label="Search" value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>">
            <button class="btn btn-outline-success" type="submit">ຄົ້ນຫາ</button>
        </form>
    </div>
    <table class="table table-striped table-bordered">
        <thead class="table-dark">
            <tr>
                <th scope="col">ລໍາດັບ</th>
                <th scope="col">ຊື່ສີ້ນຄ້າທີ່ຈ່າຍ</th>
                <th scope="col">ລາຄ່າ</th>
                <th scope="col">ວັນທີ່</th>
                <th scope="col">ຜູ້ຈ່າຍ</th>
                <th scope="col">ການຈັດການ</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($users)): ?>
                <tr>
                    <td colspan="6" class="text-center">ບໍ່ພົບຂໍ້ມູນທີ່ຄົ້ນຫາ!</td>
                </tr>
            <?php else: ?>
                <?php
                $number = 1;
                foreach ($users as $user):
                ?>
                    <tr>
                        <td><?php echo $number++; ?></td>
                        <td><?php echo htmlspecialchars($user['expensesName']); ?></td>
                        <td><?php echo number_format($user['price'], 0, ".", ",") . " ກີບ"; ?></td>
                        <td><?php echo date("d-m-Y", strtotime($user['date'])); ?></td>
                        <td><?php echo htmlspecialchars($user['Name']); ?></td>
                        <td>
                            <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#alertEdit<?php echo $user['expensesID']; ?>">ແກ້ໄຂ</button>
                            <form action="/katucafee/backend/expenses/expensesdelete.php" method="POST" class="d-inline">
                                <input type="hidden" name="expensesID" value="<?php echo $user['expensesID']; ?>">
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('ທ່ານຢາກລົບຂໍ້ມູນນີ້ແທ້ບໍ່?')">ລົບ</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>

    </table>
    <?php
    $sql = "SELECT SUM(price) AS total_price FROM tb_expenses";
    $statement = $connection->prepare($sql);
    if ($statement->execute()) {
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        $totalPrice = $result['total_price'];
        $_SESSION['allprice'] = "ລວມຄ່າໃຊ້ຈ່າຍທັງຫມົດ: " . number_format($totalPrice, 0, ".", ",") . " ກີບ";
        echo $_SESSION['allprice'];
    } else {
        echo "ບໍ່ສາມາດຄິດຄຳນວນລາຄາໄດ້!";
    }
    ?>
</div>
<!-- ອາເລີດ -->
<div class="modal fade" id="alertModal" tabindex="-1" aria-labelledby="alertModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="alertModalLabel">ຈັດການລາຍຈ່າຍ</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="/katucafee/backend/expenses/bexpensesinsert.php">
                    <div class="mb-3">
                        <label for="productname" class="form-label">ຊື່ສີ້ນຄ້າທີ່ຈ່າຍ</label>
                        <input type="text" class="form-control" id="productname" name="productname" required>
                    </div>
                    <div class="mb-3">
                        <label for="price" class="form-label">ລາຄ່າ</label>
                        <input type="text" class="form-control" id="price" name="price" required>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">ບັນທຶກ</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ຍົກເລີກ</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
<!-- edit --><?php foreach ($users as $user): ?>
    <div class="modal fade" id="alertEdit<?php echo $user['expensesID']; ?>" tabindex="-1" aria-labelledby="alertModalLabel<?php echo $user['expensesID']; ?>" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="alertModalLabel<?php echo $user['expensesID']; ?>">ຈັດການລາຍຈ່າຍ</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="/katucafee3/backend/expenses/bexpensesupdate.php">
                        <div class="mb-3">
                            <label for="productname<?php echo $user['expensesID']; ?>" class="form-label">ຊື່ສີ້ນຄ້າທີ່ຈ່າຍ</label>
                            <input type="text" class="form-control" id="productname<?php echo $user['expensesID']; ?>" name="productname" value="<?php echo htmlspecialchars($user['expensesName']); ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="price<?php echo $user['expensesID']; ?>" class="form-label">ລາຄ່າ</label>
                            <input type="text" class="form-control" id="price<?php echo $user['expensesID']; ?>" name="price" value="<?php echo htmlspecialchars($user['price']); ?>" required>
                        </div>
                        <input type="hidden" name="expensesID" value="<?php echo $user['expensesID']; ?>">
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">ບັນທຶກ</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ຍົກເລີກ</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>