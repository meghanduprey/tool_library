<?php require_once('../../private/initialize.php'); ?>

<?php
// $id = isset($_GET['id']) ? $_GET['id'] : '1';
$id = $_GET['id'] ?? '1'; // PHP > 7.0

$member = find_member_by_id($id);
?>

<?php $page_title = 'Show Member'; ?>
<?php include(SHARED_PATH . '/header.php'); ?>

<div id="content">

  <a class="back-link" href="<?php echo url_for('/members/index.php'); ?>">&laquo; Back to List</a>

  <div class="subject show">
  <h1>Member: <?php echo h($member['member_ID']); ?></h1>
  <p>Email: <?php echo h($member['email']); ?></p>
  <p>Phone: <?php echo h($member['phone']); ?></p>
  <p>Member Level: <?php echo h($member['member_level']); ?></p>

  </div>

</div>
