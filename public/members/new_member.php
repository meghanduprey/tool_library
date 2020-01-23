<?php
error_reporting(E_ALL);

require_once('../../private/initialize.php');

if(is_post_request()) {

  // Handle form values sent by new.php

  $member = [];
  $member['email'] = $_POST['email'] ?? '';
  $member['phone'] = $_POST['phone'] ?? '';
  $member['member_level'] = $_POST['member_level'] ?? '';
  $member['hashed_password'] = $_POST['hashed_password'] ?? '';

  $response = $_POST["g-recaptcha-response"];
	$url = 'https://www.google.com/recaptcha/api/siteverify';
	$data = array(
		'secret' => '6Lc2_M8UAAAAAAoCy2He1OidBCkxX44UcWbLskyk
    ',
		'response' => $_POST["g-recaptcha-response"]
	);
	$options = array(
		'http' => array (
			'method' => 'POST',
			'content' => http_build_query($data),
            'header' => 'Content-Type: application/x-www-form-urlencoded'
		)
	);
	$context  = stream_context_create($options);
	$verify = file_get_contents($url, false, $context);
	$captcha_success=json_decode($verify);
	if ($captcha_success->success==false) {
		$errors[] =  "Please click the I am not a robot checkbox";
	} else {
    $result = insert_member($member);
    if($result === true) {
      $new_id = mysqli_insert_id($db);
      $_SESSION['message'] = "The member was created sucessfully";
      redirect_to(url_for('/members/show_member.php?id=' . $new_id));
    } else {
      $errors= $result;
    }
//
    }
  }
  else {
    //display the form
  }




$member_set = find_all_members();
$member_count = mysqli_num_rows($member_set) + 1;
mysqli_free_result($member_set);

$members = [];
$members["position"] = $member_count;

?>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<?php $page_title = 'Create Member'; ?>
<?php include(SHARED_PATH . '/header.php'); ?>

<div id="content">

  <a class="back-link" href="<?php echo url_for('/members/index.php'); ?>">&laquo; Back to List</a>

  <div class="subject new">
   <div class="center">
     <h2>Create Member</h2>
   </div>
    <?php echo display_errors($errors); ?>

    <form action="<?php echo url_for('/members/new_member.php'); ?>" method="post">

      <fieldset class="new_member">
     
        <label for="email">Email: </label><br>
          <input type="text" name="email" value="" ><br>

        <label for="phone">Phone Number: </label><br>
          <input type="text" name="phone" value="" ><br>

        <select name="member_level" class="member_level">
          <option value="a">Administrator</option>
          <option value="m">Member</option>
        </select><br>

        <label for="hashed_password">Password: </label><br>
          <input type="password" name="hashed_password" value="" ><br>

      <div class="g-recaptcha" data-sitekey="6Lc2_M8UAAAAAPyo-p2oapQZO-WQIEreJsbJHJYp
"></div>  
        <input type="submit" value="Create Subject">
      </fieldset>
    </form>

  </div>

</div>

