<?php require_once('../../private/initialize.php'); ?>

<?php
// $id = isset($_GET['id']) ? $_GET['id'] : '1';
$id = $_GET['id'] ?? '1'; // PHP > 7.0
require_login();
$tool = find_tool_by_id($id);
$category_set = find_tool_categories($id);
$email = find_email_by_tool_ID($id);
?>

<?php $page_title = 'Show Tool'; ?>
<?php include(SHARED_PATH . '/header.php'); ?>

<div id="content">

  <div class="center">
    <p><a href="<?php echo url_for('/members/browse.php'); ?>">&laquo; Browse All Tools</a></p>
    <p><a href="<?php echo url_for('/members/new_tool.php'); ?>">&laquo; Add a tool</a></p>
  </div>
    <div class="card center-card">
     <div class="center">
        <img src="<?php echo h($tool['tool_picture']); ?>"  alt="<?php echo h($tool['tool_picture']); ?>" width="150">
      </div>
      <p>Tool Name: <?php echo h($tool['tool_name']); ?></p>
      <p>Tool Description: <?php echo h($tool['tool_description']); ?></p>
      <p class="underline"><strong>Categories:</strong></p>
      <ul>
      <?php $category_set = find_tool_categories($id); ?>
        <?php while ($category = mysqli_fetch_assoc($category_set)) { ?>
        <li><?php echo h($category['category_name']); ?></li>
      <?php } ?>
      </ul>
      <p><a href="<?php echo 'mailto:' . $email; ?>">Email Owner to request tool</a></p>
      <p><a href="<?php echo url_for('members/show_member_ratings_by_tool_ID.php?id=' . h(u($tool['tool_ID']))); ?>">Show Member Ratings</a></p>
    </div>
  
  <div class="push">
  </div>
</div>
<?php include(SHARED_PATH . '/footer.php'); ?>
