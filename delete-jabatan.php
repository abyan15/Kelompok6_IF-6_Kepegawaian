<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';
// Check that the contact ID exists
if (isset($_GET['id_jabatan'])) {
    // Select the record that is going to be deleted
    $stmt = $pdo->prepare('SELECT * FROM jabatan WHERE id_jabatan = ?');
    $stmt->execute([$_GET['id_jabatan']]);
    $contact = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$contact) {
        exit('Contact doesn\'t exist with that ID!');
    }
    // Make sure the user confirms beore deletion
    if (isset($_GET['confirm'])) {
        if ($_GET['confirm'] == 'yes') {
            // User clicked the "Yes" button, delete record
            $stmt = $pdo->prepare('DELETE FROM jabatan WHERE id_jabatan = ?');
            $stmt->execute([$_GET['id_jabatan']]);
            $msg = 'You have deleted the contact!';
        } else {
            // User clicked the "No" button, redirect them back to the read page
            header('Location:jabatan.php');
            exit;
        }
    }
} else {
    exit('No ID specified!');
}
?>


<?=template_header('Delete')?>

<div class="content delete">
	<h2>hapus data jabatan #<?=$contact['id_jabatan']?></h2>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php else: ?>
	<p>yakin hapus data? #<?=$contact['id_jabatan']?>?</p>
    <div class="yesno">
        <a href="delete-jabatan.php?id_jabatan=<?=$contact['id_jabatan']?>&confirm=yes">Yes</a>
        <a href="delete-jabatan.php?id_jabatan=<?=$contact['id_jabatan']?>&confirm=no">No</a>
    </div>
    <?php endif; ?>
</div>

<?=template_footer()?>