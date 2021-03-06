<?php require_once('../../private/initialize.php'); ?>

<?php $page_title = 'You are not an admin'; ?>

<?php include(SHARED_PATH . '/header.php'); ?>

<div id="content">
  <div class="center">
    <h1>You are not an admin</h1>
    <p>Sorry, only administrators have access to this page.</p>
    <p><a href="<?php echo url_for('/members/browse.php'); ?>">&laquo; Browse Tools</a></p>
  </div>

  
  <div class="push"></div>
</div>

<?php include(SHARED_PATH . '/footer.php'); ?>
