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
      $search_tool = search_form($searchterm); 
      $search_tool_category = search_form_category($searchterm); ?>
      
      <p class="center"><a href="<?php echo url_for('/members/browse.php'); ?>">&laquo; Back to Browse</a></p>
      <div class="flex">
        <?php while ($show_search_tool = mysqli_fetch_assoc($search_tool)) { ?>
          <div class="card">
           <div class="center">
              <a class="block" href="<?php echo url_for('/members/show_tool.php?id=' . h(u($show_search_tool['tool_ID']))); ?>">View</a>
              <img src="<?php echo h($show_search_tool['tool_picture']); ?>" alt="<?php echo h($tool['tool_picture']); ?>" width="150">
            </div>
            <p><strong>Tool Name: <?php echo h($show_search_tool['tool_name']); ?></strong></p>
            <p>Description: <?php echo h($show_search_tool['tool_description']); ?></p>
            <p class="underline">Categories:</p>
            <ul>
              <?php $id = $show_search_tool['tool_ID']; ?>
                <?php $category_set = find_tool_categories($id); ?>
                <?php while ($category = mysqli_fetch_assoc($category_set)) { ?>
                <li><?php echo h($category['category_name']); ?></li>
                <?php } ?>
            </ul>
            </div>
        <?php } //end while loop ?>
      </div>
      
   <?php } else { ?>
    <div class="flex">
    <?php while ($tool = mysqli_fetch_assoc($tool_set)) { ?>
        <div class="card">
         <div class="center">
            <a class="block" href="<?php echo url_for('/members/show_tool.php?id=' . h(u($tool['tool_ID']))); ?>">View</a>
            <img src="<?php echo h($tool['tool_picture']); ?>" alt="<?php echo h($tool['tool_picture']); ?>" width="150">
          </div>
          <p><strong><span class="underline">Tool Name:</span> <?php echo h($tool['tool_name']); ?></strong></p>
          <p><span class="underline">Description:</span> <?php echo h($tool['tool_description']); ?></p>
          <p class="underline">Categories:</p>
          <ul>
            <?php $id = $tool['tool_ID']; ?>
            <?php $category_set = find_tool_categories($id); ?>
            <?php while ($category = mysqli_fetch_assoc($category_set)) { ?>
            <li><?php echo h($category['category_name']); ?></li>
            <?php } ?>
          </ul>
        </div>
        <?php   } //end while ?>
        </div>
    <?php   } //end else ?> 
  

  <div class="push"></div>
</div>
  <?php include(SHARED_PATH . '/footer.php'); ?>
