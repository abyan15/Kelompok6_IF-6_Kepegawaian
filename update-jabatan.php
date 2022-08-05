<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';
// Check if the contact id exists, for example update.php?id=1 will get the contact with the id of 1
if (isset($_GET['id_jabatan'])) {
    if (!empty($_POST)) {
        // This part is similar to the create.php, but instead we update a record and not insert
        $id_jabatan = isset($_POST['id_jabatan']) ? $_POST['id_jabatan'] : '';
        $nama_jabatan = isset($_POST['nama_jabatan']) ? $_POST['nama_jabatan'] : '';
        $gaji = isset($_POST['gaji']) ? $_POST['gaji'] : '';
        // Update the record
        $stmt = $pdo->prepare('UPDATE jabatan SET id_jabatan = ?, nama_jabatan = ?, gaji = ? WHERE id_jabatan = ?');
        $stmt->execute([$id_jabatan, $nama_jabatan, $gaji, $_GET['id_jabatan']]);
        $msg = 'Updated Successfully!';
    }
    // Get the contact from the contacts table
    $stmt = $pdo->prepare('SELECT * FROM jabatan WHERE id_jabatan = ?');
    $stmt->execute([$_GET['id_jabatan']]);
    $contact = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$contact) {
        exit('Contact doesn\'t exist with that ID!');
    }
} else {
    exit('No ID specified!');
}
?>



<?=template_header('Read')?>

<div class="content update">
	<h2>Ubah data? #<?=$contact['id_jabatan']?></h2>
    <form action="update-jabatan.php?id_jabatan=<?=$contact['id_jabatan']?>" method="post">
        <label for="id_jabatan">id jabatan</label>
        <label for="nama_jabatan">nama jabatan</label>
        <input type="text" name="id_jabatan" value="<?php echo $contact['id_jabatan'];?>" id_jabatan="id_jabatan" readonly>
        <input type="text" name="nama_jabatan" id_jabatan="nama_golongan">
        <label for="gaji">gaji</label>
        <input type="text" name="gaji" id_jabatan="gaji">
        <input type="submit" value="Create">
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=template_footer()?>