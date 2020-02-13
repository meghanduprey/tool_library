<?php

require_once('../../private/initialize.php');
require_login(); 


if(is_post_request()) { 
  $rater_id= find_member_ID();
  $rating = [];
  $rating['rating'] = $_POST['rating'];
  $rating['review'] = $_POST['review'];
  $fname = $_POST['fname'];
  $lname = $_POST['lname'];
  
  $result = insert_rating($fname, $lname, $rating, $rater_id);
  
  if($result === true) {
      $new_id = mysqli_insert_id($db);
      $_SESSION['message'] = "The member was created sucessfully";
      redirect_to(url_for('/members/show_review.php?id=' . $new_id));
    } else {
      $errors= $result;
    }
} else {   
          
      }
    
  
    



//
//$ratings_set = find_all_ratings();
//$ratings_count = mysqli_num_rows($ratings_set) + 1;
//mysqli_free_result($ratings_set);

//$tool = [];
//$tool["position"] = $tool_count;

?>
<?php $page_title = 'Rate Member'; ?>
<?php include(SHARED_PATH . '/header.php'); ?>

<div id="content">

    <div class="center">
      <p><a href="<?php echo url_for('/members/show_member_tools.php'); ?>">&laquo; My Tools</a></p>
      <p><a href="<?php echo url_for('/members/browse.php'); ?>">&laquo; Browse All Tools</a></p>

      <h2>New Review</h2>
    </div>
    <?php echo display_errors($errors); ?>
    <form action="<?php echo url_for('/members/rating.php'); ?>" method="post">

      <fieldset class="form">
        <label for="fname">First Name: </label><br>
          <input type="text" name="fname" value=""> <br> 
        
        <label for="lname">Last Name: </label><br>
        <input type="text" name="lname" value=""> <br>  
        
        <input type="radio" name="rating" id="5"><label for="5">5</label>
        <input type="radio" name="rating" id="4"><label for="4">4</label>
        <input type="radio" name="rating" id="3"><label for="3">3</label>
        <input type="radio" name="rating" id="2"><label for="2">2</label>
        <input type="radio" name="rating" id="1"><label for="1">1</label><br>
     
<!--
      <span class="star-cb-group">
        <input type="radio" id="rating-5" name="rating" value="5"><label for="rating-5">5</label>
        <input type="radio" id="rating-4" name="rating" value="4"><label for="rating-4">4</label>
        <input type="radio" id="rating-3" name="rating" value="3"><label for="rating-3">3</label>
        <input type="radio" id="rating-2" name="rating" value="2"><label for="rating-2">2</label>
        <input type="radio" id="rating-1" name="rating" value="1"><label for="rating-1">1</label>
        <input type="radio" id="rating-0" name="rating" value="0" class="star-cb-clear"><label for="rating-0">0</label>
     </span><br>
-->
         
        <label for= "review">Review:</label><br>
        <textarea name="review"  id="review" rows="10" cols="40"> </textarea>
         
        <input type="submit" value="Leave Review">
      </fieldset>
    </form>

  <div class="push"></div>
</div>

<?php include(SHARED_PATH . '/footer.php'); ?>
