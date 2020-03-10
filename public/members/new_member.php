<?php
require_once('../../private/initialize.php');


if(is_post_request()) {
  $email = $_POST['email'];

  $sql_e = "SELECT * FROM members WHERE email='$email'";
  $res_e = mysqli_query($db, $sql_e);

  if(mysqli_num_rows($res_e) > 0){
    $email_error = "Sorry that email address is already taken"; 	
  }else{
  // Handle form values sent by new.php

  $member = [];
  $member['fname'] = $_POST['fname'] ?? '';
  $member['lname'] = $_POST['lname'] ?? '';
  $member['email'] = $_POST['email'] ?? '';
  $member['phone'] = $_POST['phone'] ?? '';
//  $member['member_level'] = $_POST['member_level'] ?? '';
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

    }
  }
  
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

<main id="content">

  <div class="subject new">
   <div class="center">
     <h1>Create Member</h1>
   </div>
    <?php echo display_errors($errors); ?>

    <form name="newMemberForm" action="<?php echo url_for('/members/new_member.php'); ?>" method="post" id="newMemberForm">

      <div class="form">
        <label for="fname" id="firstname">First Name: </label><br>
          <input type="text" name="fname" value="" id="fname" required title="Please enter a first name"> <br> 
        
        <label for="lname" id="lastname">Last Name: </label><br>
        <input type="text" name="lname" value="" id="lname" required title="Please enter a last name"> <br>  
        
        <div <?php if (isset($email_error)): ?> class="form_error" <?php endif ?> >
          <label for="email" id="Email">Email: </label><br>
            <input type="email" name="email" value="" id="email" required title="Please enter an email address"><br>
          <?php if (isset($email_error)): ?>
      	    <span><?php echo $email_error; ?></span>
          <?php endif ?>
        </div>
        <label for="phone" id="PhoneNumber">Phone Number: </label><br>
          <input type="text" name="phone" value="" id="phone" required title="Please enter a phone number"><br>

        <label for="hashed_password" id="password">Password: </label><br>
          <input type="password" name="hashed_password" value="" id="hashed_password" required title="Please enter a password"><br>
          
        <label for="confirm_password" >Confirm Password: </label><br>
          <input type="password" name="confirm_password" value="" id="confirm_password" required title="Please re-enter your password"><br>  

      <div class="g-recaptcha" data-sitekey="6Lc2_M8UAAAAAPyo-p2oapQZO-WQIEreJsbJHJYp"></div>  
        <input type="submit" value="Create Account">
      </div>
    </form>

  </div>
</main>
<div class="push"></div>
<?php include(SHARED_PATH . '/footer.php'); ?>
