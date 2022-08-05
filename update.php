<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';
// Check if the contact id exists, for example update.php?id=1 will get the contact with the id of 1
if (isset($_GET['nip'])) {
    if (!empty($_POST)) {
        // This part is similar to the create.php, but instead we update a record and not insert
        $nip = isset($_POST['nip']) ? $_POST['nip'] : '';
        $nama = isset($_POST['nama']) ? $_POST['nama'] : '';
        $alamat = isset($_POST['alamat']) ? $_POST['alamat'] : '';
        $tanggal_lahir = isset($_POST['tanggal_lahir']) ? $_POST['tanggal_lahir'] : '';
        $jk = isset($_POST['jk']) ? $_POST['jk'] : '';
        $id_jabatan = isset($_POST['id_jabatan']) ? $_POST['id_jabatan'] : '';
        $id_golongan = isset($_POST['id_golongan']) ? $_POST['id_golongan'] : '';
        // Update the record
        $stmt = $pdo->prepare('UPDATE pegawai SET nip = ?, nama = ?, alamat = ?, tanggal_lahir = ?, jk = ?, id_jabatan = ?, id_golongan = ? WHERE nip = ?');
        $stmt->execute([$nip, $nama, $alamat, $tanggal_lahir, $jk, $id_jabatan,$id_golongan, $_GET['nip']]);
        $msg = 'Updated Successfully!';
    }
    // Get the contact from the contacts table
    $stmt = $pdo->prepare('SELECT * FROM pegawai WHERE nip = ?');
    $stmt->execute([$_GET['nip']]);
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
	<h2>Ubah data? #<?=$contact['nip']?></h2>
    <form action="update.php?nip=<?=$contact['nip']?>" method="post">
    <label for="nip">Nip</label>
        <label for="nama">Nama</label>
        <input type="text" name="nip" value="<?php echo $contact['nip'];?>" nip="nip" readonly>
        <input type="text" name="nama" nip="nama">
        <label for="alamat">alamat</label>
        <label for="tanggal_lahir">tanggal lahir</label>
        <input type="text" name="alamat" nip="alamat">
        <input type="date" name="tanggal_lahir" nip="tanggal_lahir">
        <label for="jk">jk</label>
        <label for="id_jabatan">id jabatan</label>
        <input type="text" name="jk" nip="jk">
        <input type="text" name="id_jabatan" nip="id_jabatan">
        <label for="id_golongan">id golongan</label>
        <input type="text" name="id_golongan" nip="id_golongan">
        <input type="submit" value="Create">
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=template_footer()?>