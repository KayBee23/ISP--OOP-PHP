<?php require APPROOT . '/views/inc/header.php';  ?>
<?php echo flash('plan_success'); ?>
<div class="row">
  <div class="col-md-6 mx-auto">
    <div class="card card-body mt-5 p-5">
      <h3 class="text-center">Your Profile</h3>
      <hr>
      <div class="row d-felx justify-content-between">
        <div class="col">
          <span class="fw-bold ms-3">Name</span>
        </div>
        <div class="col text-end">
          <span class=""><?php echo $_SESSION['user_name'] ?></span>
        </div>
      </div>
      <hr>
      <div class="row d-felx justify-content-between">
        <div class="col">
          <span class="fw-bold ms-3">Email</span>
        </div>
        <div class="col text-end">
          <span class=""><?php echo $_SESSION['user_email'] ?></span>
        </div>
      </div>
      <hr>
      <div class="row d-flex justify-content-between">
        <div class="col">
          <span class="fw-bold ms-3">Subscription</span>
        </div>
        <div class="col text-end">
          <?php  if(empty($_SESSION['user_sub'])) : ?>
          <a href="<?php echo URLROOT; ?>/pages/plans" class="btn btn-primary">Select a subscription</a>
          <?php else : ?>
          <div class="row d-flex">
            <div class="col">
              <form action="<?php echo URLROOT; ?>/users/deleteSub" method="post">
                <input type="submit" class="btn  btn-outline-danger p-1 w-100" value="Delete">
              </form>
            </div>
            <div class="col">
              <span class="badge bg-success w-100 p-2"><?php echo $_SESSION['user_sub'] ?></span>
            </div>
          </div>
          <?php endif; ?>
        </div>
      </div>
      <hr>
    </div>
  </div>
</div>

<?php require APPROOT . '/views/inc/footer.php';  ?>