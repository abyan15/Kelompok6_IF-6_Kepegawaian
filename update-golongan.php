<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';
// Check if the contact id exists, for example update.php?id=1 will get the contact with the id of 1
if (isset($_GET['id_golongan'])) {
    if (!empty($_POST)) {
        // This part is similar to the create.php, but instead we update a record and not insert
        $id_golongan = isset($_POST['id_golongan']) ? $_POST['id_golongan'] : '';
        $nama_golongan = isset($_POST['nama_golongan']) ? $_POST['nama_golongan'] : '';
        $tunjangan_golongan = isset($_POST['tunjangan_golongan']) ? $_POST['tunjangan_golongan'] : '';
        // Update the record
        $stmt = $pdo->prepare('UPDATE golongan SET id_golongan = ?, nama_golongan = ?, tunjangan_golongan = ? WHERE id_golongan = ?');
        $stmt->execute([$id_golongan, $nama_golongan, $tunjangan_golongan, $_GET['id_golongan']]);
        $msg = 'Updated Successfully!';
    }
    // Get the contact from the contacts table
    $stmt = $pdo->prepare('SELECT * FROM golongan WHERE id_golongan = ?');
    $stmt->execute([$_GET['id_golongan']]);
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
	<h2>Ubah data? #<?=$contact['id_golongan']?></h2>
    <form action="update-golongan.php?id_golongan=<?=$contact['id_golongan']?>" method="post">
        <label for="id_golongan">id golongan</label>
        <label for="nama_golongan">nama golongan</label>
        <input type="text" name="id_golongan" value="<?php echo $contact['id_golongan'];?>" id_golongan="id_golongan" readonly>
        <input type="text" name="nama_golongan" id_golongan="nama_golongan">
        <label for="tunjangan_golongan">tunjangan golongan</label>
        <input type="text" name="tunjangan_golongan" id_golongan="tunjangan_golongan">
        <input type="submit" value="Create">
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=template_footer()?>