<?php require_once('../../private/initialize.php'); ?>

<?php
// $id = isset($_GET['id']) ? $_GET['id'] : '1';
$id = $_GET['id'] ?? '1'; // PHP > 7.0

$member = find_member_by_id($id);
?>

<?php $page_title = 'Show Member'; ?>
<?php include(SHARED_PATH . '/header.php'); ?>

<div id="content">
<div class="center"><a class="back-link" href="<?php echo url_for('/members/admin.php'); ?>">&laquo; Back to List</a></div>
  <div class="member-card">
    <h1>Member: <?php echo h($member['member_ID']); ?></h1>
    <p>First Name: <?php echo h($member['fname']); ?></p>
    <p>Last Name: <?php echo h($member['lname']); ?></p>
    <p>Email: <?php echo h($member['email']); ?></p>
    <p>Phone: <?php echo h($member['phone']); ?></p>
    <p>Member Level: <?php echo h($member['member_level']); ?></p>
    <div class="center" >
      <a href="<?php echo url_for('/login.php'); ?>">Login</a>
    </div>
  </div>
  <div class="push"></div>
</div>
<?php include(SHARED_PATH . '/footer.php'); ?>
