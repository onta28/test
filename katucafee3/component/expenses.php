<?php
$page_title = "ການໃຊ້ຈ່າຍ";
require_once "../utils/MainHeard.php";
?>
<div class="">
   <?php
   include("../utils/nav.php"); ?>

   <div class="row">
      <?php include_once("../utils/sidbar.php"); ?>

      <main class="col-lg-10 p-1">
         <?php include("../pages/showexpenses.php");
         ?>
      </main>
   </div>
</div>
<?php
require_once "../utils/Mainfooter.php";
?>