<div class="container mt-4">
    <?php
    include('../server/server.php');
    $summary_daily = selectData($connection, 'tb_summary_daily');
    $summary_monthly = selectData($connection, 'tb_summary_monthly');
    ?>
    <div class="container mt-4">
    <form action="../backend/sell/binsert.php" method="post">
    <div class="d-flex justify-content-between">
        <h2 class="text-center mb-3">ລາຍຮັບປະຈໍາເດືອນ</h2>
        <button name="sive" class="m-3 btn btn-primary">ສະຫຼຸບມື້ນີ້</button>
    </div>
</form>

        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>ລໍາດັບ</th>
                    <th>ໃນເດືອນທີ</th>
                    <th>ເງີນທັງຫມົດ</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($summary_monthly as $monthly): ?>
                    <tr>
                        <td><?php echo $monthly["SummaryID"]; ?></td>
                        <td><?php echo date("d-m-Y", strtotime($monthly['salem'])); ?></td>

                        <td><?php echo number_format($monthly["total_sales"],); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <h2 class="text-center mb-3">ລາຍຮັບປະຈໍາວັນ</h2>
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>ລໍາດັບ</th>
                    <th>ວັນເດືອນປີ</th>
                    <th>ເງິນທັງຫມົດ</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($summary_daily as $daily): ?>
                    <tr>
                        <td><?php echo $daily['SummaryID']; ?></td>
                        <td><?php echo date("d-m-Y", strtotime($daily['sale_date'])); ?></td>
                        <td><?php echo number_format($daily['total_sales'],); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>