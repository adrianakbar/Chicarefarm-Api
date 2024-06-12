<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title></title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link href="{{ asset('css/homepage.css') }}" rel="stylesheet">
</head>


<body>
    {{-- header --}}
  <nav class="navbar navbar-expand-lg fixed-top">
    <div class="container-fluid">
      <a class="navbar-brand me-auto" href="#">
        <img src="image/logo.png" alt="" width="100">
      </a>
      <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
        <div class="offcanvas-header">
          <h5 class="offcanvas-title" id="offcanvasNavbarLabel">
            <a class="navbar-brand me-auto" href="#">
              <img src="image/logo.png" alt="" width="100">
            </a>
          </h5>
          <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
      </div>
      <a href="/login" class="login-button">Login</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
    </div>
  </nav>
    {{-- header end --}}

  <!-- content -->
<div id="carouselExampleCaptions" class="carousel slide">
    <div class="carousel-inner">
        <div class="carousel-item active">
            <div class="row">
                <div class="col-md-6">
                    <div class="carousel-caption animate__animated animate__fadeInDown caption1" style="animation-delay:1s;">
                        <h5>Tentang <span>Kami</span></h5>
                        <p class="animate__animated animate__fadeInUp" style="animation-delay:2s;">Dengan Chicare Farm, Anda dapat memonitor kondisi kelembaban sekam pada kandang ayam Anda secara real-time dari mana saja dan kapan saja. Klik tombol dibawah untuk memulai!</p>
                        <p class="animate__animated animate__fadeInUp" style="animation-delay:3s;"><a href="/login">Login</a></p>
                    </div>
                </div>
                <div class="col-md-6">
                    <img src="image/logo.png" class="d-block carousel-image1 animate__animated animate__fadeInRight" alt="..." style="animation-delay:1s;">
                </div>
            </div>
        </div>
        <div class="carousel-item">
            <div class="row">
                <div class="col-md-6">
                    <div class="carousel-caption animate__animated animate__fadeInDown caption2" style="animation-delay:1s;">
                        <h5 class="animate__animated animate__fadeInDown" style="animation-delay:1s;">Sekam <span>Ayam</span></h5>
                        <p class="animate__animated animate__fadeInUp" style="animation-delay:2s;">Sekam merupakan bagian biji-bijian yang berupa daun kering, bersisik, dan tidak dapat dimakan. Sekam digunakan peternak ayam sebagai alas litter karena kemampuan sekam yang mempunyai sifat menyerap air dengan baik</p>
                    </div>
                </div>
                <div class="col-md-6">
                  <img src="image/sekam.jpg" class="d-block carousel-image2 animate__animated animate__fadeInRight" alt="..." style="animation-delay:1s;">
                </div>
            </div>
        </div>
    </div>
    <button class="carousel-control-prev buttoncarousel" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
        <span class="" aria-hidden="true"><i class="fa-solid fa-circle-arrow-left fa-2x"></i></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next buttoncarousel" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
        <span class="" aria-hidden="true"><i class="fa-solid fa-circle-arrow-right fa-2x"></i></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>
<!-- content end -->


  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
