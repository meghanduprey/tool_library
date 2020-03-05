<?php require_once('../../private/initialize.php'); ?>
<?php require_login(); ?>

<?php $rating_set = find_rating_by_member_id(); ?>

<?php $page_title = 'My Ratings'; ?>
<?php include(SHARED_PATH . '/header.php'); ?>
<main id="content">
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
        
        <div class="center">
          <p><?php echo $stars; ?></p>
        </div>
        <p>Rater: <?php echo h($rating['rater_fname']). " ". h($rating['rater_lname']); ?></p>
        <p>Ratee: <?php echo h($rating['ratee_fname']). " ". h($rating['ratee_lname']); ?></p>
        <p>Review: <?php echo h($rating['rating_text']); ?></p>
      </div>
    <?php } //end while ?>
  </div>
  <div class="push"></div>
</main>






<?php include(SHARED_PATH . '/footer.php'); ?>
