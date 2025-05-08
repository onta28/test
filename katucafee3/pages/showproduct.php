<?php
include('../server/server.php');
$sql = "SELECT * FROM tb_product ORDER BY ProductID DESC";
$statement = $connection->prepare($sql);
$statement->execute();
$user = $statement->fetchAll(PDO::FETCH_ASSOC);

$search = isset($_GET['search']) ? trim($_GET['search']) : '';

$sql = "SELECT * FROM tb_product";
if (!empty($search)) {
    $sql .= " WHERE ProductName LIKE :search";
}

$statement = $connection->prepare($sql);
if (!empty($search)) {
    $statement->bindValue(':search', "%$search%", PDO::PARAM_STR);
}

$statement->execute();
$user = $statement->fetchAll(PDO::FETCH_ASSOC);

?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<div class="container">
    <div class="bg-white shadow rounded p-3 mb-1 d-flex justify-content-between">
        <button type="button" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#alertModal">
            ເພີ່ມລາຍການ
        </button>
        <form class="d-flex col-lg-5 col-md-5" role="search" method="GET" action="">
            <input class="form-control me-2" type="search" name="search" placeholder="ຄົ້ນຫາສີ້ນຄ້າ" aria-label="Search" value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>">
            <button class="btn btn-outline-success" type="submit">ຄົ້ນຫາ</button>
        </form>
    </div>
</div>
<!-- admin insert to insert users -->
<div class="modal fade" id="alertModal" tabindex="-1" aria-labelledby="alertModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="alertModalLabel">ເພີ່ມລາຍການສີ້ນຄ້າ</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="/katucafee3/backend/product/binsert.php" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="username" class="form-label">ຊື່ສີ້ນຄ້າ</label>
                        <input type="text" class="form-control" id="username" name="productname" required>
                    </div>
                    <div class="mb-3 text-center">
                        <img id="previewImage" src="" alt="Selected Image Preview" class="img-thumbnail" style="max-width: 150px; max-height: 150px; display: none;">
                    </div>
                    <div class="mb-3">
                        <label for="drinktype" class="form-label">ປະເພດ</label>
                        <select class="form-control" id="drinktype" name="drinktype" required>
                            <option value="" disabled selected>ກະລຸນາເລືອກປະເພດ</option>
                            <option value="ຮ້ອນ">ຮ້ອນ</option>
                            <option value="ເຢັນ">ເຢັນ</option>
                            <option value="ປັ່ນ">ປັ່ນ</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="picture" class="form-label">ຮູບ</label>
                        <input type="file" class="form-control" id="picture" name="picture" accept="image/*" onchange="showPreview(event);">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">ລາຄ່າສີ້ນຄ້າ</label>
                        <input type="text" class="form-control" id="password" name="productprice" required>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <table class="table table-striped table-bordered">
        <thead class="table-dark">
            <th scope="col">ລໍາດັບ</th>
            <th scope="col">ລາຍການສີ້ນຄ້າ</th>
            <th scope="col">ຮູບ</th>
            <th scope="col">ປະເພດ</th>
            <th scope="col">ລາຄ່າ</th>
            <th scope="col">ຈັດການ</th>
        </thead>
        <tbody>
            <?php if (empty($user)): ?>
                <tr>
                    <td colspan="5" class="text-center text-danger">ບໍ່ພົບຂໍ້ມູນ</td>
                </tr>
            <?php else: ?>
                <?php
                $number = 1;
                foreach ($user as $users): ?>
                    <tr>
                        <td><?php echo $number++; ?></td>
                        <td><?php echo $users['ProductName']; ?></td>
                        <td>
                            <img src="../productpictures<?php echo $users['Product_image']; ?>" alt="Picture" style="width: 50px; height: 50px;">
                        </td>
                        <td><?php echo $users['DrinkType']; ?></td>
                        <td><?php echo $users['Product_price']; ?></td>
                        <td class="d-flex">

                            <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#modalEdit<?php echo $users['ProductID']; ?>">ແກ້ໄຂ</button>
                            <form action="/katucafee3/backend/product/bdelete.php" class="ms-1" method="POST">
                                <input type="hidden" name="Productid" value="<?php echo $users['ProductID']; ?>">
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('ທ່ານຢາກລົບຂໍ້ມູນນີ້ແທ້ບໍ່?')">ລົບ</button>
                            </form>
                            <button class="ms-1 ml-4 btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#productDetail<?php echo $users['ProductID']; ?>">
                                <i class="fa-solid fa-eye"></i>
                            </button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>
<?php foreach ($user as $users): ?>
    <div class="modal fade" id="productDetail<?php echo $users['ProductID']; ?>" tabindex="-1" aria-labelledby="productDetail" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">ລາຍລະອຽດສີ້ນຄ້າ</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-6">
                    <div class="mb-3 d-flex justify-content-center">
                        <img src="../productpictures<?php echo $users['Product_image']; ?>" alt="Picture" style="width: 70%;">
                    </div>
                    <div class="mb-3 d-flex">
                        <label>ຊື່ສີ້ນຄ້າ</label>
                        <p><?php echo ":  " . $users['ProductName']; ?></p>
                    </div>
                    <div class="mb-3 d-flex">
                        <label>ປະເພດ</label>
                        <p><?php echo ":  " . $users['DrinkType'] ?></p>
                    </div>

                    <div class="mb-3 d-flex">
                        <label>ລາຄາ</label>
                        <p><?php echo ":  " . $users['Product_price']; ?></p>
                    </div>


                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>
<?php foreach ($user as $users): ?>
    <div class="modal fade" id="modalEdit<?php echo $users['ProductID']; ?>" tabindex="-1" aria-labelledby="modalEdit" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">ແກ້ໄຂສີ້ນຄ້າ</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="/katucafee3/backend/product/bedit.php" method="POST" enctype="multipart/form-data">
                        <input type="hidden" id="editProductID" name="ProductID" value="<?php echo $users['ProductID']; ?>">

                        <div class="mb-3">
                            <label>ຊື່ສີ້ນຄ້າ:</label>
                            <input type="text" id="editProductName" name="productname" class="form-control" value="<?php echo $users['ProductName']; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label>ປະເພດ:</label>
                            <select id="editDrinkType" name="drinktype" class="form-control" required>
                                <option value="ຮ້ອນ" <?php echo ($users['DrinkType'] == 'ຮ້ອນ') ? 'selected' : ''; ?>>ຮ້ອນ</option>
                                <option value="ເຢັນ" <?php echo ($users['DrinkType'] == 'ເຢັນ') ? 'selected' : ''; ?>>ເຢັນ</option>
                                <option value="ປັ່ນ" <?php echo ($users['DrinkType'] == 'ປັ່ນ') ? 'selected' : ''; ?>>ປັ່ນ</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label>ຮູບ:</label>
                            <input type="file" id="editPicture" name="picture" class="form-control">
                            <img id="editPreview" src="" width="100px" class="mt-2">
                        </div>
                        <div class="mb-3">
                            <label>ລາຄາ:</label>
                            <input type="text" id="editProductPrice" name="productprice" class="form-control" value="<?php echo $users['Product_price']; ?>" required>
                        </div>
                        <button type="submit" class="btn btn-primary">ອັບເດດ</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>
<script>
    function showPreview(event) {
        const previewImage = document.getElementById('previewImage');
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                previewImage.src = e.target.result;
                previewImage.style.display = 'block';
            };
            reader.readAsDataURL(file);
        } else {
            previewImage.src = '';
            previewImage.style.display = 'none';
        }
    }
</script>