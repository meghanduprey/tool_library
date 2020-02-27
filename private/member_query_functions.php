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

    // first name
    if(is_blank($member['fname'])) {
      $errors[] = "First Name cannot be blank.";
    } 
    
    // last name
    if(is_blank($member['lname'])) {
      $errors[] = "Last Name cannot be blank.";
    } 
    
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
    $sql .= "(fname, lname, email, phone, member_level, hashed_password) ";
    $sql .= "VALUES (";
    $sql .= "'" . db_escape($db, $member['fname']) . "',";
    $sql .= "'" . db_escape($db, $member['lname']) . "',";
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
    $sql = "UPDATE members SET ";
    $sql .= "fname='". db_escape($db, $member['fname']) . "', ";
    $sql .= "lname='". db_escape($db, $member['lname']) . "', ";
    $sql .= "email='" . db_escape($db, $member['email']) . "', ";
    $sql .= "phone='" .db_escape($db,  $member['phone']) . "', ";
    $sql .= "member_level='" . db_escape($db, $member['member_level']) . "' ";
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

function find_member_ID_by_session_email () {
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

function find_all_ratings() {
    global $db;

    $sql = "SELECT * FROM ratings ";
    //echo $sql;
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
  }

function insert_rating($rating) {
  global $db;
  $rater = find_member_ID_by_session_email ();
  $sql = "INSERT INTO ratings (rating, rater_member_ID, ratee_member_ID, rating_text, rating_date) ";
  $sql .= "VALUES (";
  $sql .= "'" . db_escape($db, $rating['rating']) . "',";
  $sql .= "'" . db_escape($db, $rater ). "',";
  $sql .= "'" . db_escape($db, $rating['member_ID'] ). "',";
  $sql .= "'" . db_escape($db, $rating['review']) . "',";
  $sql .= "now()";
  $sql .= ")";
//  echo $sql;
  $result = mysqli_query($db, $sql);
  // For INSERT statements, $result is true/false
  confirm_result_set($result);
  return $result;
}

function find_review_by_id($id) {
  global $db;

  $sql = "SELECT * FROM ratings INNER JOIN members on members.member_ID=ratings.ratee_member_ID ";
  $sql .= "WHERE rating_ID='" . db_escape($db, $id) . "'";
  
//  echo $sql;
  $result = mysqli_query($db, $sql);
//  confirm_result_set($result);
  $review = mysqli_fetch_assoc($result);
  mysqli_free_result($result);
  return $review; // returns an assoc. array
  
}

function find_rating_by_member_id() {
    global $db;
    
    $member_by_ID = find_member_ID_by_session_email();

    $sql = "SELECT * FROM ratings INNER JOIN members on members.member_ID=ratings.rater_member_ID ";
    $sql .= "WHERE ratee_member_ID= $member_by_ID";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
  }

function find_member_ID_by_tool_ID($id) {
  global $db;
  $sql = "select members.member_ID FROM members INNER JOIN tools ON members.member_ID = tools.member_ID ";
  $sql .= "WHERE tool_ID='" . db_escape($db, $id) . "'";
  $result = mysqli_query($db, $sql);
  confirm_result_set($result);
  $member = mysqli_fetch_assoc($result);
  mysqli_free_result($result);
  return $member['member_ID']; // returns an assoc. array
}

function find_rating_by_tool_id($id) {
  global $db;
  $member_id= find_member_ID_by_tool_ID($id);

  $sql = "SELECT rating_ID, members.fname as ratee_fname, members.lname as ratee_lname, rating, rating_text,     rating_date, members2.fname as rater_fname, members2.lname as rater_lname from members join ratings on members.member_ID=ratings.ratee_member_ID join members members2 on members2.member_ID = ratings.rater_member_ID ";
    $sql .= "WHERE ratee_member_ID= $member_id";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
}

?>
