<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';
// Check if POST data is not empty
if (!empty($_POST)) {
    // Post data not empty insert a new record
    // Set-up the variables that are going to be inserted, we must check if the POST variables exist if not we can default them to blank
    $golongan = isset($_POST['id_golongan']) && !empty($_POST['id_golongan']) && $_POST['id_golongan'] != 'id_golongan' ? $_POST['id_golongan'] : NULL;
    // Check if POST variable "name" exists, if not default the value to blank, basically the same for all variables
    $id_golongan = isset($_POST['id_golongan']) ? $_POST['id_golongan'] : '';
    $nama_golongan = isset($_POST['nama_golongan']) ? $_POST['nama_golongan'] : '';
    $tunjangan_golongan = isset($_POST['tunjangan_golongan']) ? $_POST['tunjangan_golongan'] : '';

    // Insert new record into the contacts table
    $stmt = $pdo->prepare('INSERT INTO golongan VALUES (?, ?, ?)');
    $stmt->execute([$id_golongan, $nama_golongan, $tunjangan_golongan ]);
    // Output message
    $msg = 'Created Successfully!';
}
?>


<?=template_header('Create')?>

<div class="content update">
	<h2>Golongan</h2>
    <form action="create-golongan.php" method="post">
        <label for="id_golongan">id_golongan</label>
        <label for="nama_golongan">nama_golongan</label>
        <input type="text" name="id_golongan" value="" golongan="id_golongan">
        <input type="text" name="nama_golongan" golongan="nama_golongan">
        <label for="tunjangan_golongan">tunjangan_golongan</label>
        <input type="text" name="tunjangan_golongan" golongan="tunjangan_golongan">
        <input type="submit" value="Create">
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=template_footer()?>