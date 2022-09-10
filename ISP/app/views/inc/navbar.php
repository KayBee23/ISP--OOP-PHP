<header
  class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom">
  <a href="<?php URLROOT;?>" class="d-flex align-items-center col-md-3 mb-2 mb-md-0 text-dark text-decoration-none">
    <img class="logo" src="<?php echo URLROOT;?>/public/img/logo.png" alt="">
  </a>

  <ul class=" nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
    <li><a href="<?php echo URLROOT ;?>" class="nav-link px-2 link-secondary">Home</a></li>
    <li><a href="<?php echo URLROOT; ?>/pages/plans" class="nav-link px-2 link-dark">Plans</a></li>
    <li><a href="#" class="nav-link px-2 link-dark">FAQs</a></li>
    <li><a href="#" class="nav-link px-2 link-dark">About</a></li>
  </ul>

  <div class="col-md-3 text-end d-flex align-items-center ">
    <?php if(isset($_SESSION['user_id'])) : ?>
    <a href="<?php echo URLROOT;?>/users/profile"
      class="me-5 link text-decoration-none link-dark fs-5 "><?php echo $_SESSION['user_name']; ?></a>
    <a href="<?php echo URLROOT; ?>/users/logout" class="btn btn-info">Logout</a>
    <?php else : ?>
    <a href="<?php echo URLROOT; ?>/users/login" class="btn btn-outline-primary me-2">Login</a>
    <a href="<?php echo URLROOT; ?>/users/register" class="btn btn-primary">Register</a>
    <?php endif; ?>
  </div>
</header>