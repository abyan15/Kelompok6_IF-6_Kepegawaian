<?php
    session_start();
    if(!isset($_SESSION["username"]))
        header("location: awal.php?");

include 'functions.php';
// Connect to MySQL database
$pdo = pdo_connect_mysql();
// Get the page via GET request (URL param: page), if non exists default the page to 1
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
// Number of records to show on each page
$records_per_page = 100;


// Prepare the SQL statement and get records from our contacts table, LIMIT will determine the page
$stmt = $pdo->prepare('SELECT * FROM pegawai ORDER BY nip LIMIT :current_page, :record_per_page');
$stmt->bindValue(':current_page', ($page-1)*$records_per_page, PDO::PARAM_INT);
$stmt->bindValue(':record_per_page', $records_per_page, PDO::PARAM_INT);
$stmt->execute();
// Fetch the records so we can display them in our template.
$contacts = $stmt->fetchAll(PDO::FETCH_ASSOC);


// Get the total number of contacts, this is so we can determine whether there should be a next and previous button
$num_contacts = $pdo->query('SELECT COUNT(*) FROM pegawai')->fetchColumn();
?>


<?=template_header('Read')?>

<div class="content read">
	<h2>Pegawai</h2>
	<a href="create.php" class="create-contact">tambah </a>
	<table>
        <thead>
            <tr>
                <td>nip</td>
                <td>Nama</td>
                <td>Alamat</td>
                <td>tanggal_lahir</td>
                <td>Jk</td>
                <td>Id Jabatan</td>
                <td>Id Golongan</td>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($contacts as $contact): ?>
            <tr>
                <td><?=$contact['nip']?></td>
                <td><?=$contact['nama']?></td>
                <td><?=$contact['alamat']?></td>
                <td><?=$contact['tanggal_lahir']?></td>
                <td><?=$contact['jk']?></td>
                <td><?=$contact['id_jabatan']?></td>
                <td><?=$contact['id_golongan']?></td>
                <td class="actions">
                    <a href="update.php?nip=<?=$contact['nip']?>" class="edit"><i class="fas fa-pen fa-xs"></i></a>
                    <a href="delete.php?nip=<?=$contact['nip']?>" class="trash"><i class="fas fa-trash fa-xs"></i></a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
	<div class="pagination">
		<?php if ($page > 1): ?>
		<a href="read.php?page=<?=$page-1?>"><i class="fas fa-angle-double-left fa-sm"></i></a>
		<?php endif; ?>
		<?php if ($page*$records_per_page < $num_contacts): ?>
		<a href="read.php?page=<?=$page+1?>"><i class="fas fa-angle-double-right fa-sm"></i></a>
		<?php endif; ?>
	</div>
</div>

<?=template_footer()?>