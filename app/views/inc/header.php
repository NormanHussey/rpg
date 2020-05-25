<?php 
  if (isset($_SESSION['user'])) {
    $user = $_SESSION['user'];
    $player = $_SESSION['player'];
  }

  if (isset($_SESSION['enemy'])) {
    $enemy = $_SESSION['enemy'];
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/style.css">
  <title><?php echo SITENAME; ?></title>
</head>
<body>
  <header>
    <nav>
      <ul>
        <li>
          <a class="link" href="<?php echo URLROOT; ?>/" >RPG</a>
        </li>
        <?php if (isLoggedIn()) : ?>
        <li>
          <p>Day: 1, Time: 00:00</p>
        </li>
        <?php endif; ?>
        <li>
          <?php if (isLoggedIn()) : ?>
            <a href="<?php echo URLROOT; ?>/users/logout" class="button">Logout</a>
          <?php else : ?>
            <a href="<?php echo URLROOT; ?>/users/register" class="button">Register</a>
            <a href="<?php echo URLROOT; ?>/users/login" class="button">Login</a>
          <?php endif; ?>
        </li>
    </nav>
  </header>
  <main>
    <div class="wrapper">
