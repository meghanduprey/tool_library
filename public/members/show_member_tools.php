<?php require_once('../../private/initialize.php'); ?>
<?php require_login(); ?>

<?php $member_set = find_tool_by_member_id(); ?>

<?php $page_title = 'My Tools'; ?>
<?php include(SHARED_PATH . '/header.php'); ?>
<h2>My Tools</h2>
<div class="">
  <?php while ($member = mysqli_fetch_assoc($member_set)) { ?>
  <div>
    
  </div>
}
</div>








<?php include(SHARED_PATH . '/footer.php'); ?>
