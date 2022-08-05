<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';
// Check if POST data is not empty
if (!empty($_POST)) {
    // Post data not empty insert a new record
    // Set-up the variables that are going to be inserted, we must check if the POST variables exist if not we can default them to blank
    $id_jabatan = isset($_POST['id_jabatan']) && !empty($_POST['id_jabatan']) && $_POST['id_jabatan'] != 'id_jabatan' ? $_POST['id_jabatan'] : NULL;
    // Check if POST variable "name" exists, if not default the value to blank, basically the same for all variables
    $id_jabatan = isset($_POST['id_jabatan']) ? $_POST['id_jabatan'] : '';
    $nama_jabatan = isset($_POST['nama_jabatan']) ? $_POST['nama_jabatan'] : '';
    $gaji = isset($_POST['gaji']) ? $_POST['gaji'] : '';

    // Insert new record into the contacts table
    $stmt = $pdo->prepare('INSERT INTO jabatan VALUES (?, ?, ?)');
    $stmt->execute([$id_jabatan, $nama_jabatan, $gaji ]);
    // Output message
    $msg = 'Created Successfully!';
}
?>


<?=template_header('Create')?>

<div class="content update">
	<h2>jabatan</h2>
    <form action="create-jabatan.php" method="post">
        <label for="id_jabatan">id_jabatan</label>
        <label for="nama_jabatan">nama_jabatan</label>
        <input type="text" name="id_jabatan" value="" jabatan="id_jabatan">
        <input type="text" name="nama_jabatan" jabatan="nama_jabatan">
        <label for="gaji">gaji</label>
        <input type="text" name="gaji" jabatan="gaji">
        <input type="submit" value="Create">
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=template_footer()?>