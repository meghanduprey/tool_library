<?php require_once('../../private/initialize.php'); ?>

<?php
// $id = isset($_GET['id']) ? $_GET['id'] : '1';
$id = $_GET['id'] ?? '1'; // PHP > 7.0
require_login();
$tool = find_tool_by_id($id);

$email = find_email_by_tool_ID($id);
?>

<?php $page_title = 'Show Tool'; ?>
<?php include(SHARED_PATH . '/header.php'); ?>

<div id="content">

  <div class="center">
    <p><a href="<?php echo url_for('/members/browse.php'); ?>">&laquo; Browse All Tools</a></p>
    <p><a href="<?php echo url_for('/members/new_tool.php'); ?>">&laquo; Add a tool</a></p>
  </div>

  <h2>Tool: <?php echo h($tool['tool_ID']); ?></h2>
  <p>Serial Number: <?php echo h($tool['serial_number']); ?></p>
  <p>Tool Name: <?php echo h($tool['tool_name']); ?></p>
  <p>Tool Description: <?php echo h($tool['tool_description']); ?></p>
  <p>Tool Category: <?php echo h($tool['category_ID']); ?></p>
  <p>Tool Picture: <br><img src="<?php echo h($tool['tool_picture']); ?>"  alt="<?php echo h($tool['tool_picture']); ?>" width="200"></p>
  <a href="<?php echo 'mailto:' . $email; ?>">Email Owner to request tool</a>
  <div class="push">
  </div>
</div>
<?php include(SHARED_PATH . '/footer.php'); ?>
