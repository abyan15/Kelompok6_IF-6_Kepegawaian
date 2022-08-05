<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';
// Check that the contact ID exists
if (isset($_GET['id_golongan'])) {
    // Select the record that is going to be deleted
    $stmt = $pdo->prepare('SELECT * FROM golongan WHERE id_golongan = ?');
    $stmt->execute([$_GET['id_golongan']]);
    $contact = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$contact) {
        exit('Contact doesn\'t exist with that ID!');
    }
    // Make sure the user confirms beore deletion
    if (isset($_GET['confirm'])) {
        if ($_GET['confirm'] == 'yes') {
            // User clicked the "Yes" button, delete record
            $stmt = $pdo->prepare('DELETE FROM golongan WHERE id_golongan = ?');
            $stmt->execute([$_GET['id_golongan']]);
            $msg = 'You have deleted the contact!';
        } else {
            // User clicked the "No" button, redirect them back to the read page
            header('Location:golongan.php');
            exit;
        }
    }
} else {
    exit('No ID specified!');
}
?>


<?=template_header('Delete')?>

<div class="content delete">
	<h2>hapus data golongan #<?=$contact['id_golongan']?></h2>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php else: ?>
	<p>yakin hapus data? #<?=$contact['id_golongan']?>?</p>
    <div class="yesno">
        <a href="delete-golongan.php?id_golongan=<?=$contact['id_golongan']?>&confirm=yes">Yes</a>
        <a href="delete-golongan.php?id_golongan=<?=$contact['id_golongan']?>&confirm=no">No</a>
    </div>
    <?php endif; ?>
</div>

<?=template_footer()?>