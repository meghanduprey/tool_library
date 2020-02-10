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
  $member['fname'] = $_POST['fname'] ;
  $member['lname'] = $_POST['lname'] ;
  $member['email'] = $_POST['email'] ?? '';
  $member['phone'] = $_POST['phone'] ?? '';
  $member['member_level'] = $_POST['member_level'] ?? '';
  $member['pass_hash'] = $_POST['pass_hash'] ?? '';

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

<div id="content">

  <a class="back-link" href="<?php echo url_for('/members/admin.php'); ?>">&laquo; Back to List</a>


    <div class="center">
      <h2>Edit Member</h2>
    </div>
    <?php echo display_errors($errors); ?>
    <form action="<?php echo url_for('/members/edit_member.php?id=' . h(u($id))); ?>" method="post">

      <fieldset class="form">
        <label for="fname">First Name: </label><br>
          <input type="text" name="fname" value=""> <br> 
        
        <label for="lname">Last Name: </label><br>
        <input type="text" name="lname" value=""> <br> 
       
        <label for="email">Email</label><br>
          <input type="text" name="email" value="<?php echo h($member['email']); ?>" ><br>

        <label for="phone">Phone</label><br>
          <input type="text" name="phone" value="<?php echo h($member['phone']); ?>" ><br>
        
        <label for="member_level">Member Level (a or m)</label><br>
          <input type="text" name="member_level" value="<?php echo h($member['member_level']); ?>" ><br>

        <label for="password">Password </label><br>
          <input type="password" name="password" value="<?php echo h($member['password']); ?>"><br>
        <input type="submit" value="Edit Subject" >
      </fieldset>

    </form>
    <div class="push"></div>
  </div>

<?php include(SHARED_PATH . '/footer.php'); ?>
