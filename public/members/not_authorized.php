<?php require_once('../../private/initialize.php'); ?>

<?php $page_title = 'You are not an authorized'; ?>

<?php include(SHARED_PATH . '/header.php'); ?>

<main id="content">
  <div class="center">
    <h1>Not Authorized</h1>
    <p>Sorry, you are not authorized to view this page.</p>
    <p><a href="<?php echo url_for('/members/browse.php'); ?>">&laquo; Browse Tools</a></p>
  </div>

  
  <div class="push"></div>
</main>

<?php include(SHARED_PATH . '/footer.php'); ?>
