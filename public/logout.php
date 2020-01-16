<?php
require_once('../private/initialize.php');

unset($_SESSION['email']);
// or you could use
// $_SESSION['username'] = NULL;

redirect_to(url_for('/login.php'));

?>
