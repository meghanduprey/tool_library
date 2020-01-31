<?php

require_once('../../private/initialize.php');
require_login(); 
//file upload code here
// random 4 digit to add to our file name
// some people use date and time in stead of random digit
$random_digit=rand(0000,9999);
$target_dir = "uploads/";
if(isset($_FILES['tool_picture'])){
$target_file = $target_dir . $random_digit .basename($_FILES["tool_picture"]["name"]);
} else {
  $target_file = "";
}
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

if(isset($_POST['submit'])) {
  //upload file code starts here
  $check = getimagesize($_FILES["tool_picture"]["tmp_name"]);
    if($check !== false) {
//        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        $errors[] = "File is not an image.";
        $uploadOk = 0;
    }
  
    // Check if file already exists
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }
    // Check file size
  if(isset($_FILES['tool_picture'])){
    if ($_FILES["tool_picture"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }
  }
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["tool_picture"]["tmp_name"], $target_file)) {
            echo "The file ". basename( $_FILES["tool_picture"]["name"]). " has been uploaded.";
        // Handle form values sent by new.php

        $tool = [];
        $tool['serial_number'] = $_POST['serial_number'] ?? '';
        $tool['tool_name'] = $_POST['tool_name'] ?? '';
        $tool['tool_description'] = $_POST['tool_description'] ?? '';
        $tool['category_ID'] = $_POST['category_ID'] ?? '';
        $tool['tool_picture'] = $target_file;


          $result = insert_tool($tool);
          if($result === true) {
            $new_id = mysqli_insert_id($db);
            $_SESSION['message'] = "The tool was created sucessfully";
            redirect_to(url_for('/members/show_tool.php?id=' . $new_id));
          } else {
            $errors= $result;
          }  
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
} //end if POST['submit']





$tool_set = find_all_tools();
$tool_count = mysqli_num_rows($tool_set) + 1;
mysqli_free_result($tool_set);

$tool = [];
$tool["position"] = $tool_count;

?>
<!--<script src="https://www.google.com/recaptcha/api.js" async defer></script>-->
<?php $page_title = 'Create Tool'; ?>
<?php include(SHARED_PATH . '/header.php'); ?>

<div id="content">

    <div class="center">
      <p><a href="<?php echo url_for('/members/show_member_tools.php'); ?>">&laquo; My Tools</a></p>
      <p><a href="<?php echo url_for('/members/browse.php'); ?>">&laquo; Browse All Tools</a></p>

      <h2>Create Tool</h2>
    </div>
    <?php echo display_errors($errors); ?>

    <form action="<?php echo url_for('/members/new_tool.php'); ?>" method="post" enctype="multipart/form-data">

      <fieldset class="form">

        <label for="serial_number">Serial Number: </label><br>
          <input type="text" name="serial_number" value="" ><br>

        <label for="tool_name">Tool Name: </label><br>
          <input type="text" name="tool_name" value="" ><br>

        <label for="tool_description">Tool Description:</label><br>
          <input type="text" name="tool_description" value="" ><br>
          
        <label for="category_ID">Tool Category: </label><br>  
         <input type="checkbox" name="category_ID" value="1"> Automotive <br>
         <input type="checkbox" name="category_ID" value="2"> Carpentry <br>
         <input type="checkbox" name="category_ID" value="3"> Home Maintenance <br>
         <input type="checkbox" name="category_ID" value="4"> Plumbing <br>
         <input type="checkbox" name="category_ID" value="5"> Yard and Garden <br>
         <input type="checkbox" name="category_ID" value="6"> Hand Tools <br>
         
<!--
          <option value="1">Automotive</option>
          <option value="2">Carpentry</option>
          <option value="3">Home Maintenance</option>
          <option value="4">Plumbing</option>
          <option value="5">Yard and Garden</option>
          <option value="6">Hand Tools</option>
-->
          
        </select><br>

        <label for="tool_picture">Tool Image: </label><br>
          <input type="file" name="tool_picture" accept="image/*" ><br>

        <input type="submit" value="Add Tool">
      </fieldset>      
    </form>

  <div class="push"></div>
</div>

<?php include(SHARED_PATH . '/footer.php'); ?>
