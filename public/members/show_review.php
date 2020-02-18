<?php require_once('../../private/initialize.php'); ?>

<?php
// $id = isset($_GET['id']) ? $_GET['id'] : '1';
$id = $_GET['id'] ?? '1'; // PHP > 7.0

$review = find_review_by_id($id);
?>

<?php $page_title = 'Show Member'; ?>
<?php include(SHARED_PATH . '/header.php'); ?>

<div id="content">

  <div class="member-card">
    <h1>Review</h1>
    <p>Rating: <?php echo h($review['rating']); ?></p>
    <p>Ratee: <?php echo h($review['fname']). " " . h($review['lname']); ?></p>
    <p>Review: <?php echo h($review['rating_text']); ?></p>
    <p>Date: <?php echo h($review['rating_date']); ?></p>


  </div>
  <div class="push"></div>
</div>
<?php include(SHARED_PATH . '/footer.php'); ?>
