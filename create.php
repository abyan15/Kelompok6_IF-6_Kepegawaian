<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';
// Check if POST data is not empty
if (!empty($_POST)) {
    // Post data not empty insert a new record
    // Set-up the variables that are going to be inserted, we must check if the POST variables exist if not we can default them to blank
    $nip = isset($_POST['nip']) && !empty($_POST['nip']) && $_POST['nip'] != 'nip' ? $_POST['nip'] : NULL;
    // Check if POST variable "name" exists, if not default the value to blank, basically the same for all variables
    $nama = isset($_POST['nama']) ? $_POST['nama'] : '';
    $alamat = isset($_POST['alamat']) ? $_POST['alamat'] : '';
    $tanggal_lahir = isset($_POST['tanggal_lahir']) ? $_POST['tanggal_lahir'] : '';
    $jk = isset($_POST['jk']) ? $_POST['jk'] : '';
    $id_jabatan = isset($_POST['id_jabatan']) ? $_POST['id_jabatan'] : '';
    $id_golongan = isset($_POST['id_golongan']) ? $_POST['id_golongan'] : '';

    // Insert new record into the contacts table
    $stmt = $pdo->prepare('INSERT INTO pegawai VALUES (?, ?, ?, ?, ?, ?, ?)');
    $stmt->execute([$nip, $nama, $alamat, $tanggal_lahir, $jk, $id_jabatan , $id_golongan]);
    // Output message
    $msg = 'Created Successfully!';
}
?>


<?=template_header('Create')?>

<div class="content update">
	<h2>Pegawai</h2>
    <form action="create.php" method="post">
        <label for="nip">Nip</label>
        <label for="nama">Nama</label>
        <input type="text" name="nip" value="" nip="nip">
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