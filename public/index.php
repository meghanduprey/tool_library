<?php require_once('../private/initialize.php'); ?>

<?php $page_title = 'Main Menu'; ?>
<?php include(SHARED_PATH . '/header.php'); ?>

<div id="content">
<!--
  <div id="main-menu">
    <h2>Main Menu</h2>
    <ul>
      <li><a href="<?php echo url_for('/members/index.php'); ?>">View Members</a></li>
      <li><a href="<?php echo url_for('/login.php');?>">Login</a></li>
    </ul>
  </div>
-->
  <div class="center">
    <h2>Featured Tools</h2>
    <div class="responsive">
      <div class="gallery">
        <a target="_blank" href="../assets/disk_sander.png">
          <img src="../assets/disk_sander.png" alt="Disk Sander">
        </a>
        <div class="desc">Disk Sander</div>
      </div>
    </div>

    <div class="responsive">
      <div class="gallery">
        <a target="_blank" href="../assets/hose.png">
          <img src="../assets/hose.png" alt="air hose">
        </a>
        <div class="desc">Air Hose</div>
      </div>
    </div>

    <div class="responsive">
      <div class="gallery">
        <a target="_blank" href="../assets/ladder.png">
          <img src="../assets/ladder.png" alt="ladder">
        </a>
        <div class="desc">12ft Ladder</div>
      </div>
    </div>
  </div>

  
  <div class="clearfix"></div>

  <div class="center">
    <h2>What is the Tool Library</h2>
    <p>The Jackson Park Neighborhood Tool Library is an online space for neighbors to share what tools they have available with their neighbors. You can sign up and borrow and share tools with your neighbor!</p>
  </div>

</div>

<?php include(SHARED_PATH . '/footer.php'); ?>
