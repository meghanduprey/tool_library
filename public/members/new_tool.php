<?php

require_once('../../private/initialize.php');

if(is_post_request()) {

  // Handle form values sent by new.php

  $tool = [];
  $tool['serial_number'] = $_POST['serial_number'] ?? '';
  $tool['tool_name'] = $_POST['tool_name'] ?? '';
  $tool['tool_desc'] = $_POST['tool_desc'] ?? '';
  $tool['tool_pic'] = $_POST['tool_pic'] ?? '';

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
    $result = insert_tool($tool);
    if($result === true) {
      $new_id = mysqli_insert_id($db);
      $_SESSION['message'] = "The tool was created sucessfully";
      redirect_to(url_for('/members/show_tool.php?id=' . $new_id));
    } else {
      $errors= $result;
    }
//
  }
  else {
    //display the form
  }




$tool_set = find_all_tools();
$tool_count = mysqli_num_rows($tool_set) + 1;
mysqli_free_result($tool_set);

$tool = [];
$tool["position"] = $tool_count;

?>
<!--<script src="https://www.google.com/recaptcha/api.js" async defer></script>-->
<?php $page_title = 'Create Tool'; ?>
<?php include(SHARED_PATH . '/header.php'); ?>

<div id="content">

  <a class="back-link" href="<?php echo url_for('/members/index.php'); ?>">&laquo; Back to List</a>

  <div class="subject new">
    <h1>Create Tool</h1>
    <?php echo display_errors($errors); ?>

    <form action="<?php echo url_for('/members/new_tool.php'); ?>" method="post" enctype="multipart/form-data">

      <fieldset>
      <legend>New Tool</legend>

        <label for="serial_number">Serial Number: </label>
          <input type="text" name="serial_number" value="" ><br>

        <label for="tool_name">Tool Name: </label>
          <input type="text" name="tool_name" value="" ><br>

        <label for="tool_desc">Tool Description:</label>
          <input type="text" name="tool_desc" value="" ><br>

        <label for="tool_pic">Tool Image: </label>
          <input type="file" name="tool_pic" accept="image/*" ><br>

        <input type="submit" value="Add Tool">
      </fieldset>
<!--      <div class="g-recaptcha" data-sitekey="6Lc2wcIUAAAAAJVJzEiv05V8ON4rMV615IwVEPn1"></div>-->
    
      
    </form>

  </div>

</div>

<?php include(SHARED_PATH . '/footer.php'); ?>
