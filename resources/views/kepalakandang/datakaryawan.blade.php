<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="{{ asset('css/datakaryawan.css') }}" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.30.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>

<body>
    {{-- header --}}
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand me-auto" href="#">
                <img src="{{ asset('image/logo.png') }}" alt="" width="100">
            </a>
            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar"
                aria-labelledby="offcanvasNavbarLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasNavbarLabel">
                        <a class="navbar-brand me-auto" href="#">
                            <img src="{{ asset('image/logo.png') }}" alt="" width="100">
                        </a>
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <ul class="navbar-nav justify-content-center flex-grow-1 pe-5">
                        <li class="nav-item">
                            <a class="nav-link mx-lg-3" aria-current="page" href="/kepalakandang/datakelembaban">Data
                                Kelembaban</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link mx-lg-3" href="/kepalakandang/listtugas">List Tugas</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link mx-lg-3 active" href="">Data Karyawan</a>
                        </li>
                    </ul>
                </div>
            </div>
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="{{ asset('image/profile.png') }}" alt="" width="40px">
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li class="dropdown-item userdropdown">
                            <img src="{{ asset('image/profile.png') }}" alt="" width="40px">&nbsp
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <a class="dropdown-item isidropdown2 mt-2" onclick="logout()"><img
                                    src="{{ asset('image/logout.png') }}" alt="" width="30px">&nbsp&nbspLogout
                                <span>></span>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar"
                aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </nav>
    {{-- header end --}}

    {{-- content --}}
    <div class="container-fluid container-content">
            <!-- Left column for cards -->
            <div class="col-md-12">
                <div class="row">
                    @foreach ($karyawan as $item)
                        <div class="col-md-4 mb-4">
                            <div class="card card1" style="width: 21rem;">
                                <img src="{{ asset('image/profile.png') }}" class="card-img-top mx-auto d-block"
                                    alt="...">
                                <div class="card-body">
                                    <div class="text-left">
                                        <p class="card-text"><strong>Nama &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp:</strong>
                                            {{ $item->nama_karyawan }}</p>
                                        <p class="card-text"><strong>Tanggal <br>masuk
                                                &nbsp&nbsp&nbsp&nbsp&nbsp:</strong>
                                            {{ date('d-m-Y', strtotime($item->tanggal_masuk)) }}</p>
                                        <p class="card-text"><strong>Alamat &nbsp&nbsp&nbsp&nbsp:</strong>
                                            {{ $item->alamat }}</p>
                                        <p class="card-text"><strong>No hp
                                                &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp:</strong> {{ $item->no_hp }}
                                        </p>
                                    </div>                                   
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
    </div>

    <!-- Modal update -->
    <div class="modal fade" id="updatemodal" tabindex="-1" aria-labelledby="exampleModalLabel"
        data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Perbarui data karyawan</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="PUT" action="" id="updateform">
                        @csrf
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="updatenama" name="nama"
                                value="{{ $item->nama_karyawan }}">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Tanggal masuk</label>
                            <input type="date" class="form-control" id="updatetanggalmasuk" name="tanggalMasuk"
                                value="{{ $item->tanggal_masuk }}">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Alamat</label>
                            <input type="text" class="form-control" id="updatealamat" name="alamat"
                                value="{{ $item->alamat }}">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">No hp</label>
                            <input type="text" class="form-control" id="updatenohp" name="noHp"
                                value="{{ $item->no_hp }}">
                        </div>
                        <div class="text-end">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="button" class="btn btn-primary" id="saveupdate">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal create -->
    <div class="modal fade" id="createmodal" tabindex="-1" aria-labelledby="exampleModalLabel"
        data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah data karyawan</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" id="createForm">
                        @csrf
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="createnama" aria-describedby="emailHelp">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Tanggal masuk</label>
                            <input type="date" class="form-control" id="createtanggalmasuk">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Alamat</label>
                            <input type="text" class="form-control" id="createalamat">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">No hp</label>
                            <input type="text" class="form-control" id="createnohp">
                        </div>
                        <div class="text-end">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="button" class="btn btn-primary" id="createbutton">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- content end --}}


</body>
<script src="{{ asset('js/datakaryawan.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
</script>

</html>
