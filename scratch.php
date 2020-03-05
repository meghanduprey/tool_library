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
//
    }
  }
  else {
    //display the form
  }
