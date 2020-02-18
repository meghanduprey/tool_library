<!doctype html>

<html lang="en">
  <head>
    <title>Tool Library - <?php echo h($page_title); ?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" media="all" href="<?php echo url_for('/stylesheets/styles.css'); ?>" >
<!--    <script src='https://www.google.com/recaptcha/api.js' async defer></script>-->
 <script>
  var logID = 'log',
  log = $('<div id="'+logID+'"></div>');
$('body').append(log);
  $('[type*="radio"]').change(function () {
    var me = $(this);
    log.html(me.attr('value'));
  });   
 </script>
  </head>

  <body>
  <div id="wrapper">
    <nav class="header">
      <a href="<?php echo url_for('/index.php'); ?>"><img class="logo-img" src="<?php echo url_for('assets/wrench.png'); ?>" width="50" alt="wrench drawing"></a>
     <a href="<?php echo url_for('/index.php'); ?>" class="logo"><h1>Jackson Park Tool Library</h1></a>
      <div class="header-right">
        <a href="<?php echo url_for('/members/browse.php'); ?>">Browse</a>
<!--
        <a href="<?php echo url_for('/members/show_member_tools.php'); ?>">My Tools</a>
        <a href="<?php echo url_for('members/show_member_ratings.php'); ?>">My Reviews</a>
        <a href="<?php echo url_for('members/new_rating.php'); ?>">Leave Review</a>
-->
        
        
        <?php $role = find_member_level();
          if($role == 'a') { ?>
            <a href="<?php echo url_for('members/admin.php'); ?>">Admins</a>
        <?php }?>
        <?php if(!is_logged_in()){ ?>
          <a href="<?php echo url_for('/members/member_area.php'); ?>">Member Area</a>
          <a href="<?php echo url_for('/login.php'); ?>">Login</a>
        <?php }?>
         <?php if(is_logged_in()){ ?>
          <a href="<?php echo url_for('/members/show_member_tools.php'); ?>">My Tools</a>
          <a href="<?php echo url_for('/members/show_member_ratings.php'); ?>">My Reviews</a>
          <a href="<?php echo url_for('/members/new_rating.php'); ?>">Leave a Review</a>
          <a href="<?php echo url_for('/logout.php'); ?>">Logout <?php echo $_SESSION['email']; ?></a>
        <?php }?> 
      </div>
    </nav>

    <?php echo display_session_message(); ?>