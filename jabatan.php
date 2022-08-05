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
$stmt = $pdo->prepare('SELECT * FROM jabatan ORDER BY id_jabatan LIMIT :current_page, :record_per_page');
$stmt->bindValue(':current_page', ($page-1)*$records_per_page, PDO::PARAM_INT);
$stmt->bindValue(':record_per_page', $records_per_page, PDO::PARAM_INT);
$stmt->execute();
// Fetch the records so we can display them in our template.
$contacts = $stmt->fetchAll(PDO::FETCH_ASSOC);


// Get the total number of contacts, this is so we can determine whether there should be a next and previous button
$num_contacts = $pdo->query('SELECT COUNT(*) FROM jabatan')->fetchColumn();
?>


<?=template_header('Read')?>

<div class="content read">
	<h2>jabatan</h2>
	<a href="create-jabatan.php" class="create-contact">tambah</a>
	<table>
        <thead>
            <tr>
                <td>Id jabatan</td>
                <td>Nama jabatan</td>
                <td>gaji</td>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($contacts as $contact): ?>
            <tr>
                <td><?=$contact['id_jabatan']?></td>
                <td><?=$contact['nama_jabatan']?></td>
                <td><?=$contact['gaji']?></td>
                <td class="actions">
                    <a href="update-jabatan.php?id_jabatan=<?=$contact['id_jabatan']?>" class="edit"><i class="fas fa-pen fa-xs"></i></a>
                    <a href="delete-jabatan.php?id_jabatan=<?=$contact['id_jabatan']?>" class="trash"><i class="fas fa-trash fa-xs"></i></a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?=template_footer()?>