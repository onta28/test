<?php $page_title = "ເຂົ້າສູ່ລະບົບ"; ?>
<?php
include("../katucafee3/component/button.php");
require_once "../katucafee3/utils/MainHeard.php";
require_once "../katucafee3/utils/Mainfooter.php";
?>
 
<div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="row justify-content-center w-100">
        <div class="col-md-4">
            <form action="/katucafee3/backend/blogin.php" method="post" class="border p-4 rounded shadow bg-white">
            <div class="d-flex justify-content-center">
                <img class="img-fluid" style="width: 50px; height: 50px;" src="/katucafee3/assets/katucafe.png" alt="Girl in a jacket">
            </div>
                <h4 class="text-center">KATU CAFE</h4>
                <div class="mb-3">
                    <?php
                    session_start();
                    if (isset($_SESSION['message'])): ?>
                        <div class="alert alert-danger">
                            <?php
                            echo $_SESSION['message'];
                            unset($_SESSION['message']);
                            ?>
                        </div>
                    <?php endif; ?>
                    <?php
                    if (isset($_SESSION['nopassword'])): ?>
                        <div class="alert alert-danger">
                            <?php
                            echo $_SESSION['nopassword'];
                            unset($_SESSION['nopassword']);
                            ?>
                        </div>
                    <?php endif; ?>

                    <label for="username" class="form-label">ຊື່ຜູ້ໃຊ້</label>
                    <input type="text" class="form-control" id="username" name="username" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">ລະຫັດຜູ້ໃຊ້</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <?=ButtonText("ເຂົ້າສູ່ລະບົບ", "btn-success w-100", "submit")?>
            </form>
        </div>
    </div>
</div>
<?php
require_once "../../utils/Mainfooter.php";
?>