<?php

  session_start();

  $user = false;
  if (isset($_SESSION['user'])) {
    $user = $_SESSION['user'];
  }

  function isLoggedIn() {
    if (isset($_SESSION['user'])) {
      return true;
    } else {
      return false;
    }
  }

  // Flash message helper

  // function flash($name = '', $message = '', $class='') {
  //   if (!empty($name)) {
  //     if (!empty($message) && empty($_SESSION[$name])) {
  //       $_SESSION[$name] = $name;
  //       $_SESSION[$name . '_class'] = $class;
  //     }
  //   }
  // }