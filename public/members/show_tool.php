<?php require_once('../../private/initialize.php'); ?>

<?php
// $id = isset($_GET['id']) ? $_GET['id'] : '1';
$id = $_GET['id'] ?? '1'; // PHP > 7.0

$tool = find_tool_by_id($id);
?>

<?php $page_title = 'Show Tool'; ?>
<?php include(SHARED_PATH . '/header.php'); ?>

<div id="content">

  <a class="back-link" href="<?php echo url_for('/index.php'); ?>">&laquo; Back to home</a>

  <h2>Tool: <?php echo h($tool['tool_ID']); ?></h2>
  <p>Serial Number: <?php echo h($tool['serial_number']); ?></p>
  <p>Tool Name: <?php echo h($tool['tool_name']); ?></p>
  <p>Tool Description: <?php echo h($tool['tool_desc']); ?></p>
  <p>Tool Image: <? php echo h($tool['tool_picture']); ?></p>

</div>
<?php include(SHARED_PATH . '/footer.php'); ?>
