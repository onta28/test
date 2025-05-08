<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ໃບບິນ</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <style>
        body {
            font-family: "Noto Serif Lao", serif;
        }
        .bill-container {
            max-width: 800px;
            margin: 0 auto;
        }
        @media print {
            .no-print {
                display: none !important;
            }
            @page {
                size: 80mm auto;  
                margin: 5mm;
            }
            body {
                width: 80mm;
            }
        }
    </style>

</head>

<body class="bg-side">
    <div class="container d-flex justify-content-center mt-5 text-center print-area">
        <div class="bg-light bill-container rounded-3 text-dark p-4">
            <h4 class="mb-3">ໃບບິນຮ້ານ ກະຕູຄາເຟ່</h4>
            <table class="table mb-3 fs-6">
                <thead>
                    <tr>
                        <th>ລາຍການ</th>
                        <th>ປະເພດ</th>
                        <th>ຈໍານວນ</th>
                        <th>ລາຄ່າ</th>
                        <th>ລວມ</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider" id="tbbill">
                    <?php
                    $total = 0;
                    foreach ($_SESSION['bill'] as $item):
                        $total += $item['total'];
                    ?>
                        <tr>
                            <td><?= htmlspecialchars($item['name']) ?></td>
                            <td><?= htmlspecialchars($item['type']) ?></td>
                            <td><?= htmlspecialchars($item['qty']) ?></td>
                            <td><?= number_format($item['price']) ?></td>
                            <td><?= number_format($item['total']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <p><strong>ລວມທັງໝົດ: <?= number_format($total) ?> ກີບ</strong></p>
            <p>ຂໍຂອບໃຈທີ່ໃຊ້ບໍລິການ</p>
        </div>
    </div>
    <div class="d-flex justify-content-center mt-5 no-print">
        <button type="button" class="btn btn-primary me-5" onClick="window.print()">
            <i class="fa-solid fa-print"></i> ພິມບິນ
        </button>
        <a href="sell.php" class="btn btn-danger">
            <i class="fa-solid fa-xmark"></i> ປິດ
        </a>
    </div>
    <script>
        function destroySession(event) {
            event.preventDefault();
            fetch(<?php unset($_SESSION['bill']); ?>)
                .then(response => response.text())
                .then(() => {
                    window.location.href = "sell.php";
                });
        }
    </script>
</body>

</html>