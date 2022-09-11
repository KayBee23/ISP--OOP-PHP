<?php require APPROOT . '/views/inc/header.php';  ?>

<h2 class="text-center my-4">FAQs</h2>
<div class="row">
  <div class="col-md-6 mx-auto">
    <div class="card card-body p-2">
      <?php echo flash('message_success'); ?>
      <h2 class="text-center my-4">Ask Us About Anything </h2>
      <form action="<?php echo URLROOT;?>/pages/faqs" method="POST">
        <div class="form-floating mb-3">
          <input type="email" name="email"
            class="form-control <?php echo !empty($data['email_error']) ? 'is-invalid' :  ''; ?>" placeholder="Email"
            value="<?php echo isLoggedIn() ? $_SESSION['user_email'] : $data['email'] ?>">
          <label for="email">Email</label>
          <span class="invalid-feedback"><?php echo $data['email_error']; ?></span>
        </div>
        <div class="form-floating mb-4">
          <textarea name="message"
            class="form-control h-100 <?php echo !empty($data['email_error']) ? 'is-invalid' :  '' ?>"
            placeholder="Question"></textarea>
          <label for="message">Question</label>
          <span class="invalid-feedback"><?php echo $data['message_error']; ?></span>
        </div>
        <div class="d-flex justify-content-end">
          <button class="btn btn-primary w-25" type="submit">Send</button>
        </div>
      </form>
    </div>
  </div>
</div>




<?php require APPROOT . '/views/inc/footer.php';  ?>