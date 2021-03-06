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

    if($member) {
      if(password_verify($password, $member['hashed_password'])) {
        //password matches
        log_in_member($member);
        $role = find_member_level();
        if ($role == 'm') {
        $redirect = '../public/members/show_member_tools.php';
        } else if ($role == 'a') {
        $redirect = '../public/members/admin.php';
        } 
        header('Location: ' . $redirect);
//        redirect_to(url_for('/members/show_member_tools.php'));
      } else {
        //username found but password does not match
        $errors[] = "Incorrect password";
      }
  } else {
    //username not found
    $errors[] = "Username does not exist";
  }
}
}


?>

<?php $page_title = 'Log in'; ?>
<?php include(SHARED_PATH . '/header.php'); ?>

<main id="content">
 <div class="center">
   <h1>Log in</h1>
 </div>
  

  <?php echo display_errors($errors); ?>

  <form action="login.php" method="post">
   <div class="form">
    <label for="email">Email:</label><br>
    <input type="text" name="email" value="" id="email" required><br>
    <label for="password">Password:</label><br>
    <input type="password" name="password" value="" id="password" required><br>
    <input type="submit" name="submit" value="Login">
    <a href="members/new_member.php" class="create_member">Create Account</a>
    </div>
  </form>

  <?php
  if(isset($_GET["newpwd"])){
    if($_GET["newpwd"] == "passwordupdated") {
      echo '<p class="signupsucess">Your password has been reset!</p>';
    }
  }
?>
   <div class="center">
    <a href="reset-password.php">Forgot your password?</a>
   </div>
</main>

<?php include(SHARED_PATH . '/footer.php'); ?>
