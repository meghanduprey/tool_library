<?php
require_once('../private/initialize.php');

$errors = [];
$email = '';
$password = '';

if(is_post_request()) {

  $email = $_POST['email'] ?? '';
  $password = $_POST['password'] ?? '';

  //validations
  if(is_blank($email)) {
    $errors[]= "Email cannot be blank.";
  }
  if(is_blank($password)) {
    $errors[]= "Password cannot be blank.";
  }
  //if there were no errors try to login
  if(empty($errors)) {

    $member = find_member_by_email($email);
    $login_failure_message = "Login failed";
    // print_r($member);
    // die();

      // echo($member['pass_hash']);

    if($member) {
      if(password_verify($password, $member['pass_hash'])) {
        //password matches
        log_in_member($member);
        redirect_to(url_for('/members/index.php'));
      } else {
        //username found but password does not match
        $errors[] = $login_failure_message;
      }
  } else {
    //username not found
    $errors[] = $login_failure_message;
  }
}
}


?>

<?php $page_title = 'Log in'; ?>
<?php include(SHARED_PATH . '/header.php'); ?>

<div id="content">
  <h1>Log in</h1>

  <?php echo display_errors($errors); ?>

  <form action="login.php" method="post">
    Username:<br />
    <input type="text" name="email" value="<?php echo h($email); ?>" /><br />
    Password:<br />
    <input type="password" name="password" value="" /><br />
    <input type="submit" name="submit" value="Submit"  />
  </form>

  <?php
  if(isset($_GET["newpwd"])){
    if($_GET["newpwd"] == "passwordupdated") {
      echo '<p class="signupsucess">Your password has been reset!</p>';
    }
  }


?>
  <a href="reset-password.php">Forgot your password?</a>

</div>

<?php include(SHARED_PATH . '/footer.php'); ?>
