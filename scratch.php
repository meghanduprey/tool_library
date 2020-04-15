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

//page navigation

<?php 
  $showRecordPerPage = 10;
  if(isset($_GET['page']) && !empty($_GET['page'])){
  $currentPage = $_GET['page'];
  }else{
  $currentPage = 1;
  }
  $startFrom = ($currentPage * $showRecordPerPage) - $showRecordPerPage;
  
  $sql = "SELECT * FROM tools ";
  $sql .="ORDER BY tools.tool_ID ASC LIMIT $startFrom, $showRecordPerPage";
  $result= mysqli_query($db, $sql);
  $sql2 = "SELECT * FROM tools";
  $result2= mysqli_query($db, $sql2);
  $totalTools = mysqli_num_rows($result2);
  $lastPage = ceil($totalTools/$showRecordPerPage);
  $firstPage = 1;
  $nextPage = $currentPage + 1;
  $previousPage = $currentPage -1;
  $tool_set = $result;
?>
<nav aria-label="Page navigation">
          <ul class="pagination">
            <?php if($currentPage != $firstPage) { ?>
            <li class="page-item">
              <a class="page-link" href="?page=<?php echo $firstPage ?>" tabindex="-1" aria-label="Previous">
              <span aria-hidden="true">First Page</span>
              </a>
            </li>
            <?php } ?>
            <?php if($currentPage >= 2) { ?>
            <li class="page-item">
              <a class="page-link" href="?page=<?php echo $previousPage ?>"><?php echo $previousPage ?></a>
            </li>
            <?php } ?>
            <li class="page-item active">
              <a class="page-link" href="?page=<?php echo $currentPage ?>"><?php echo $currentPage ?></a>
            </li>
            <?php if($currentPage != $lastPage) { ?>
            <li class="page-item">
              <a class="page-link" href="?page=<?php echo $nextPage ?>"><?php echo $nextPage ?></a>
            </li>
            <li class="page-item">
              <a class="page-link" href="?page=<?php echo $lastPage ?>" aria-label="Next">
              <span aria-hidden="true">Last Page</span>
              </a>
            </li>
            <?php } ?>
          </ul>
        </nav>


