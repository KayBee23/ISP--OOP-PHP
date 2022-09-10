<?php require APPROOT . '/views/inc/header.php';  ?>

<div class="row">
  <div class="col-md-6 mx-auto">
    <div class="card card-body">
      <?php echo flash('register_success'); ?>
      <h2 class="text-center mb-4">Login</h2>
      <form action="<?php echo URLROOT;?>/users/login" method="POST">
        <div class="form-floating mb-3">
          <input type="email" name="email"
            class="form-control <?php echo !empty($data['email_error']) ? 'is-invalid' :  '' ?>" placeholder="Email"
            value="<?php echo $data['email'];?>">
          <label for="email">Email</label>
          <span class="invalid-feedback"><?php echo $data['email_error']; ?></span>
        </div>
        <div class="form-floating mb-3">
          <input type="password" name="password"
            class="form-control <?php echo !empty($data['password_error']) ? 'is-invalid' :  '' ?>"
            placeholder="Password" value="<?php echo $data['password']; ?>">
          <label for="password">Password</label>
          <span class="invalid-feedback"><?php echo $data['password_error']; ?></span>
        </div>
        <div class="row">
          <div class="col">
            <button class="btn btn-primary w-100 " type="submit">Login</button>
          </div>
          <div class="col">
            <a href="<?php echo URLROOT; ?>/users/register" class="text-primary btn btn-outline w-100">Don't have an
              account? Register!</a>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

<?php require APPROOT . '/views/inc/footer.php';  ?>