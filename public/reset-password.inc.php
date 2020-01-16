<?php
error_reporting(E_ALL);
  if(isset($_POST['reset-password-submit'])) {
    $selector = $_POST['selector'];
    $validator = $_POST['validator'];
    $pwd = $_POST['pwd'];
    $passwordRepeat = $_POST['pwd-repeat'];

    if (empty($pwd) || empty($passwordRepeat)) {
      header("Location: create-new-password.php?newpwd=empty");
      exit();
    } else if($pwd != $passwordRepeat ) {
      header("Location: create-new-password.php?newpwd=pwdnotsame");
    }

    $currentDate = date("U");

    require '../private/database.php';
    $connection = db_connect();

    $sql = "SELECT * FROM pwdReset WHERE pwdResetSelector=?";
    $stmt = mysqli_stmt_init($connection);
    if(!mysqli_stmt_prepare($stmt, $sql)){
      echo "There was an error at line 22";
      exit();
    } else {
      mysqli_stmt_bind_param($stmt, 's', $selector);
      mysqli_stmt_execute($stmt);

      $result = mysqli_stmt_get_result($stmt);
      if(!$row = mysqli_fetch_assoc($result)) {
        echo "You need to resubmit your reset request";
        exit();
    } else {
      $tokenBin = hex2bin($validator);
      $tokenCheck = password_verify($tokenBin, $row["pwdResetToken"]);

      if($tokenCheck === false) {
        echo "You need to resubmit your reset request";
        exit();
      } elseif($tokenCheck === true) {
        $tokenEmail = $row['pwdResetEmail'];

        $sql = "SELECT * FROM members WHERE email=?;";
        $stmt = mysqli_stmt_init($connection);
        if(!mysqli_stmt_prepare($stmt, $sql)){
          echo "There was an error at line 45";
          exit();
        } else {
          mysqli_stmt_bind_param($stmt, "s", $tokenEmail);
          mysqli_stmt_execute($stmt);
          $result = mysqli_stmt_get_result($stmt);
      if(!$row = mysqli_fetch_assoc($result)) {
        echo "There was an error at line 52!";
        exit();
    } else {
      $sql = "UPDATE members SET pass_hash=? WHERE email=?";
      $stmt = mysqli_stmt_init($connection);
      if(!mysqli_stmt_prepare($stmt, $sql)){
        echo "There was an error at line 58";
        exit();
      } else {
        $newPwdHash = password_hash($pwd, PASSWORD_DEFAULT);
        mysqli_stmt_bind_param($stmt, "ss", $newPwdHash, $tokenEmail);
        mysqli_stmt_execute($stmt);

        $sql= "DELETE FROM pwdReset WHERE pwdResetEmail=?";
        $stmt = mysqli_stmt_init($connection);
        if(!mysqli_stmt_prepare($stmt, $sql)) {
          echo "There was an error at line 68!";
          exit();
        } else {
          mysqli_stmt_bind_param($stmt, "s", $tokenEmail);
          mysqli_stmt_execute($stmt);
          header("Location: login.php?newpwd=passwordupdated");
        }
      }

    }

        }
      }
    }
  }

  } else {
    header ("Location: login.php");
  }



?>
