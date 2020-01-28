<?php require_once('../../private/initialize.php'); ?>

<?php $tool_set = find_all_tools(); ?>

<?php $page_title = 'Browse Tools'; ?>
<?php include(SHARED_PATH . '/header.php'); ?>

<div id="content">
  <div class="center">
    <h2>Browse Tools</h2>
  </div>
  <div class="flex">
    <?php while ($tool = mysqli_fetch_assoc($tool_set)) { ?>
    <div class="card">
     <a class="action" href="<?php echo url_for('/members/show_tool.php?id=' . h(u($tool['tool_ID']))); ?>">View</a>
      <img src="<?php echo h($tool['tool_picture']); ?>" alt="<?php echo h($tool['tool_picture']); ?>" width="150" height="auto">
      <p><?php echo h($tool['serial_number']); ?></p>
      <p><?php echo h($tool['tool_name']); ?></p>
      <p><?php echo h($tool['tool_description']); ?></p>
    </div>
    <?php } ?>
  </div>

  <div class="push"></div>
  
</div>