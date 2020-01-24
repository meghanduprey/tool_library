<?php require_once('../../private/initialize.php');


?>

<?php include(SHARED_PATH . '/header.php'); ?>


<form action="upload.php" method="post" enctype="multipart/form-data">
    Select image to upload:
    <input type="file" name="tool_picture" id="tool_picture">
    <input type="submit" value="Upload Image" name="submit">
</form>


<?php include(SHARED_PATH . '/footer.php'); ?>