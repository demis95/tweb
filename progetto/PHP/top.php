<?php
/*
Autore: Demis Mazzotta
        Corso B
        MATR 814574
 */
    if (!isset($_SESSION)) { session_start(); }
?>


<!DOCTYPE html>
<html>
<head>
    <title>Style Your Life</title>
    <link href="../CSS/main.css" type="text/css" rel="stylesheet" >
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
    <script src="https://html2canvas.hertzen.com/dist/html2canvas.js"></script>
    <script src="../JS/html2canvas.js"></script>
    <script src="../JS/index.js" type="text/javascript"></script>
</head>

<body>
<div class="bannerarea" id="area">
    <img src="../IMG/banner.png" alt="logo">
</div>
<?php
    if(isset($_SESSION["flash"])){
        ?>
        <div id="flash">
        <?= $_SESSION["flash"] ?>
        </div>
        <?php unset($_SESSION["flash"]);
    }
    ?>
