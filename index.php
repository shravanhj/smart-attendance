<?php include 'config/config.php'; ?>
<?php include 'common/header.php';
?>



<div id="carouselExampleIndicators" class="carousel slide">
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
  </div>

  <div class="carousel-inner">

    <div class="carousel-item active">
      <img src="assets/images/Picture2.png" class="d-block w-100" alt="...">
    </div>

    <div class="carousel-item">
      <img src="assets/images/Picture2.png" class="d-block w-100" alt="...">
    </div>

    <div class="carousel-item ">
      <img src="assets/images/Picture2.png" class="d-block w-100" alt="...">
    </div>

  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
  <i class="fa-solid fa-angle-left"  aria-hidden="true"></i>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
    <i class="fa-solid fa-angle-right"  aria-hidden="true"></i>
    <span class="visually-hidden">Next</span>
  </button>
</div>

<?php include 'common/footer.php'; ?>
