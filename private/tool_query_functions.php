<?php
 

 function find_all_tools() {
  global $db;
  $sql = "SELECT * FROM tools ";
  $sql .="ORDER BY tools.tool_ID ASC";
  $result= mysqli_query($db, $sql);
  confirm_result_set($result);
  return $result;
}

function find_tool_categories($id) {
  global $db;
   //find all categories for a given tool based on the id
  $sql = "SELECT category_name from category INNER JOIN tool_category ON tool_category.category_ID = category.category_ID INNER JOIN tools on tools.tool_ID = tool_category.tool_ID ";
  $sql .= "WHERE tools.tool_ID='" . db_escape($db, $id) . "'";
  $result= mysqli_query($db, $sql);
  confirm_result_set($result);
  return $result;
}

function find_tool_by_id($id) {
    global $db;

    $sql = "SELECT * FROM tools INNER JOIN tool_category ON tools.tool_ID = tool_category.tool_ID INNER JOIN category ON tool_category.category_ID = category.category_ID ";
    $sql .= "WHERE tools.tool_ID='" . db_escape($db, $id) . "'";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    $tool = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    return $tool; // returns an assoc. array
  }

function find_email_by_tool_ID($id) {
  global $db;
  $sql = "select email FROM members INNER JOIN tools ON members.member_ID = tools.member_ID ";
  $sql .= "WHERE tool_ID='" . db_escape($db, $id) . "'";
  $result = mysqli_query($db, $sql);
  confirm_result_set($result);
  $member = mysqli_fetch_assoc($result);
  mysqli_free_result($result);
  return $member['email']; // returns an assoc. array
}

function insert_tool($tool, $category) {
    global $db;

    $errors = validate_tool($tool);
    if(!empty($errors)) {
     return $errors;
    }
    
    $member_by_ID = find_member_ID();

    $sql = "INSERT INTO tools ";
    $sql .= "(serial_number, tool_name, tool_description, tool_picture, member_ID) ";
    $sql .= "VALUES (";
    $sql .= "'" . db_escape($db, $tool['serial_number']) . "',";
    $sql .= "'" . db_escape($db, $tool['tool_name']) . "',";
    $sql .= "'" . db_escape($db, $tool['tool_description']) . "',";
    $sql .= "'" . db_escape($db, $tool['tool_picture']) . "',";
    $sql .= "$member_by_ID";
    $sql .= ")";
    $result = mysqli_query($db, $sql);
    // For INSERT statements, $result is true/false
    if($result) {
      $sql2 = "SELECT LAST_INSERT_ID()";
      $last_insert_ID = mysqli_query($db, $sql2);
      $tool_ID = mysqli_fetch_assoc($last_insert_ID);
      foreach($tool_ID as $last_tool_ID) {
        $last_tool_ID;
      }
      foreach($category as $category_ID) {
      $sql3= "INSERT INTO tool_category (tool_ID, category_ID) VALUES ('".$last_tool_ID."','". $category_ID."'); ";
     $result2= mysqli_query($db, $sql3);
    }
    } else {
      // INSERT failed
      echo mysqli_error($db);
      db_disconnect($db);
      exit;
    }
  }

function update_tool($tool) {
    global $db;

    $errors = validate_tool($tool);
    if(!empty($errors)) {
      return $errors;
    }

    $sql = "UPDATE tools SET ";
    $sql .= "serial_number='" . db_escape($db, $tool['serial_number']) . "', ";
    $sql .= "tool_name='" . db_escape($db, $tool['tool_name']) . "', ";
    $sql .= "tool_description='" . db_escape($db, $tool['tool_description']) . "', ";
    $sql .= "WHERE tool_ID=" . db_escape($db, $tool['tool_ID']) . " ";
  echo $sql;
//    $sql .= "LIMIT 1";

    $result = mysqli_query($db, $sql);
    // For UPDATE statements, $result is true/false
    if($result) {
      return true;
    } else {
      // UPDATE failed
      echo mysqli_error($db);
      db_disconnect($db);
      exit;
    }

  }

function validate_tool($tool) {
    $errors = [];

    // email address
    if(is_blank($tool['tool_name'])) {
      $errors[] = "Tool name cannot be blank.";
    } 

    // phone
    if(is_blank($tool['tool_description'])) {
      $errors[] = "Tool description cannot be blank.";
    } 

    return $errors;
  }

function find_tool_by_member_id() {
    global $db;
    
    $member_by_ID = find_member_ID();

    $sql = "SELECT * FROM tools ";
    $sql .= "WHERE member_ID= $member_by_ID";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
  }

function search_form($searchterm) {
  global $db;
  $sql = "SELECT * FROM tools WHERE tool_name LIKE '%$searchterm%' OR tool_description LIKE '%$searchterm%'";
  $result= mysqli_query($db, $sql);
  confirm_result_set($result);
  return $result;
}

function search_form_category($searchterm) {
  global $db;
  $sql = "SELECT * FROM category WHERE category_name LIKE '%$searchterm%'";
  $result= mysqli_query($db, $sql);
  confirm_result_set($result);
  return $result;
}
?>
