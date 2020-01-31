<?php

  // Performs all actions necessary to log in an admin
  function log_in_member($member) {
  // Renerating the ID protects the admin from session fixation.
    session_regenerate_id();
    // $_SESSION['member_id'] = $member['id'];
    $_SESSION['last_login'] = time();
    $_SESSION['email'] = $member['email'];
    return true;
  }

 function redirect_by_member_level() {
   if(!is_logged_in()) {
    redirect_to(url_for('/login.php'));
  } else {
    $role = find_member_level();
    $redirect = "";
    if ($role == 'm') {
        $redirect = url_for('../public/members/not_an_admin.php'); 
      } 
        header('Location: ' . $redirect);
   }
} 

// is_logged_in() contains all the logic for determining if a
// request should be considered a "logged in" request or not.
// It is the core of require_login() but it can also be called
// on its own in other contexts (e.g. display one link if an admin
// is logged in and display another link if they are not)
function is_logged_in() {
  // Having a admin_id in the session serves a dual-purpose:
  // - Its presence indicates the admin is logged in.
  // - Its value tells which admin for looking up their record.
  return isset($_SESSION['email']);
}

// Call require_login() at the top of any page which needs to
// require a valid login before granting acccess to the page.
function require_login() {
  if(!is_logged_in()) {
    redirect_to(url_for('/login.php'));
  } else {
    // Do nothing, let the rest of the page proceed
  }
}
?>
