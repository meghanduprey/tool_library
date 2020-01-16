<!doctype html>

<html lang="en">
  <head>
    <title>Tool Library - <?php echo h($page_title); ?></title>
    <meta charset="utf-8">
    <link rel="stylesheet" media="all" href="<?php echo url_for('/stylesheets/styles.css'); ?>" />
<!--    <script src='https://www.google.com/recaptcha/api.js' async defer></script>-->
  </head>

  <body>
  <div id="wrapper">

    <nav>
      <ul>
        <li>User: <?php echo $_SESSION['email'] ?? '';   ?></li>
        <li><a href="<?php echo url_for('/index.php'); ?>">Menu</a></li>
        <li><a href="<?php echo url_for('/logout.php'); ?>">Logout</a></li>
      </ul>
    </nav>
    <?php echo display_session_message(); ?>