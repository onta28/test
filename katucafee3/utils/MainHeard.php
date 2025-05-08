<?php
$title = isset($page_title) ? $page_title : "ບໍ່ມີການກໍານົດຊື່ໜ້າ"; 
?>
<!doctype html>
<html lang="en">

<head>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Serif+Lao:wght@100..900&display=swap" rel="stylesheet">
    <link rel="icon" type="image/png" href="../assets/katucafe.png"> 
    <title><?php echo $title;?></title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: "Noto Serif Lao", serif;
        }

        .sidebar {
            height: 100vh;
        }
    </style>
</head>

<body class="bg-light">