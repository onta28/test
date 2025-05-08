 <?php
 $page_title="ຈັດການສີ້ນຄ້າ";
 require_once "../utils/MainHeard.php";
 ?>
    <div class="">
        <?php
             include("../utils/nav.php"); ?>
        <div class="row">
        <?php include_once("../utils/sidbar.php"); ?>
            <main class="col-lg-10 p-1">
            <?php include("../pages/showproduct.php"); ?>

            </main>
        </div>
    </div>
    <?php 
    require_once "../utils/Mainfooter.php";
    ?>