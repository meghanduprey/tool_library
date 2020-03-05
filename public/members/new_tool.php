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

if(is_post_request()) {
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
      if ($_FILES["tool_picture"]["size"] > 2097152) {
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
        $tool['tool_picture'] = $target_file;
        $category =[];
        $category = $_POST['category_ID'];
          
        $result = insert_tool($tool, $category);
          
          if($result) {
            redirect_to(url_for('/members/show_member_tools.php'));
//            $new_id = mysqli_insert_id($db);
            $_SESSION['message'] = "The tool was created sucessfully";

          } else {
            $errors= $result;
          }  
      }
    }
  //else {
//            echo "Sorry, there was an error uploading your file.";
//        }

    }




$tool_set = find_all_tools();
$tool_count = mysqli_num_rows($tool_set) + 1;
mysqli_free_result($tool_set);

$tool = [];
$tool["position"] = $tool_count;

?>
<?php $page_title = 'Create Tool'; ?>
<?php include(SHARED_PATH . '/header.php'); ?>

<main id="content">

    <div class="center">
      <p><a href="<?php echo url_for('/members/show_member_tools.php'); ?>">&laquo; My Tools</a></p>
      <p><a href="<?php echo url_for('/members/browse.php'); ?>">&laquo; Browse All Tools</a></p>

      <h1>Create Tool</h1>
    </div>
    <?php echo display_errors($errors); ?>

    <form action="<?php echo url_for('/members/new_tool.php'); ?>" method="post" enctype="multipart/form-data" id="newTool">

      <div class="form">

        <label for="serial_number">Serial Number: </label><br>
          <input type="text" name="serial_number" value="" id="serial_number"><br>

        <label for="tool_name">Tool Name: </label><br>
          <input type="text" name="tool_name" value="" required id="tool_name"><br>

        <label for="tool_description">Tool Description:</label><br>
          <input type="text" name="tool_description" value="" required id="tool_description"><br>
          
        Tool Category (check at least 1 option): <br>  
         <input type="checkbox" name="category_ID[]" value="1" class="required" title="Please check at least one category" id="1"><label for="1">Automotive </label> <br>
         <input type="checkbox" name="category_ID[]" value="2" id="2"><label for="2">Carpentry </label> <br>
         <input type="checkbox" name="category_ID[]" value="3" id="3"> <label for="3">Home Maintenance </label> <br>
         <input type="checkbox" name="category_ID[]" value="4" id="4"><label for="4"> Plumbing </label> <br>
         <input type="checkbox" name="category_ID[]" value="5" id="5"><label for="5">Yard and Garden </label>  <br>
         <input type="checkbox" name="category_ID[]" value="6" id="6"><label for="6">Hand Tools </label>  <br><br>
         
        <label for="tool_picture">Tool Image (must be less than 2MB): </label><br>
          <input type="file" name="tool_picture" accept="image/*" id="tool_picture"><br>

        <input type="submit" value="Add Tool">
      </div>      
    </form>

</main>
<div class="push"></div>

<?php include(SHARED_PATH . '/footer.php'); ?>
