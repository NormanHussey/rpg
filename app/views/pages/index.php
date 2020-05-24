<?php require APPROOT . '/views/inc/header.php'; ?>
  <h1>RPG</h1>
  <?php if (isset($user)) : ?>
    <a href="<?php echo URLROOT; ?>/battles/" class="button">Battle</a>
  <?php else: ?>
    <h2>Please <a href="users/login">login</a> to play</h2>
  <?php endif; ?>
<?php require APPROOT . '/views/inc/footer.php'; ?>