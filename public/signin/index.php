<?php 
include_once('../../private/initialize.php');

$errors = [];
$username = '';
$password = '';

if(is_post_request()) {

  $username = $_POST['username'] ?? '';
  $password = $_POST['password'] ?? '';

  // Validations
  if(is_blank($username)) {
    $errors[] = "Username cannot be blank.";
  }
  if(is_blank($password)) {
    $errors[] = "Password cannot be blank."; 
  }

  // if there were no errors, try to login
  if(empty($errors)) {
    // Using one variable ensures that msg is the same
    $login_failure_msg = "Log in was unsuccessful.";

    $admin = find_admin_by_username($username);
    if($admin) {
      // try to login
      if(password_verify($password, $admin['hashed_password'])) {
        // password matches
        log_in_admin($admin);
        redirect_to(url_for('index.php'));
      } else {
        // username found, but password does not match
        $errors[] = $login_failure_msg;
      }

    } else {
      // no username found
      $errors[] = $login_failure_msg;
    }
  }

}
?>

<?php $page_title = 'Log in'; ?>

<?php include_once(PRIVATE_PATH .'/header.php')?>


<div class="contents">
  <h1>Log in</h1>

  <?php echo display_errors($errors); ?>

  <form action="index.php" method="post">
    <dl>
      <dt>Username:</dt>
        <dd><input type="text" name="username" value="<?php echo h($username); ?>" /></dd>
    </dl>
    <dl>
      <dt>Password:</dt>
        <dd><input type="password" name="password" value="" /></dd>
    </dl>
    <input type="submit" name="submit" value="Submit"  />
  </form>

</div>

<?php include_once(PRIVATE_PATH .'/footer.php')?>
