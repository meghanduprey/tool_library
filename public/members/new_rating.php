<?php

require_once('../../private/initialize.php');
require_login(); 
$sql = "SELECT member_ID, fname, lname FROM members ORDER BY lname, fname ASC";
$query = mysqli_query($db, $sql);
while ( $array[] = $query->fetch_object() );
array_pop ( $array );

if(is_post_request()) { 
  global $db;
  $rating = [];
  $rating['member_ID'] = $_POST['name'];
  $rating['rating'] = $_POST['rating'];
  $rating['review'] = $_POST['review'];
  $rater_ID = $_SESSION['email'];
  
//  echo $rating['member_ID'] ;
//  echo $rating['rating'];
//  echo $rating['review'];
  $result = insert_rating($rating); 

  
  if($result === true) {
      $new_id = mysqli_insert_id($db);
      $_SESSION['message'] = "The review was created sucessfully";
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
      <h2>Leave a Review</h2>
    </div>
    
    <?php echo display_errors($errors); ?>
    <form action="<?php echo url_for('/members/new_rating.php'); ?>" method="post" id="newRating">

      <fieldset class="form">
       
        <label for="name">Leave a review for:</label> 
        <select name="name" class="select">
        <option value="">--Please select a neighbor--</option>
         <?php foreach ( $array as $option ) : ?>
          <option value="<?php echo $option->member_ID; ?>"><?php echo $option->fname . " " . $option->lname; ?></option>
         <?php endforeach; ?>
        </select><br>
        
        <label for="rating">Rating:</label><br>
        <span class="star-cb-group">
          <input type="radio" id="rating-5" name="rating" value="5" class="required" title="Please rate the member"><label for="rating-5">5</label>
          <input type="radio" id="rating-4" name="rating" value="4"><label for="rating-4">4</label>
          <input type="radio" id="rating-3" name="rating" value="3"><label for="rating-3">3</label>
          <input type="radio" id="rating-2" name="rating" value="2"><label for="rating-2">2</label>
          <input type="radio" id="rating-1" name="rating" value="1"><label for="rating-1">1</label>
          <input type="radio" id="rating-0" name="rating" value="0" class="star-cb-clear"><label for="rating-0">0</label>
       </span><br>
         
        <label for= "review">Review:</label><br>
        <textarea name="review"  id="review" rows="10" cols="40"> </textarea>
         
        <input type="submit" value="Leave Review">
      </fieldset>
    </form>

  <div class="push"></div>
</div>

<?php include(SHARED_PATH . '/footer.php'); ?>
