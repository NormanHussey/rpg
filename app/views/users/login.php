<?php require APPROOT . '/views/inc/header.php'; ?>
  <h2>Login</h2>
  <form class="registrationForm" action="<?php echo URLROOT; ?>/users/login" method="POST">
    <label for="email">Email:</label>
    <input type="email" id="email" name="email" class="<?php (!empty($data['email_error'])) ? 'invalid' : ''; ?>" value="<?php echo $data['email'] ?>" />
    <span class="input-error"><?php echo $data['email_error'] ?></span>
    <label for="password">Password:</label>
    <input type="password" id="password" name="password" class="<? echo (!empty($data['password_error'])) ? 'invalid' : ''; ?>" />
    <span class="input-error"><?php echo $data['password_error'] ?></span>
    <button class="button" type="submit">Login</button>
  </form>
  <div class="login">
    <h3>Don't have an account yet?</h3>
    <a href="<?php echo URLROOT; ?>/users/register" class="button">Register</a>
  </div>
<?php require APPROOT . '/views/inc/footer.php'; ?>