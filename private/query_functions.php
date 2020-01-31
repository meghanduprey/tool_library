<?php

  // Members

  function find_all_members() {
    global $db;

    $sql = "SELECT * FROM members ";
    $sql .= "ORDER BY member_ID ASC";
    //echo $sql;
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
  }


  function find_member_by_id($id) {
    global $db;

    $sql = "SELECT * FROM members ";
    $sql .= "WHERE member_ID='" . db_escape($db, $id) . "'";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    $member = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    return $member; // returns an assoc. array
  }

  function find_member_by_email($email) {
    global $db;

    $sql = "SELECT * FROM members ";
    $sql .= "WHERE email='" . db_escape($db, $email) . "'";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    $member = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    return $member; // returns an assoc. array
  }


  function validate_member($member) {
    $errors = [];

    // email address
    if(is_blank($member['email'])) {
      $errors[] = "Email cannot be blank.";
    } elseif(!has_valid_email_format($member['email'])) {
      $errors[] = "Please enter a valid email address.";
    }

    // phone
    if(is_blank($member['phone'])) {
      $errors[] = "Phone number cannot be blank.";
    } elseif(!has_length_exactly($member['phone'], 10)) {
      $errors[] = "Please enter 10 digit phone number without dashes.";
    }

    return $errors;
  }

  function insert_member($member) {
    global $db;

    $errors = validate_member($member);
    if(!empty($errors)) {
      return $errors;
    }

    $hashed_password = password_hash($member['hashed_password'], PASSWORD_DEFAULT);
    $sql = "INSERT INTO members ";
    $sql .= "(email, phone, member_level, hashed_password) ";
    $sql .= "VALUES (";
    $sql .= "'" . db_escape($db, $member['email']) . "',";
    $sql .= "'" . db_escape($db, $member['phone']) . "',";
    $sql .= "'m',";
    $sql .= "'" .  db_escape($db, $hashed_password) . "'";
    $sql .= ")";
    $result = mysqli_query($db, $sql);
    // For INSERT statements, $result is true/false
    if($result) {
      return true;
    } else {
      // INSERT failed
      echo mysqli_error($db);
      db_disconnect($db);
      exit;
    }
  }

  function update_member($member) {
    global $db;

    $errors = validate_member($member);
    if(!empty($errors)) {
      return $errors;
    }
    $hashed_password = password_hash($member['pass_hash'], PASSWORD_BCRYPT);
    $sql = "UPDATE members SET ";
    $sql .= "email='" . db_escape($db, $member['email']) . "', ";
    $sql .= "phone='" .db_escape($db,  $member['phone']) . "', ";
    $sql .= "member_level='" . db_escape($db, $member['member_level']) . "', ";
    $sql .= "hashed_password='" . db_escape($db, $hashed_password) . "' ";
    $sql .= "WHERE member_ID='" . db_escape($db, $member['member_ID']) . "' ";
    $sql .= "LIMIT 1";

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

  function delete_member($id) {
    global $db;

    $sql = "DELETE FROM members ";
    $sql .= "WHERE member_ID='" . db_escape($db, $id) . "' ";
    $sql .= "LIMIT 1";
    $result = mysqli_query($db, $sql);

    // For DELETE statements, $result is true/false
    if($result) {
      return true;
    } else {
      // DELETE failed
      echo mysqli_error($db);
      db_disconnect($db);
      exit;
    }
  }


function find_all_tools() {
  global $db;
  $sql = "SELECT * FROM tools INNER JOIN category ON tools.category_ID = category.category_ID ";
  $sql .="ORDER BY tool_ID ASC";
  $result= mysqli_query($db, $sql);
  confirm_result_set($result);
  return $result;
}

function find_tool_by_id($id) {
    global $db;

    $sql = "SELECT * FROM tools INNER JOIN category ON tools.category_ID = category.category_ID ";
    $sql .= "WHERE tool_ID='" . db_escape($db, $id) . "'";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    $tool = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    return $tool; // returns an assoc. array
  }


function find_member_ID () {
  global $db;
  $email = $_SESSION['email'];
  $sql = "SELECT member_ID FROM members ";
  $sql .= "WHERE email = '$email'";
//  echo $sql;
  $result= mysqli_query($db, $sql);
  confirm_result_set($result);
  $member = mysqli_fetch_assoc($result);
  mysqli_free_result($result);
  return $member['member_ID'];
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

function find_member_level () {
  global $db;
  if(isset($_SESSION['email'])) {
    $email = $_SESSION['email'];
  } else {
    $email = "";
  
  }
  $sql = "SELECT member_level from members ";
  $sql .= "WHERE email = '$email'";
  $result= mysqli_query($db, $sql);
  confirm_result_set($result);
  $member = mysqli_fetch_assoc($result);
  mysqli_free_result($result);
  return $member['member_level'];
}

function insert_tool($tool) {
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
//    $sql .= "'test', ";
    $sql .= "$member_by_ID";
    $sql .= ")";
    $result = mysqli_query($db, $sql);
    // For INSERT statements, $result is true/false
    if($result) {
      return true;
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
    $sql .= "category_ID = '" . db_escape($db, $tool['category_ID']) . "' ";
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

//function find_category_by_id() {
//  global $db;
//  $sql = "SELECT category_name FROM category ";
//  $sql .= "WHERE category_ID = '$tool['category_ID']'";
//  
//}

function find_tool_by_member_id() {
    global $db;
    
    $member_by_ID = find_member_ID();

    $sql = "SELECT * FROM tools INNER JOIN category ON tools.category_ID = category.category_ID ";
    $sql .= "WHERE member_ID= $member_by_ID";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
  }

function search_form($searchterm) {
  global $db;
  $sql = "SELECT * FROM tools INNER JOIN category ON tools.category_ID = category.category_ID WHERE tool_name LIKE '%$searchterm%' OR tool_description LIKE '%$searchterm%' OR category_name LIKE '%$searchterm%'";
  $result= mysqli_query($db, $sql);
  confirm_result_set($result);
  return $result;
}
?>