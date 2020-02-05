<?php require_once('../../private/initialize.php'); ?>
<?php require_login(); ?>

<?php $tool_set = find_tool_by_member_id(); ?>

<?php $page_title = 'My Tools'; ?>
<?php include(SHARED_PATH . '/header.php'); ?>
<div id="content">
  <div class="center">
    <h2>My Tools</h2>
    <p><a href="<?php echo url_for('/members/new_tool.php'); ?>">Add New Tool</a></p>
  </div>
   <?php  $saved_tool_ID = "";  ?>
    <?php while ($tool = mysqli_fetch_assoc($tool_set)) { 
    if($tool['tool_ID'] != $saved_tool_ID) { 
      $saved_tool_ID = $tool['tool_ID'];
    ?>
        <a class="block" href="<?php echo url_for('/members/edit_tool.php?id=' . h(u($tool['tool_ID']))); ?>">Edit tool</a>
      <img src="<?php echo h($tool['tool_picture']); ?>" alt="<?php echo h($tool['tool_picture']); ?>" width="150" height="auto">
      <p><?php echo h($tool['serial_number']); ?></p>
      <p><?php echo h($tool['tool_name']); ?></p>
      <p><?php echo h($tool['tool_description']); ?></p>
      
      <p><?php echo h($tool['category_name']); ?></p>
      <?php } else { ?>
        <p><?php echo h($tool['category_name']); ?></p>
        <?php } //end else?>
  <?php } //end while ?>
  <div class="push"></div>
</div>






<?php include(SHARED_PATH . '/footer.php'); ?>
