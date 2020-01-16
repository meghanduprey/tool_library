<!doctype html>

<html lang="en">
  <head>
    <title>Tool Library - <?php echo h($page_title); ?></title>
    <meta charset="utf-8">
    <link rel="stylesheet" media="all" href="<?php echo url_for('public/stylesheets/styles.css'); ?>" >
<!--    <script src='https://www.google.com/recaptcha/api.js' async defer></script>-->
  </head>

  <body>
  <div id="wrapper">
    <nav class="header">
     <a href="../../index.php" class="logo">Jackson Park Tool Library</a>
      <div class="header-right">
        <a href="<?php echo url_for('/about.php'); ?>">About</a>
        Browse
        <a href="<?php echo url_for('/public/login.php'); ?>">Login</a>
      </div>
    </nav>
    <div>
      <ul>
        <li>User: <?php echo $_SESSION['email'] ?? '';   ?></li>
        <li><a href="<?php echo url_for('/index.php'); ?>">Menu</a></li>
        <li><a href="<?php echo url_for('/logout.php'); ?>">Logout</a></li>
      </ul>
    </div>
    <?php echo display_session_message(); ?>