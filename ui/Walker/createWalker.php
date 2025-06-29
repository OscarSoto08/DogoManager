<?php

if ($_SESSION['role'] !== 'Admin') {
  header('Location: ?pid=' . base64_encode('ui/failure/Forbidden403.php'));
  exit();
}

$admin = new Admin($_SESSION['userID']);
$admin->retrieve();
require_once "ui/Admin/navbarAdmin.php";
?>
<div class="container mt-4">
  <h3><i class="fa-solid fa-user-plus me-2"></i> Add New Walker</h3>
  <form id="formAddWalker" autocomplete="off">
    <div class="row g-3">
      <div class="col-md-6">
        <label for="firstName" class="form-label">First Name</label>
        <input type="text" id="firstName" name="name" class="form-control" required>
      </div>
      <div class="col-md-6">
        <label for="lastName" class="form-label">Last Name</label>
        <input type="text" id="lastName" name="lastName" class="form-control" required>
      </div>
      <div class="col-md-6">
        <label for="email" class="form-label">Email</label>
        <input type="email" id="email" name="email" class="form-control" required>
      </div>
      <div class="col-md-6">
        <label for="password" class="form-label">Password</label>
        <input type="password" id="password" name="password" class="form-control" required>
      </div>
      <div class="col-md-4">
        <label for="rate" class="form-label">Rate per Hour</label>
        <input type="number" step="0.01" id="rate" name="ratePerHour" class="form-control">
      </div>
      <div class="col-md-8">
        <label for="description" class="form-label">Description</label>
        <input type="text" id="description" name="description" class="form-control">
      </div>
      <div class="col-12">
        <button type="submit" class="btn btn-primary">
          <i class="fa-solid fa-plus me-1"></i> Create Walker
        </button>
      </div>
    </div>
  </form>

  <div id="addResult" class="mt-3"></div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(function(){
  $('#formAddWalker').on('submit', function(e){
    e.preventDefault();
    const data = $(this).serialize();
    $.ajax({
      type: 'POST',
      url: 'createWalkerAjax.php',
      data: data,
      dataType: 'json',
      success: function(res){
        if(res.success){
          $('#addResult').html(
            `<div class="alert alert-success">${res.message}</div>`
          );
          $('#formAddWalker')[0].reset();
        } else {
          $('#addResult').html(
            `<div class="alert alert-danger">${res.message}</div>`
          );
        }
      },
      error: function(xhr,textStatus){
        $('#addResult').html(
          `<div class="alert alert-danger">Error al comunicarse con el servidor</div>`
        );
      }
    });
  });
});
</script>
