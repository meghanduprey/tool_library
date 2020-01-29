<?php require_once('../../private/initialize.php'); 

if(is_post_request()) {
  $searchterm = $_POST['searchterm'];
  $tool = search_form($searchterm);
  echo $tool['tool_name'];
  echo $tool['tool_description'];
}