<?php require_once('../../private/initialize.php'); ?>

<?php $tool_set = find_all_tools(); ?>

<?php $page_title = 'Browse Tools'; ?>
<?php include(SHARED_PATH . '/header.php'); ?>
<div id="content">

  <div class="center">
    <h2>Browse Tools</h2>
    <form method="post" action="browse.php">
      <input type="text" name="searchterm">
      <input type="submit" value="Search">
    </form>
  </div>
   <?php if(is_post_request()) {
      $searchterm = $_POST['searchterm'];
      $search_tool = search_form($searchterm); ?>
      
      <p class="center"><a href="<?php echo url_for('/members/browse.php'); ?>">&laquo; Back to Browse</a></p>
      <?php  $saved_tool_ID = "";  ?>
      <?php while ($show_search_tool = mysqli_fetch_assoc($search_tool)) { ?>
     <?php if($show_search_tool['tool_ID'] != $saved_tool_ID) { 
      $saved_tool_ID = $show_search_tool['tool_ID'];
      ?>

        <a class="block" href="<?php echo url_for('/members/show_tool.php?id=' . h(u($show_search_tool['tool_ID']))); ?>">View</a>
        <img src="<?php echo h($show_search_tool['tool_picture']); ?>" alt="<?php echo h($tool['tool_picture']); ?>" width="150">
        <p><?php echo h($show_search_tool['serial_number']); ?></p>
        <p><?php echo h($show_search_tool['tool_name']); ?></p>
        <p><?php echo h($show_search_tool['tool_description']); ?></p>
        <p><?php echo h($show_search_tool['category_name']); ?></p>
        <?php } else { ?>
          <p><?php echo h($show_search_tool['category_name']); ?></p>
        <?php } //end else ?>
      <?php } //end while loop ?>
   <?php } else { ?>

    <?php  $saved_tool_ID = "";  ?>
    <?php while ($tool = mysqli_fetch_assoc($tool_set)) { ?>
     <?php if($tool['tool_ID'] != $saved_tool_ID) { 
      $saved_tool_ID = $tool['tool_ID']; ?>
        <a class="block" href="<?php echo url_for('/members/show_tool.php?id=' . h(u($tool['tool_ID']))); ?>">View</a>
        <img src="<?php echo h($tool['tool_picture']); ?>" alt="<?php echo h($tool['tool_picture']); ?>" width="150">
        <p><?php echo h($tool['serial_number']); ?></p>
        <p><?php echo h($tool['tool_name']); ?></p>
        <p><?php echo h($tool['tool_description']); ?></p>
        <p><?php echo h($tool['category_name']); ?></p>
         <?php } else { ?>
          <p><?php echo h($tool['category_name']); ?></p>
        <?php } //end else ?>
        <?php   } //end while ?>
    <?php   } //end else ?> 
  

  <div class="push"></div>
</div>
  <?php include(SHARED_PATH . '/footer.php'); ?>
