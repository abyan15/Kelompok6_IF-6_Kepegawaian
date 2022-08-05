<?php
session_start();
    if(!isset($_SESSION["username"]))
        header("location: awal.php?");
include 'functions.php';
// Your PHP code here.

// Home Page template below.
?>

<?=template_header('Home')?>

<div class="content">
	<h2>Home</h2>
	<h1>Selamat Datang Adik-Adik <?php echo $_SESSION["nama"]; ?></h1>
</div>

<?=template_footer()?>