<!doctype html>

<html lang="en">
  <head>
    <title>Tool Library - <?php echo h($page_title); ?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel='stylesheet' href='http://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css'>
    <link rel="stylesheet" href="<?php echo url_for('stylesheets/simplePagination.css'); ?> " media="all">
    <link rel="stylesheet" media="all" href="<?php echo url_for('/stylesheets/styles.css'); ?>" >
    <script src="<?php echo url_for('/js/jquery-3.4.1.min.js'); ?>" ></script>
    <script src="<?php echo url_for('/js/jquery.validate.min.js'); ?>" ></script>
    <script src="<?php echo url_for('js/simplePagination.js'); ?>" ></script>
    <script src="<?php echo url_for('/js/script.js'); ?>" ></script>
    
<!--
    <script>
      var logID = 'log';
      log = $('<div id="'+logID+'"></div>');
      $('body').append(log);
      $('[type*="radio"]').change(function () {
        var me = $(this);
        log.html(me.attr('value'));
      });   
    </script>
-->
  </head>

  <body>
  
  <div id="wrapper">
    <nav class="header">
      <a href="<?php echo url_for('/index.php'); ?>"><img class="logo-img" src="<?php echo url_for('assets/toollibrary.png'); ?>" alt="Tool Library Home Wrench" width="408"></a>
      <a href="<?php echo url_for('/index.php'); ?>"><img class="small-logo-img" src="<?php echo url_for('assets/wrench.png'); ?>" alt="Tool Library Home Wrench" width="50"></a>
      <div class="header-right">
        <a href="<?php echo url_for('/members/browse.php'); ?>">Browse</a>
        
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