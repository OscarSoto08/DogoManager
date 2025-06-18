<?php 
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $email = $_POST['email'] ?? '';
  $password = md5($_POST['password']) ?? '';
  if(empty($email) || empty($password)) {
    $_SESSION['toast'] = [
        'type' => 'danger',
        'message' => 'Please fill in all fields.'
    ];
    header("Location: ./");
    exit();
  } else {
    $userList = ["Admin", "Owner", "Walker"];
    foreach($userList as $className){
      $user = new $className(email: $email, password: $password);
      if($user -> login()){
        $_SESSION['userID'] = $user->getId();
        $_SESSION['role'] = $className;
        header("Location: ?pid=". base64_encode("ui/{$className}/homepage.php"));
        exit();
      }
    }
    $_SESSION['toast'] = [
        'type' => 'danger',
        'message' => 'Invalid credentials.'
    ];
    header("Location: ./");
    exit();

  } 
}
?>

<!-- Modal Log In -->
<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content rounded-4">
      <div class="modal-header">
        <h5 class="modal-title" id="loginModalLabel">Log In</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="POST" action="<?= "?pid=". base64_encode("ui/home/modalLogin.php") ?>">
          <div class="mb-3">
            <label for="loginEmail" class="form-label">Email address</label>
            <input type="email" class="form-control" id="loginEmail" name="email">
          </div>
          <div class="mb-3">
            <label for="loginPassword" class="form-label">Password</label>
            <input type="password" class="form-control" name="password" id="loginPassword">
          </div>
          <button type="submit" class="btn btn-primary w-100">Log In</button>
        </form>
      </div>
    </div>
  </div>
</div>

<?php if (isset($_SESSION['toast'])): ?>
  <div class="toast-container position-fixed bottom-0 end-0 p-3" style="z-index: 1100;">
    <div class="toast align-items-center text-white bg-<?= $_SESSION['toast']['type'] ?> border-0 show" role="alert" aria-live="assertive" aria-atomic="true">
      <div class="d-flex">
        <div class="toast-body">
          <?= htmlspecialchars($_SESSION['toast']['message']) ?>
        </div>
        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
      </div>
    </div>
  </div>
  <?php unset($_SESSION['toast']); ?>
<?php endif; ?>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    const toastEl = document.querySelector('.toast');
    if (toastEl) {
      const toast = new bootstrap.Toast(toastEl);
      toast.show();
    }
  });
</script>

