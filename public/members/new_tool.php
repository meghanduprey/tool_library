<?php

require_once('../../private/initialize.php');

//file upload code here
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["tool_picture"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

if(is_post_request()) {
  //upload file code starts here
  $check = getimagesize($_FILES["tool_picture"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }

// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["tool_picture"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["tool_picture"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["tool_picture"]["name"]). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
  
  //upload file code stops here

  // Handle form values sent by new.php

  $tool = [];
  $tool['serial_number'] = $_POST['serial_number'] ?? '';
  $tool['tool_name'] = $_POST['tool_name'] ?? '';
  $tool['tool_description'] = $_POST['tool_description'] ?? '';
  $tool['tool_picture'] = $target_file ?? '';


    $result = insert_tool($tool);
    if($result === true) {
      $new_id = mysqli_insert_id($db);
      $_SESSION['message'] = "The tool was created sucessfully";
      redirect_to(url_for('/members/show_tool.php?id=' . $new_id));
    } else {
      $errors= $result;
    }
  }
  else {
    //display the form
  }




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

  <a class="back-link" href="<?php echo url_for('/members/show_member_tools.php'); ?>">&laquo; My Tools</a>

    <div class="center">
      <h2>Create Tool</h2>
    </div>
    <?php echo display_errors($errors); ?>

    <form action="<?php echo url_for('/members/new_tool.php'); ?>" method="post" enctype="multipart/form-data">

      <fieldset class="new_tool">

        <label for="serial_number">Serial Number: </label><br>
          <input type="text" name="serial_number" value="" ><br>

        <label for="tool_name">Tool Name: </label><br>
          <input type="text" name="tool_name" value="" ><br>

        <label for="tool_description">Tool Description:</label><br>
          <input type="text" name="tool_description" value="" ><br>

        <label for="tool_picture">Tool Image: </label><br>
          <input type="file" name="tool_picture" accept="image/*" ><br>

        <input type="submit" value="Add Tool">
      </fieldset>      
    </form>


</div>

<?php include(SHARED_PATH . '/footer.php'); ?>
