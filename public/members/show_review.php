<?php require_once('../../private/initialize.php'); ?>

<?php
// $id = isset($_GET['id']) ? $_GET['id'] : '1';
$id = $_GET['id'] ?? '1'; // PHP > 7.0

$review = find_review_by_id($id);
?>

<?php $page_title = 'Show Member'; ?>
<?php include(SHARED_PATH . '/header.php'); ?>

<div id="content">

  <a class="back-link" href="<?php echo url_for('/members/admin.php'); ?>">&laquo; Back to List</a>

  <div class="member-card">
    <h1>Member: <?php echo h($review['rating']); ?></h1>
    <p>First Name: <?php echo h($review['ratee_member_ID']); ?></p>
    <p>Last Name: <?php echo h($review['rater_member_ID']); ?></p>
    <p>Last Name: <?php echo h($review['rating_text']); ?></p>


  </div>
  <div class="push"></div>
</div>
<?php include(SHARED_PATH . '/footer.php'); ?>
