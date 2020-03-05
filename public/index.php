<?php require_once('../private/initialize.php'); ?>

<?php $page_title = 'Main Menu'; ?>
<?php include(SHARED_PATH . '/header.php'); ?>

<img src="<?php echo url_for('assets/tools_header_img.jpg'); ?>" alt="misc tools" width="1600" class="responsive-img">
<div id="content">

  <div class="center">
    <h2>What is the Tool Library</h2>
  </div>  
  <p>The Jackson Park Neighborhood Tool Library is an online space for neighbors to share what tools they have available with their neighbors. You can sign up and borrow and share tools with your neighbor!</p>
  <div class="center">  
    <h2>Mission and Vision</h2>
  </div>  
    <p>The Tool Library's mission is to empower homeowners and renters to do home improvement projects and foster a sense of community in the neighborhood.</p>
  <div class="center">  
    <img src="<?php echo url_for('/assets/friends.jpeg')?>" alt="group of friends standing together" width="780" class="responsive-img"> 
    <h2>History</h2>
  </div>  
    <p>The Jackson Park Neighborhood Tool Library was started by Meghan Duprey in the spring of 2020. She dreampt of a place where neighbors could share and borrow tools from each other to get projects done around the house and so neighbors could get to know one another.</p>
  <div class="center">  
    <h2>Membership</h2>
  </div>  
    <p>If you are a member of the Tool Library you can add and delete your tools, request tools from other members, rate other members, and view your ratings. Please <a href="<?php echo url_for('/login.php'); ?>">Login</a> to access these member areas.</p>
  </div>
  <div class="push"></div>

<?php include(SHARED_PATH . '/footer.php'); ?>
