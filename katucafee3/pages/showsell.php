<?php
// ເປັນ ພີິເຮັດພີ ສະຄິບ
include("../server/server.php");
$product = selectData($connection, "tb_product"); //ການສະເເດງຂໍ້ມູນ

if (!isset($_SESSION['bill'])) {                                     // ກວດສອບວ່າມີການໃສ່ຄ່າໃຫ້ກັບ $_SESSION['bill']  ຖ້າບໍ່ມີໃຫ້ເປັນຄ່າວ່າງ
    $_SESSION['bill'] = [];
}
// ຖ້າມີແລ້ວເພີ່ມຈວນ Qty ແລະຄໍານວນ total   
function addBill($productName, $productType, $productPrice, $productID)
{
    foreach ($_SESSION['bill'] as &$item) {
        if ($item['name'] === $productName) {
            $item['qty'] += 1;
            $item['total'] = $item['qty'] * $item['price'];
            return;
        }
    }
    $_SESSION['bill'][] = [
        'name' => $productName,
        'type' => $productType,
        'qty' => 1,
        'price' => $productPrice,
        'total' => $productPrice,
        'ProductID' => $productID
    ];
}
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['ProductID'])) {
    addBill($_POST['product_name'], $_POST['product_type'], $_POST['product_price'], $_POST['ProductID']);
}
function calculateTotal()
{
    $total = 0;
    foreach ($_SESSION['bill'] as $item) {
        $total += $item['total'];
    }
    return $total;
}
$_SESSION["calculate"] = number_format(calculateTotal());
if (isset($_GET['search'])) {
    $searchTerm = $_GET['search'];
    $sql = "SELECT * FROM tb_product WHERE ProductName LIKE :searchTerm";
    $statement = $connection->prepare($sql);
    $statement->execute(['searchTerm' => '%' . $searchTerm . '%']);
    $product = $statement->fetchAll(PDO::FETCH_ASSOC);
}
if (isset($_GET['cancel_bill'])) {
    unset($_SESSION['bill']);
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}
function calculateQtyTotal()
{
    $qtyTotal = 0;
    foreach ($_SESSION['bill'] as $item) {
        $qtyTotal += $item['qty'];
    }
    return $qtyTotal;
}
function displayFilteredProducts($products, $filterType = null)
{
    $filterType = isset($_GET['product_type']) ? $_GET['product_type'] : null;

    foreach ($products as $product) {
        if ($filterType === null || $product['DrinkType'] === $filterType) {
            echo '<div class="col-12 col-sm-6 col-md-3">
                    <form action="" method="post" class="bg-side d-flex flex-column align-items-center justify-content-between p-1 shadow-lg h-100">
                        <button type="submit" class="btn btn-success add-to-bill">
                            <img src="../productpictures' . $product['Product_image'] . '" alt="Picture" style="width: 80px; height: 80px;">
                            <h5 class="text-center mt-auto">' . $product['DrinkType'] . '</h5>
                            <p>' . $product['ProductName'] . '</p>
                            <div class="w-100 d-flex gap-2">
                                <input style="pointer-events: none;" type="text" value="' . number_format($product['Product_price'], 0) . ' ກີບ" class="form-control text-center" disabled>
                            </div>
                        </button>
                        <input type="hidden" id="ProductID" name="ProductID" value="' . $product['ProductID'] . '">
                        <input type="hidden" id="product_type" name="product_type" value="' . $product['DrinkType'] . '">
                        <input type="hidden" id="product_name" name="product_name" value="' . $product['ProductName'] . '">
                        <input type="hidden" id="product_price" name="product_price" value="' . $product['Product_price'] . '">
                    </form>
                </div>';
        }
    }
}


