<?php

require_once('../../private/initialize.php');

if(!isset($_GET['id'])) {
  redirect_to(url_for('/members/admin.php'));
}
$id = $_GET['id'];

if(is_post_request()) {

  // Handle form values sent by new.php

  $member = [];
  $member['member_ID'] = $id;
  $member['fname'] = $_POST['fname'] ?? '' ;
  $member['lname'] = $_POST['lname'] ?? '' ;
  $member['email'] = $_POST['email'] ?? '';
  $member['phone'] = $_POST['phone'] ?? '';
  $member['member_level'] = $_POST['member_level'] ?? '';

  $result = update_member($member);

  if($result === true) {
    $_SESSION['message'] = "The member has been updated sucessfully";
    redirect_to(url_for('/members/show_member.php?id=' . $id));
  } else {
    $errors = $result;
  }


} else {

  $member = find_member_by_id($id);
}
  $member_set = find_all_members();
  $member_count = mysqli_num_rows($member_set);
  mysqli_free_result($member_set);



?>

<?php $page_title = 'Edit Member'; ?>
<?php include(SHARED_PATH . '/header.php'); ?>

<main id="content">

  <a class="back-link" href="<?php echo url_for('/members/admin.php'); ?>">&laquo; Back to List</a>


    <div class="center">
      <h1>Edit Member</h1>
    </div>
    <?php echo display_errors($errors); ?>
    <form action="<?php echo url_for('/members/edit_member.php?id=' . h(u($id))); ?>" method="post" id="editMemberForm">

      <div class="form">
        <label for="fname">First Name: </label><br>
          <input type="text" name="fname" value="<?php echo h($member['fname']); ?>" id="fname" required> <br> 
        
        <label for="lname">Last Name: </label><br>
        <input type="text" name="lname" value="<?php echo h($member['lname']); ?>"  id="lname" required> <br> 
       
        <label for="email">Email</label><br>
          <input type="text" name="email" value="<?php echo h($member['email']); ?>"  id="email" required><br>

        <label for="phone">Phone</label><br>
          <input type="text" name="phone" value="<?php echo h($member['phone']); ?>"  id="phone" required><br>
        
        <p>Member Level</p>
          <input type="radio" name="member_level" value="a"  id="a" required title="Please select a member level">
          <label for="a">Administrator</label>
          <br>
          <input type="radio" name="member_level" value="m"  id="m" required>
          <label for="m">Member</label>
          <br>

        <input type="submit" value="Edit Subject" >
      </div>

    </form>
    <div class="push"></div>
  </main>

<?php include(SHARED_PATH . '/footer.php'); ?>
