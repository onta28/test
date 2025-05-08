<!-- ເເຈ້ງເຕືອນໃຫ້ເຂົາລະບົບເເອັດມິນ -->
<?php
if (isset($_SESSION['noadmin'])): ?>
    <div class="alert alert-danger">
        <?php
        echo $_SESSION['noadmin'];
        unset($_SESSION['noadmin']);
        ?>
    </div>
<?php endif; ?>
<!-- ເເຈ້ງເຕືອນເມື່ອລະຫັດບໍ່ຖືກຕ້ອງ -->
<?php
if (isset($_SESSION['modelnot'])): ?>
    <div class="alert alert-danger">
        <?php
        echo $_SESSION['modelnot'];
        unset($_SESSION['modelnot']);
        ?>
    </div>
<?php endif; ?>
 
<?php
include_once('../server/server.php');
//  ສະເເດງຂໍ້ມູນພະນັກງານ 
$users = selectData($connection, "tb_users");
?>

<?php
// ການຄົ້ນຫາຂໍ້ມູນ
$search = isset($_GET['search']) ? $_GET['search'] : '';
$users = searchData($connection, "tb_users", "name", $search);
?>

<div class="container">
    <div class="bg-white shadow rounded p-3 mb-3 d-flex justify-content-between">
        <form class="d-flex col-lg-5 col-md-5" role="search" method="GET" action="">
            <input class="form-control me-2" type="search" name="search" placeholder="ຄົ້ນຫາລາຍຊື່" aria-label="Search" value="<?php echo htmlspecialchars($search); ?>">
            <button class="btn btn-outline-success" type="submit">ຄົ້ນຫາ</button>
        </form>
        <div class="d-flex align-items-center">
            <button type="button" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#alertModal">
                ເພີ່ມພະນັກງານ
            </button>
        </div>
    </div>
</div>

<!-- Display User Data -->
<div class="container">
    <table class="table table-striped table-bordered">
        <thead class="table-dark">
            <tr>
                <th scope="col">User ID</th>
                <th scope="col">Name</th>
                <th scope="col">Picture</th>
                <th scope="col">Number</th>
                <th scope="col">Address</th>
                <th scope="col">Salary</th>
                <th scope="col">Data</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $number = 1;
            ?>
            <?php foreach ($users as $user): ?>
                <tr>
                    <td><?php echo $number++; ?></td>
                    <td><?php echo htmlspecialchars($user['name']); ?></td>
                    <td>
                        <img src="<?php echo htmlspecialchars($user['picture']); ?>" alt="Picture" style="width: 50px; height: 50px;">
                    </td>
                    <td><?php echo htmlspecialchars($user['number']); ?></td>
                    <td><?php echo htmlspecialchars($user['address']); ?></td>
                    <td><?php echo number_format($user['salary'], 0, '.', ',') . " ກີບ"; ?></td>
                    <td><?php echo htmlspecialchars($user['data']); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<!-- admin insert to insert users -->
<div class="modal fade" id="alertModal" tabindex="-1" aria-labelledby="alertModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="alertModalLabel">Insert Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="/katucafee3/backend/buser.php">
                    <div class="mb-3">
                        <label for="username" class="form-label">Admin name</label>
                        <input type="text" class="form-control" id="username" name="username" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Admin password</label>
                        <input type="text" class="form-control" id="password" name="password" required>
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