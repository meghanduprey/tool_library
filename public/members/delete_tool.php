<?php

require_once('../../private/initialize.php');

if(!isset($_GET['id'])) {
  redirect_to(url_for('/members/admin.php'));
}
$id = $_GET['id'];
if(is_post_request()) {

  $result = delete_tool($id);
  $_SESSION['message'] = 'The member was deleted sucessfully';
  redirect_to(url_for('/members/show_member_tools.php'));

} else {
  $tool = find_tool_by_id($id);
}

?>

<?php $page_title = 'Delete Tool'; ?>
<?php include(SHARED_PATH . '/header.php'); ?>

<div id="content">

  <a class="back-link" href="<?php echo url_for('/index.php'); ?>">&laquo; Back to Home</a>

    <h1>Delete Tool</h1>
    <p>Are you sure you want to delete this tool?</p>
    <p class="item">Tool Name: <?php echo h($tool['tool_name']); ?></p>

    <form action="<?php echo url_for('/members/delete_tool.php?id=' . h(u($tool['tool_ID']))); ?>" method="post">
      <div id="operations">
        <input type="submit" name="commit" value="Delete Tool" >
      </div>
    </form>
  <div class="push"></div>
</div>

<?php include(SHARED_PATH . '/footer.php'); ?>
