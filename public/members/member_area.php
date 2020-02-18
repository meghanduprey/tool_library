<?php require_once('../../private/initialize.php'); ?>

<?php $page_title = 'Member Area'; ?>
<?php include(SHARED_PATH . '/header.php'); ?>
<div id="content">

  <div class="center">
    <h2>Member Area</h2>
    <p><a href="<?php echo url_for('/members/show_member_tools.php'); ?>">My Tools</a></p>
    <p><a href="<?php echo url_for('/members/show_member_ratings.php'); ?>">My Reviews</a></p>
    <p><a href="<?php echo url_for('/members/new_rating.php'); ?>">Leave a Review</a></p>
  </div>
  <p>If you are a member of the Tool Library you can add and delete your tools, request tools from other members, rate other members, and view your ratings. Please <a href="<?php echo url_for('/login.php'); ?>">Login</a> to access these member areas.</p>
   

</div>
<div class="push"></div>
<?php include(SHARED_PATH . '/footer.php'); ?>
