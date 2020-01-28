<?php require_once('../private/initialize.php'); ?>

<?php $page_title = 'Main Menu'; ?>
<?php include(SHARED_PATH . '/header.php'); ?>

<div id="content">
<!--
  <div id="main-menu">
    <h2>Main Menu</h2>
    <ul>
      <li><a href="<?php echo url_for('/members/admin.php'); ?>">View Members</a></li>
      <li><a href="<?php echo url_for('/login.php');?>">Login</a></li>
    </ul>
  </div>
-->
  <div class="center">
    <h2>Featured Tools</h2>
    <div class="responsive">
      <div class="gallery">
          <img src="<?php echo url_for('/assets/disk_sander.png') ?>" alt="Disk Sander">
        <div class="desc">Disk Sander</div>
      </div>
    </div>

    <div class="responsive">
      <div class="gallery">
          <img src="<?php echo url_for('/assets/hose.png') ?>" alt="air hose">
        <div class="desc">Air Hose</div>
      </div>
    </div>

    <div class="responsive">
      <div class="gallery">
          <img src="<?php echo url_for('/assets/ladder.png') ?>" alt="ladder">
        <div class="desc">12ft Ladder</div>
      </div>
    </div>
  </div>

  
  <div class="clearfix"></div>

  <div class="center">
    <h2>What is the Tool Library</h2>
    <p>The Jackson Park Neighborhood Tool Library is an online space for neighbors to share what tools they have available with their neighbors. You can sign up and borrow and share tools with your neighbor!</p>
    <h2>Mission and Vision</h2>
    <p>The Tool Library's mission is to empower homeowners and renters to do home improvement projects and foster a sense of community in the neighborhood.</p>
    <img src="<?php echo url_for('/assets/friends.jpeg')?>" alt="group of friends standing together"> 
    <h2>History</h2>
    <p>The Jackson Park Neighborhood Tool Library was started by Meghan Duprey in the spring of 2020. She dreampt of a place where neighbors could share and borrow tools from each other to get projects done around the house and so neighbors could get to know one another.</p>
  </div>

</div>

<?php include(SHARED_PATH . '/footer.php'); ?>
