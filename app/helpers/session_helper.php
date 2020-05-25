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

  function randomFloat($min, $max) {
      return $min + abs($max - $min) * mt_rand(0, mt_getrandmax())/mt_getrandmax();
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