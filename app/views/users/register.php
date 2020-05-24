<?php require APPROOT . '/views/inc/header.php'; ?>
  <div class="wrapper">
    <h2>Create an account</h2>
    <form class="registrationForm" action="<?php echo URLROOT; ?>/users/register" method="POST">
      <label for="email">Email:</label>
      <input type="email" id="email" name="email" class="<?php (!empty($data['email_error'])) ? 'invalid' : ''; ?>" value="<?php echo $data['email'] ?>" />
      <span class="input-error"><?php echo $data['email_error'] ?></span>
      <label for="password">Password:</label>
      <input type="password" id="password" name="password" class="<? echo (!empty($data['password_error'])) ? 'invalid' : ''; ?>" />
      <span class="input-error"><?php echo $data['password_error'] ?></span>
      <label for="confirm_password">Confirm Password:</label>
      <input type="password" id="confirm_password" name="confirm_password" class="<? echo (!empty($data['confirm_password_error'])) ? 'invalid' : ''; ?>" />
      <span class="input-error"><?php echo $data['confirm_password_error'] ?></span>
      <button class="button" type="submit">Register</button>
    </form>
    <div class="login">
      <h3>Already have an account?</h3>
      <a href="<?php echo URLROOT; ?>/users/login" class="button">Login</a>
    </div>
  </div>
<?php require APPROOT . '/views/inc/footer.php'; ?>