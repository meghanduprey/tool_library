<?php require_once('../../private/initialize.php'); ?>

<?php
// $id = isset($_GET['id']) ? $_GET['id'] : '1';
$id = $_GET['id'] ?? '1'; // PHP > 7.0

$member = find_member_by_id($id);
?>

<?php $page_title = 'My Tools'; ?>
<?php include(SHARED_PATH . '/header.php'); ?>










<?php include(SHARED_PATH . '/footer.php'); ?>
