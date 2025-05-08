<?php
if (!isset($_SESSION['admin'])) {
    $_SESSION['noadmin'] = "ກະລຸນາເຂົ້າລະບົບເເອັດມິນກ່ອນ!";
    header('Location: ../component/user.php');
    exit();
}
?>
<div class="container mt-5">
    <h1> <span style="color:blue;"> ແອັດມິນເເມ່ນ: </span><?php echo $_SESSION['admin']; ?></h1>
    <h2 class="mb-4">ຂໍ້ມູນພະນັກງານທັງຫມົດ</h2>
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalInsertEmployee">ເພີ່ມພະນັກງານ</button>
    <div class="table-responsive mt-4">
        <?php
        include_once('../server/server.php');
        $sql = "SELECT * FROM tb_users";
        $statement = $connection->prepare($sql);
        $statement->execute();
        $users = $statement->fetchAll(PDO::FETCH_ASSOC);
        ?>
        <table class="table table-striped table-bordered">
            <thead class="table-dark">
                <tr>
                    <th scope="col">User ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Picture</th>
                    <th scope="col">Username</th>
                    <th scope="col">Password</th>
                    <th scope="col">Number</th>
                    <th scope="col">Address</th>
                    <th scope="col">Salary</th>
                    <th scope="col">Data</th>
                    <th scope="col">Management</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $number = 1;
                ?>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?php
                            echo $number++;
                            ?></td>
                        <td><?php echo $user['name']; ?></td>
                        <td>
                            <img src="<?php echo $user['picture']; ?>" alt="Picture" style="width: 50px; height: 50px;">
                        </td>
                        <td><?php echo $user['username']; ?></td>
                        <td><?php echo $user['password']; ?></td>
                        <td><?php echo $user['number']; ?></td>
                        <td><?php echo $user['address']; ?></td>
                        <td><?php echo number_format($user['salary'], 0, '.', ',') . " ກີບ"; ?></td>
                        <td><?php echo $user['data']; ?></td>
                        <td>
                            <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#modalEditEmployee<?php echo $user['user_id']; ?>">ແກ້ໄຂ</button>
                            <form action="../backend/bdeleteuser.php" method="POST" class="d-inline">
                                <input type="hidden" name="user_id" value="<?php echo $user['user_id']; ?>">
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('ທ່ານຢາກລົບຂໍ້ມູນນີ້ແທ້ບໍ່?')">ລົບ</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>

        </table>

        <!-- ການເເກ້ໄຂອັບເດດ -->
        <?php foreach ($users as $user): ?>
            <div class="modal fade" id="modalEditEmployee<?php echo $user['user_id']; ?>" tabindex="-1" aria-labelledby="editEmployeeLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form action="/katucafee3/backend/bupdateuser.php" method="POST" enctype="multipart/form-data">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editEmployeeLabel">ປັບປຸງຂໍ້ມູນພະນັກງານ</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" name="user_id" value="<?php echo $user['user_id']; ?>">
                                <div class="mb-3">
                                    <label for="name" class="form-label">ຊື່ແລະນາມສະກຸນ</label>
                                    <input type="text" class="form-control" id="name" name="name" value="<?php echo $user['name']; ?>" required>
                                </div>
                                <div class="mb-3 text-center">
                                    <img id="previewImageEdit<?php echo $user['user_id']; ?>" src="<?php echo $user['picture']; ?>" alt="Image" class="img-thumbnail" style="max-width: 150px; max-height: 150px;">
                                </div>
                                <div class="mb-3">
                                    <label for="picture" class="form-label">ຮູບ</label>
                                    <input type="file" class="form-control" id="picture" name="picture" accept="image/*">
                                    <input type="hidden" name="current_picture" value="<?php echo $user['picture']; ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="username" class="form-label">ຊື່ຜູ້ໃຊ້ງານ</label>
                                    <input type="text" class="form-control" id="username" name="username" value="<?php echo $user['username']; ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label for="username" class="form-label">ລະຫັດຜ່ານ</label>
                                    <input type="text" class="form-control" id="password" name="password" value="<?php echo $user['password']; ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label for="number" class="form-label">ເບີໂທ</label>
                                    <input type="text" class="form-control" id="number" name="number" value="<?php echo $user['number']; ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="address" class="form-label">ທີ່ຢູ່</label>
                                    <input type="text" class="form-control" id="address" name="address" value="<?php echo $user['address']; ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="address" class="form-label">ເງີນເດືອນ</label>
                                    <input type="text" class="form-control" id="address" name="salary" value="<?php echo $user['salary']; ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="data" class="form-label">ວັນທີ</label>
                                    <input type="date" class="form-control" id="data" name="data" value="<?php echo $user['data']; ?>">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ຍົກເລີກ</button>
                                <button type="submit" class="btn btn-primary">ອັບເດດ</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>

    </div>
</div>
<!-- ການເພີ່ມພະນັກງານ -->
<div class="modal fade" id="modalInsertEmployee" tabindex="-1" aria-labelledby="insertEmployeeLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="../backend/binsertuser.php" method="POST" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title" id="insertEmployeeLabel">ຈັດການພະນັກງານ</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">ຊື່ແລະນາມສະກຸນ</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="mb-3 text-center">
                        <img id="previewImage" src="" alt="Selected Image Preview" class="img-thumbnail" style="max-width: 150px; max-height: 150px; display: none;">
                    </div>

                    <div class="mb-3">
                        <label for="picture" class="form-label">ຮູບ</label>
                        <input type="file" class="form-control" id="picture" name="picture" accept="image/*" onchange="showPreview(event);">
                    </div>
                    <div class="mb-3">
                        <label for="username" class="form-label">ຊື່ຜູ້ໃຊ້ງານ</label>
                        <input type="text" class="form-control" id="username" name="username" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">ລະຫັດ</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <div class="mb-3">
                        <label for="number" class="form-label">ເບີໂທ</label>
                        <input type="text" class="form-control" id="number" name="number">
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">ທີ່ຢູ່</label>
                        <input type="text" class="form-control" id="address" name="address">
                    </div>
                    <div class="mb-3">
                        <label for="salary" class="form-label">ເງີນເດືອນ</label>
                        <input type="text" class="form-control" id="salary" name="salary">
                    </div>
                    <div class="mb-3">
                        <label for="data" class="form-label">ວັນທີ</label>
                        <input type="date" class="form-control" id="data" name="data">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ຍົກເລີກ</button>
                    <button type="submit" class="btn btn-primary">ເພີ່ມພະນັກງານ</button>
                </div>
            </form>
        </div>
    </div>
</div>
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