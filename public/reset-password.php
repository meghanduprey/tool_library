<?php
require_once('../private/initialize.php'); ?>


<?php $page_title = 'Reset Password'; ?>
<?php include(SHARED_PATH . '/header.php'); ?>

<main id="content">
  <h1>Reset Password</h1>
  <p>An email will be sent to you with instructions on how to reset your password.</p>
  <form action="reset-request.php" method="post">
    <input type="text" name="email" placeholder="Enter your email address...">
    <button type="submit" name="reset-request-submit">Receive new password by email</button>
  </form>
<?php

  if(isset($_GET['reset'])) {
    if($_GET['reset'] == "sucess") {
      echo '<p class="signupsucess">Check your email!</p>';
    }
  }

?>

</main>

<?php include(SHARED_PATH . '/footer.php'); ?>