$filterType = isset($_GET['product_type']) ? $_GET['product_type'] : null;
?>
<div class="container">
    <div class="d-flex">
        <form class="d-flex w-50" role="search" method="get" id="frmSearch">
            <input class="form-control me-2 border border-secondary" type="search" id="txtsearch" name="search" value="<?= isset($_GET['search']) ? $_GET['search'] : '' ?>" placeholder="ຄົ້ນຫາສີ້ນຄ້າ" aria-label="Search" autocomplete="off">
            <button class="btn btn-success" type="submit">ຄົ້ນຫາ</button>
        </form>
        <form class="d-flex w-25" method="get" id="filterForm">
            <select class="form-select form-select-lg w-100" name="product_type" aria-label="Select Drink Type" onchange="this.form.submit()">
                <option>ເລືອກປະເພດ</option>
                <option value="ຮ້ອນ" <?= isset($_GET['product_type']) && $_GET['product_type'] == 'ຮ້ອນ' ? 'selected' : '' ?>>ຮ້ອນ</option>
                <option value="ເຢັນ" <?= isset($_GET['product_type']) && $_GET['product_type'] == 'ເຢັນ' ? 'selected' : '' ?>>ເຢັນ</option>
                <option value="ປັ່ນ" <?= isset($_GET['product_type']) && $_GET['product_type'] == 'blended' ? 'selected' : '' ?>>ປັ່ນ</option>
            </select>
            
        </form>
    </div>
    <div class="row">
        <div class="col-lg-8">
            <br>
            <div class="container">
                <div class="row g-3">
                    <?php displayFilteredProducts($product, $filterType); ?>
                </div>
            </div>
        </div>
        <!-- ບິນ -->
        <div class="col-12 col-lg-4">
            <div class="bg-light text-dark mt-3 rounded d-flex flex-column border border-secondary p-3">
                <h4 class="text-center">ຮ້ານກະຕູຄ່າເເຟ່</h4>
                <div class="table-responsive">
                    <table class="table mb-3 fs-6">
                        <thead>
                            <tr>
                                <th>
                                    ລາຍການ
                                </th>
                                <th>
                                    ປະເພດ
                                </th>
                                <th>
                                    ຈໍານວນ
                                </th>
                                <th>
                                    ລາຄ່າ
                                </th>
                                <th>
                                    ລວມ
                                </th>
                            </tr>
                        </thead>
                        <tbody class="table-group-divider" id="tbbill">
                            <?php foreach ($_SESSION['bill'] as $item): ?>
                                <tr>
                                    <td><?= $item['name'] ?></td>
                                    <td><?= $item['type'] ?></td>
                                    <td><?= $item['qty'] ?></td>
                                    <td><?= number_format($item['price']) ?></td>
                                    <td><?= number_format($item['total']) ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <div id="total">
                    <?php
                    $_SESSION['allpriceinbill'] = calculateTotal();

                    // if (isset($_POST['product_type'])) {
                    echo '<div class="alert alert-primary">';
                    echo '<h5>ລວມລາຄາ: <span class="fw-bold">' . number_format(calculateTotal()) . '</span> ກີບ</h5>';
                    echo '<h5>ຈໍານວນທັງໝົດ: <span class="fw-bold">' . calculateQtyTotal() . '</span> ລາຍການ</h5>';
                    echo '</div>';

                    // }
                    ?>
                </div>
                <form id="frmpayment">
                    <div class="mb-2 d-flex gap-1 p-3">
                        <input class="form-control" type="search" id="Price" value="0"  placeholder="ຈໍານວນເງິນ" autocomplete="off">
                        <button class="btn btn-outline-success text-light btn-primary" id="btnfull">ຈ່າຍເຕັມ</button>
                    </div>
                    <div class="d-flex justify-content-between mb-3">
                        <a href="../backend/sell/binsert.php" id="printBill" class="btn btn-primary w-100 me-2">ພິມບິນ</a>
                        <a href="?cancel_bill=true" class="btn btn-danger w-100">ຍົກເລີກ</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php $_SESSION['alltotal'] = calculateTotal() ?>
<?php $_SESSION['listprice'] = calculateQtyTotal() ?>
<script>
    const sound = new Audio("http://localhost/katucafee/sound/WhatsApp Audio 2024-09-22 at 20.33.30_901d4352.mp3");
    document.addEventListener("DOMContentLoaded", function() {
        document.getElementById("btnfull").addEventListener("click", function(event) {
            event.preventDefault();
            let totalAmount = <?= json_encode(calculateTotal()); ?>;
            let priceInput = document.getElementById("Price");
            priceInput.value = totalAmount;
        });
        document.getElementById("printBill").addEventListener("click", function(event) {
            event.preventDefault();
            let totalAmount = <?= json_encode(calculateTotal()); ?>;
            let receivedAmount = parseFloat(document.getElementById("Price").value);

            if (isNaN(receivedAmount)) {
                Swal.fire({
                    title: "ແຈ້ງເຕືອນ",
                    text: "ກະລຸນາປ້ອນຈໍານວນເງິນ!",
                    icon: "error",
                    confirmButtonText: "ຕົກລົງ"
                });
                return;
            }
            if(receivedAmount===0){
                Swal.fire({
                    title: "ກະລຸນາເລືອກສີ້ນຄ້າ",
                    text: "ຢາງນ້ອຍໜຶງລາຍການ",
                    icon: "error",
                    confirmButtonText: "ຕົກລົງ"
                });
                return;
            }
            if (receivedAmount < totalAmount) {
                let missingAmount = (totalAmount - receivedAmount).toLocaleString("en-US");
                Swal.fire({
                    title: "ເງິນບໍ່ພຽງພໍ!",
                    text: `${missingAmount} ກີບ`,
                    icon: "error",
                    confirmButtonText: "ຕົກລົງ"
                });
                return;
            }

            let changeAmount = (receivedAmount - totalAmount).toLocaleString("en-US");

            fetch("../backend/sell/binsert.php", {
                    method: "POST",
                })
                .then(response => response.text()).then(data => {
                    sound.play();
                    let message = ``;
                    if (receivedAmount > totalAmount) {
                        message += ` ຕ້ອງທອນເງິນ ${changeAmount} ກີບ`;
                    }
                    sound.play();
                    Swal.fire({
                        title: "ການສໍາລະເງີນສໍາເເລັດ",
                        text: message + "",
                        icon: "success",
                        showCancelButton: true,
                        confirmButtonText: "ພິມບິນ",
                        cancelButtonText: "ບໍ່ພິມ",
                        reverseButtons: true
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = "print.php";
                        }
                    });
                }).catch(error => {
                    console.error("ການພິ່ມບິນນບໍ່ສໍາແລັດ", error);
                });
        });
    });
</script>