<!doctype html>

<html lang="en">
  <head>
    <title>Tool Library - <?php echo h($page_title); ?></title>
    <meta charset="utf-8">
    <link rel="stylesheet" media="all" href="<?php echo url_for('/stylesheets/styles.css'); ?>" >
<!--    <script src='https://www.google.com/recaptcha/api.js' async defer></script>-->
  </head>

  <body>
  <div id="wrapper">
    <nav class="header">
      <a href="<?php echo url_for('/index.php'); ?>" class="logo"><img src="<?php echo url_for('assets/wrench.png'); ?>" width="150" height="119" style="float: left;"></a>
     <a href="<?php echo url_for('/index.php'); ?>" class="logo"><h1>Jackson Park Tool Library</h1></a>
      <div class="header-right">
        <a href="<?php echo url_for('/members/browse.php'); ?>">Browse</a>
        <a href="<?php echo url_for('/members/show_member_tools.php'); ?>">My Tools</a>
        <a href="<?php echo url_for('members/admin.php'); ?>">Admins</a>
        <a href="<?php echo url_for('/login.php'); ?>">Login</a>
      </div>
    </nav>
    <div>
      <ul>
        <li>User: <?php echo $_SESSION['email'] ?? '';   ?></li>
        <li><a href="<?php echo url_for('/members/admin.php'); ?>">User List</a></li>
        <li><a href="<?php echo url_for('/logout.php'); ?>">Logout</a></li>
      </ul>
    </div>
    <?php echo display_session_message(); ?>