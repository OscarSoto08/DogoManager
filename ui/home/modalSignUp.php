<?php
$user = null;

if($_SERVER["REQUEST_METHOD"] == "POST"){
  $name = $_POST['name'] ?? '';
  $lastName = $_POST['lastName'] ?? '';
  $email = $_POST['email'] ?? '';
  $password = md5($_POST['password']) ?? '';

  if(empty($name) || empty($lastName) || empty($email) || empty($password)) {
    $_SESSION['toast'] = [
        'type' => 'danger',
        'message' => 'Please fill in all fields.'
    ];
    header("Location: ./");
    exit();
  } else {
    $user = new Owner(name: $name, lastName: $lastName, email: $email, password: $password, created_at: date("Y-m-d H:i:s"));
    if($user->create()){
      $token = new VerifyCode(owner: $user);
      $code = $token->insert();
      $_SESSION['toast'] = [
          'type' => 'success',
          'message' => 'Account created successfully! You can now log in.'
      ];
      // Send verification email
      $mail = new Mail($user, $code);
      // $mail->send();
      $_SESSION['verificationCode'] = $code; // Store the code in session for later verification
      header("Location: ?pid=" . base64_encode("ui/home/verifyCode.php"));
      exit();
    } else {
      $_SESSION['toast'] = [
          'type' => 'danger',
          'message' => 'Error creating account.'
      ];
      header("Location: ./");
      exit();
    }
  } 
}

?>
<!-- Modal Sign Up -->
<div class="modal fade" id="signupModal" tabindex="-1" aria-labelledby="signupModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content rounded-4">
      <div class="modal-header">
        <h5 class="modal-title" id="signupModalLabel">Create an Account</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="<?= "?pid=" . base64_encode("ui/home/modalSignUp.php")?>" method="POST">
          <div class="mb-3">
            <label for="signupName" class="form-label">Name</label>
            <input type="text" class="form-control" id="signupName" name="name">
          </div>
          <div class="mb-3">
            <label for="signupLastName" class="form-label">Last Name</label>
            <input type="text" class="form-control" id="signupLastName" name="lastName">
          </div>
          <div class="mb-3">
            <label for="signupEmail" class="form-label">Email address</label>
            <input type="email" class="form-control" id="signupEmail" name="email">
          </div>
          <div class="mb-3">
            <label for="signupPassword" class="form-label">Password</label>
            <input type="password" class="form-control" id="signupPassword" name="password">
          </div>
          <button type="submit" class="btn btn-primary w-100">Sign Up</button>
        </form>
      </div>
    </div>
  </div>
</div>

