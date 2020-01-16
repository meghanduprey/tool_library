<?php

require_once('../../private/initialize.php');

if(is_post_request()) {

  // Handle form values sent by new.php

  $member = [];
  $member['first_name'] = $_POST['first_name'] ?? '';
  $member['last_name'] = $_POST['last_name'] ?? '';
  $member['email'] = $_POST['email'] ?? '';
  $member['phone'] = $_POST['phone'] ?? '';
  $member['member_level'] = $_POST['member_level'] ?? '';
  $member['pass_hash'] = $_POST['pass_hash'] ?? '';

//  $response = $_POST["g-recaptcha-response"];
//	$url = 'https://www.google.com/recaptcha/api/siteverify';
//	$data = array(
//		'secret' => '6Lc2_M8UAAAAAAoCy2He1OidBCkxX44UcWbLskyk
//    ',
//		'response' => $_POST["g-recaptcha-response"]
//	);
//	$options = array(
//		'http' => array (
//			'method' => 'POST',
//			'content' => http_build_query($data)
//		)
//	);
//	$context  = stream_context_create($options);
//	$verify = file_get_contents($url, false, $context);
//	$captcha_success=json_decode($verify);
//	if ($captcha_success->success==false) {
//		$errors[] =  "Please click the I am not a robot checkbox";
//	} else {
//    $result = insert_member($member);
//    if($result === true) {
//      $new_id = mysqli_insert_id($db);
//      $_SESSION['message'] = "The member was created sucessfully";
//      redirect_to(url_for('/members/show.php?id=' . $new_id));
//    } else {
//      $errors= $result;
//    }
//
//  }
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
<!--<script src="https://www.google.com/recaptcha/api.js" async defer></script>-->
<?php $page_title = 'Create Member'; ?>
<?php include(SHARED_PATH . '/header.php'); ?>

<div id="content">

  <a class="back-link" href="<?php echo url_for('/members/index.php'); ?>">&laquo; Back to List</a>

  <div class="subject new">
    <h1>Create Member</h1>
    <?php echo display_errors($errors); ?>

    <form action="<?php echo url_for('/members/new.php'); ?>" method="post">


      <fieldset>
      <legend>New Member</legend>
        <label for="first_name">First Name: </label>
          <input type="text" name="first_name" value=""><br>

        <label for="last_name">Last Name: </label>
          <input type="text" name="last_name" value="" ><br>

        <label for="email">Email: </label>
          <input type="text" name="email" value="" ><br>

        <label for="phone">Phone Number: </label>
          <input type="text" name="phone" value="" ><br>

        <label for="member_level">Member Level: (a or m)</label>
          <input type="text" name="member_level" value="" ><br>

        <label for="password">Password: </label>
          <input type="password" name="pass_hash" value="" ><br>

      </fieldset>
<!--      <div class="g-recaptcha" data-sitekey="6Lc2wcIUAAAAAJVJzEiv05V8ON4rMV615IwVEPn1"></div>-->
      <div id="operations">
        <input type="submit" value="Create Subject">
      </div>
    </form>

  </div>

</div>

<?php include(SHARED_PATH . '/footer.php'); ?>
