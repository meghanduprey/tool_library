<?php require_once('../../private/initialize.php'); ?>
<?php require_login(); ?>

<?php $rating_set = find_rating_by_member_id(); ?>

<?php $page_title = 'My Ratings'; ?>
<?php include(SHARED_PATH . '/header.php'); ?>
<div id="content">
  <div class="center">
    <h2>My Reviews</h2>
  </div>
  <div class="flex">
   
    <?php while ($rating = mysqli_fetch_assoc($rating_set)) { ?>
      <div class="member-card">
       <?php 
          $stars = "";
          for($i=0;$i<$rating["rating"];$i++){
          $stars .= '<i class="fa fa-star star"></i>';
          } ?>  
        
        <p><?php echo $stars; ?></p>
        <p>Rater: <?php echo h($rating['fname']). " ". h($rating['lname']); ?></p>
        <p>Review: <?php echo h($rating['rating_text']); ?></p>
      </div>
    <?php } //end while ?>
  </div>
  <div class="push"></div>
</div>






<?php include(SHARED_PATH . '/footer.php'); ?>
