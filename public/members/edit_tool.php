<?php

require_once('../../private/initialize.php');
require_login(); 
if(!isset($_GET['id'])) {
  redirect_to(url_for('/members/show_member_tools.php'));
}
$id = $_GET['id'];

if(is_post_request()) {

  // Handle form values sent by new.php

  $tool = [];
  $tool['tool_ID'] = $id;
  $tool['serial_number'] = $_POST['serial_number'] ?? '';
  $tool['tool_name'] = $_POST['tool_name'] ?? '';
  $tool['tool_description'] = $_POST['tool_description'] ?? '';
  $tool['tool_picture'] = $_POST['tool_picture'] ?? '';
  $category =[];
  $category = $_POST['category_ID'];
  $result = update_tool($tool, $category);

  if($result === true) {
    $_SESSION['message'] = "The tool has been updated sucessfully";
    redirect_to(url_for('/members/show_tool.php?id=' . $id));
  } else {
    $errors = $result;
  }


} else {

  $tool = find_tool_by_id($id);
}
  $tool_set = find_all_tools();
  $tool_count = mysqli_num_rows($tool_set);
  mysqli_free_result($tool_set);



?>

<?php $page_title = 'Edit Tool'; ?>
<?php include(SHARED_PATH . '/header.php'); ?>

<div id="content">

  <div class="center">
    <a href="<?php echo url_for('/members/show_member_tools.php'); ?>">&laquo; Back to My Tools</a>


    <h2>Edit Tool</h2>
  </div>
    <?php echo display_errors($errors); ?>
    <form action="<?php echo url_for('/members/edit_tool.php?id=' . h(u($id))); ?>" method="post">

      <fieldset class="form">
         <img src ="<?php echo h($tool['tool_picture']); ?>"  alt="<?php echo h($tool['tool_picture']); ?>"width="150"><br>
        <label for="serial_number">Serial Number</label><br>
          <input type="text" name="serial_number" value="<?php echo h($tool['serial_number']); ?>" ><br>

        <label for="tool_name">Tool Name</label><br>
          <input type="text" name="tool_name" value="<?php echo h($tool['tool_name']); ?>" ><br>
        
        <label for="tool_description">Tool Description</label><br>
          <input type="text" name="tool_description" value="<?php echo h($tool['tool_description']); ?>" ><br>
          
        <label for="category_ID">Tool Category: </label><br>  
         <input type="checkbox" name="category_ID[]" value="1"> Automotive <br>
         <input type="checkbox" name="category_ID[]" value="2"> Carpentry <br>
         <input type="checkbox" name="category_ID[]" value="3"> Home Maintenance <br>
         <input type="checkbox" name="category_ID[]" value="4"> Plumbing <br>
         <input type="checkbox" name="category_ID[]" value="5"> Yard and Garden <br>
         <input type="checkbox" name="category_ID[]" value="6"> Hand Tools <br>
        
        <input type="submit" value="Edit Tool" >
      </fieldset>

    </form>
    <div class="push"></div>
  </div>

<?php include(SHARED_PATH . '/footer.php'); ?>
