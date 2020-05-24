<?php 
  require_once "config/config.php";

  // Autoload Core Libraries
  spl_autoload_register(function ($className) {
    require_once 'libraries/' . $className . '.php';
  });

  // Load helpers
  require_once 'helpers/url_helper.php';
  require_once 'helpers/session_helper.php';