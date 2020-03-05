<?php require_once('../../private/initialize.php'); ?>
<?php require_login(); ?>

<?php $tool_set = find_tool_by_member_id(); ?>

<?php $page_title = 'My Tools'; ?>
<?php include(SHARED_PATH . '/header.php'); ?>
<main id="content">
  <div class="center">
    <h1>My Tools</h1>
    <p><a href="<?php echo url_for('/members/new_tool.php'); ?>">Add New Tool</a></p>
  </div>
  <div class="flex">
    <?php while ($tool = mysqli_fetch_assoc($tool_set)) { ?>
      <div class="card">
        <div class="center">
          <a class="block" href="<?php echo url_for('/members/edit_tool.php?id=' . h(u($tool['tool_ID']))); ?>">Edit tool</a>
        <img src="<?php echo h($tool['tool_picture']); ?>" alt="<?php echo h($tool['tool_picture']); ?>" width="150">
        </div>
        <p>Serial Number: <?php echo h($tool['serial_number']); ?></p>
        <p><strong>Tool Name: <?php echo h($tool['tool_name']); ?></strong></p>
        <p>Tool Description: <?php echo h($tool['tool_description']); ?></p>
        <p class="underline"><strong>Categories:</strong></p>
        <ul>
          <?php $id = $tool['tool_ID']; ?>
          <?php $category_set = find_tool_categories($id); ?>
          <?php while ($category = mysqli_fetch_assoc($category_set)) { ?>
            <li><?php echo h($category['category_name']); ?></li>
          <?php } ?>
        </ul>
      </div>
    <?php } //end while ?>
  </div>
</main>
<div class="push"></div>






<?php include(SHARED_PATH . '/footer.php'); ?>
