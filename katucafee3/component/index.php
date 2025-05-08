<?php
    $page_title = "ການຂາຍ";
    require_once "../utils/MainHeard.php";
    ?>
 <div class="">
     <?php
        include("../utils/nav.php"); ?>
     <div class="row">
     <?php include_once("../utils/sidbar.php"); ?>
         <main class="col-lg-10 p-1">
             <?php include_once('../pages/Dashboard.php');
                ?>
         </main>
     </div>
 </div>
 <?php
    require_once "../utils/Mainfooter.php";
    ?>