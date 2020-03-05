<?php

require_once('../../private/initialize.php');
require_login(); 
if(!isset($_GET['id'])) {
  redirect_to(url_for('/members/show_member_tools.php'));
}
$id = $_GET['id'];
$memberID1 = find_member_ID_by_tool_ID($id);
$memberID2 = find_member_ID_by_session_email();

if ($memberID1 == $memberID2) {
  

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
   $result = update_tool($tool, $category, $id);
      if($result === true) {
      $_SESSION['message'] = "The tool has been updated sucessfully";
      redirect_to(url_for('/members/show_tool.php?id=' . $id));
    } else {
    }
      //get info for checkboxes
      global $db;
      $tool["categories"] = [];
      $sql = "SELECT category.category_name, category.category_ID, tool_category.tool_id
      FROM category 
      LEFT JOIN tool_category tool_category ON category.category_ID = tool_category.category_id
      AND tool_category.tool_id = $id ";
      $result = mysqli_query($db, $sql);

    while($row = $result->fetch_assoc()) {
      $tool_id = $row["category_ID"];
      $name = $row["category_name"];
      $checked = $row["tool_id"] ? "checked" : "";
      $tool["categories"][$tool_id] = ["name" => $name, "checked" => $checked];
  }




  } else {

    $tool = find_tool_by_id($id);
    $tool["categories"] = [];
    $sql = "SELECT category.category_name, category.category_ID, tool_category.tool_id
    FROM category 
    LEFT JOIN tool_category tool_category ON category.category_ID = tool_category.category_id
      AND tool_category.tool_id = $id ";
    $result = mysqli_query($db, $sql);

  while($row = $result->fetch_assoc()) {
      $tool_id = $row["category_ID"];
      $name = $row["category_name"];
      $checked = $row["tool_id"] ? "checked" : "";
      $tool["categories"][$tool_id] = ["name" => $name, "checked" => $checked];
  }

  } //end else
    $tool_set = find_all_tools();
    $tool_count = mysqli_num_rows($tool_set);
    mysqli_free_result($tool_set);
  ?>

  <?php $page_title = 'Edit Tool'; ?>
  <?php include(SHARED_PATH . '/header.php'); ?>

  <main id="content">

    <div class="center">
      <a href="<?php echo url_for('/members/show_member_tools.php'); ?>">&laquo; Back to My Tools</a>


      <h1>Edit Tool</h1>
    </div>
      <?php echo display_errors($errors); ?>
      <form action="<?php echo url_for('/members/edit_tool.php?id=' . h(u($id))); ?>" method="post" id="editTool">

        <div class="form">
           <img src ="<?php echo h($tool['tool_picture']); ?>"  alt="<?php echo h($tool['tool_picture']); ?>"width="150"><br>
          <label for="serial_number">Serial Number</label><br>
            <input type="text" name="serial_number"  id="serial_number" value="<?php echo h($tool['serial_number']); ?>" ><br>

          <label for="tool_name">Tool Name</label><br>
            <input type="text" name="tool_name" id="tool_name" value="<?php echo h($tool['tool_name']); ?>" required><br>

          <label for="tool_description">Tool Description</label><br>
            <input type="text" name="tool_description" id="tool_description" value="<?php echo h($tool['tool_description']); ?>" required><br>
          Tool Category: <br>  
          <?php foreach ($tool["categories"] as $tool_id=>$category): ?>
              <input type="checkbox" name="category_ID[]" id="category_<?=$tool_id?>" value="<?=$tool_id?>" <?=$category["checked"]?>>
              <label for="category_<?=$tool_id?>">
                  <?=htmlspecialchars($category["name"])?>
              </label><br/>
          <?php endforeach ?>

          <input type="submit" value="Edit Tool" >

            <a class="block delete-button" href="<?php echo url_for('/members/delete_tool.php?id=' . $id); ?>">Delete Tool</a>

        </div>

      </form>
      <div class="push"></div>
    </main>
<?php } else { 
 redirect_to(url_for('/members/not_authorized.php'));
 } ?>
<?php include(SHARED_PATH . '/footer.php'); ?>
