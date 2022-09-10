<?php require APPROOT . "/views/inc/header.php";?>
<h1 class="text-center ">Home Internet Plans</h1>
<div class="row mx-auto mt-5 d-flex">
  <h1><?php echo $data['error']; ?></h1>
  <?php foreach($this->plans as $plan) :?>
  <div class="col-md-4 ">
    <div class="card card-body d-flex flex-column bg-primary shadow h-100">
      <div class="card-title my-3  d-flex  w-100">
        <span class="plan-icon mx-3"><i class="fas fa-wifi fa-2x"></i></span>
        <h4 class="card-title text-center text-light"><?php echo $plan->plan_name ?></h3>
      </div>
      <span class="text-center fs-2 text-light plan-title mb-3"><?php echo $plan->price . '$'?></span>
      <div class="descrpition">
        <span><i class="fa fa-arrow"></i></span>
        <p class=" fs-5 text-light text-left"><?php echo $plan->description?></p>
      </div>
      <form class="h-100 d-flex" action="<?php echo URLROOT; ?>/pages/plans" method="POST">
        <input type="text" class="visually-hidden" name="plan_name" value="<?php echo $plan->plan_name;?>">
        <button class="btn btn-light w-100 align-self-end" type="submit">Select Plan</button>
      </form>
    </div>
  </div>
  <?php endforeach ;?>
</div>

<?php require APPROOT . "/views/inc/footer.php";?>