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
      
    <div class="center">
      <p><a href="<?php echo url_for('/members/browse.php'); ?>">&laquo; Back to Browse</a></p>
    </div>
    <div class="flex">
     <?php while ($show_search_tool = mysqli_fetch_assoc($search_tool)) { ?>
      <div class="card">
        <a class="action" href="<?php echo url_for('/members/show_tool.php?id=' . h(u($show_search_tool['tool_ID']))); ?>">View</a>
        <img src="<?php echo h($show_search_tool['tool_picture']); ?>" alt="<?php echo h($tool['tool_picture']); ?>" width="150" height="auto">
        <p><?php echo h($show_search_tool['serial_number']); ?></p>
        <p><?php echo h($show_search_tool['tool_name']); ?></p>
        <p><?php echo h($show_search_tool['tool_description']); ?></p>
        <p><?php echo h($show_search_tool['category_name']); ?></p>
      </div>
      <?php } ?>
    </div>
 <?php } else { ?>

    <div class="flex">
    <?php while ($tool = mysqli_fetch_assoc($tool_set)) { ?>
      <div class="card">
       <div class="center">
         <a class="action" href="<?php echo url_for('/members/show_tool.php?id=' . h(u($tool['tool_ID']))); ?>">View</a>
       </div>
        <img src="<?php echo h($tool['tool_picture']); ?>" alt="<?php echo h($tool['tool_picture']); ?>" width="150" height="auto">
        <p><?php echo h($tool['serial_number']); ?></p>
        <p><?php echo h($tool['tool_name']); ?></p>
        <p><?php echo h($tool['tool_description']); ?></p>
<!--        put another fetch -->
       <p><?php var_dump ($tool['category_name']); ?></p>
        <p><?php echo h($tool['category_name']); ?></p>
      </div>
    <?php } 
       }
    ?>
    </div>
  

  <div class="push"></div>
  <?php include(SHARED_PATH . '/footer.php'); ?>

</div>