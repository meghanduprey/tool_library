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
    $sql .= "'" . db_escape($db, $member['member_level']) . "',";
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
    $sql .= "first_name='" . db_escape($db, $member['first_name']) . "', ";
    $sql .= "last_name='" . db_escape($db, $member['last_name']) . "', ";
    $sql .= "email='" . db_escape($db, $member['email']) . "', ";
    $sql .= "phone='" .db_escape($db,  $member['phone']) . "', ";
    $sql .= "member_level='" . db_escape($db, $member['member_level']) . "', ";
    $sql .= "pass_hash='" . db_escape($db, $hashed_password) . "' ";
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
  $sql = "SELECT * FROM tools ";
  $sql .="ORDER BY tool_ID ASC";
  $result= mysqli_query($db, $sql);
  confirm_result_set($result);
  return $result;
}

function find_tool_by_id($id) {
    global $db;

    $sql = "SELECT * FROM tools ";
    $sql .= "WHERE tool_ID='" . db_escape($db, $id) . "'";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    $tool = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    return $tool; // returns an assoc. array
  }


function find_member_ID () {
  global $db;
//  $email = "meghan.duprey@gmail.com";
  $email = $_SESSION['email'];
  $sql = "SELECT member_ID FROM members ";
  $sql .= "WHERE email = '$email'";
//  echo $sql;
  $result= mysqli_query($db, $sql);
  confirm_result_set($result);
//  return $result;
  $member = mysqli_fetch_assoc($result);
  mysqli_free_result($result);
  return $member['member_ID'];
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
//    $sql .= "'" . db_escape($db, $tool['tool_picture']) . "',";
    $sql .= "'test', ";
    $sql .= "$member_by_ID";
    $sql .= ")";
  echo $sql;
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

function find_tool_by_member_id($id) {
    global $db;

    $sql = "SELECT * FROM tools ";
    $sql .= "WHERE member_ID='" . db_escape($db, $id) . "'";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    $tool = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    return $tool; // returns an assoc. array
  }
?>
