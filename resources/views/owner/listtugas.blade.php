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
    <link href="{{ asset('css/listtugas.css') }}" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.30.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>

<body>
    {{-- header --}}
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand me-auto" href="">
                <img src="{{ asset('image/logo.png') }}" alt="" width="100">
            </a>
            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar"
                aria-labelledby="offcanvasNavbarLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasNavbarLabel">
                        <a class="navbar-brand me-auto" href="">
                            <img src="{{ asset('image/logo.png') }}" alt="" width="100">
                        </a>
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <ul class="navbar-nav justify-content-center flex-grow-1 pe-5">
                        <li class="nav-item">
                            <a class="nav-link mx-lg-3" aria-current="page" href="/owner/datakelembaban">Data
                                Kelembaban</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link mx-lg-3 active" href="/owner/listtugas">List Tugas</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link mx-lg-3" href="/owner/datakaryawan">Data Karyawan</a>
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
    <div class="container-fluid isicontent">
        <div class="row">
            <div class="col-10">
                @php
                    // Urutkan data berdasarkan id_hari
                    $groupedTasks = $hariDenganTugas->sortBy('id_hari')->groupBy('nama_hari');
                    $counter = 0; // Counter untuk mengatur baris
                @endphp
                @foreach ($groupedTasks as $nama_hari => $tasks)
                    @if ($counter % 3 == 0)
                        <div class="row"> <!-- Baris baru setiap tiga hari -->
                    @endif
                    <div class="col-4 wrapper"> <!-- Kolom untuk setiap hari -->
                        <div class="card-body">
                            <div class="d-flex justify-content-between namahari" data-bs-toggle="collapse"
                                data-bs-target="#collapse{{ $nama_hari }}">
                                <strong class="judulcard"><i class="fa-solid fa-list-check"></i> &nbsp;{{ $nama_hari }}</strong>
                                <i class="fa-solid fa-chevron-down"></i>
                            </div>
                            <div id="collapse{{ $nama_hari }}" class="collapse">
                                @if ($tasks->isEmpty())
                                    <p>Tidak ada tugas untuk {{ $nama_hari }}.</p>
                                @else
                                    <ul class="">
                                        @foreach ($tasks as $tugas)
                                            <li class="listjudultugas">
                                                <div>
                                                    <div><strong class="judultugas">{{ $tugas->judul }}</strong> <i class="fa-solid fa-trash"
                                                            onclick="deletetugas({{ $tugas->id_tugas }})"></i></div>
                                                    <div class="checkbox">
                                                        <input type="checkbox" id="checkbox" name="checkbox" class="ukurancheckbox" disabled
                                                            @if ($tugas->checkbox == 1) checked @endif>
                                                    </div>
                                                </div>
                                                <p>{{ $tugas->deskripsi }}</p>
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                            </div>
                        </div>
                    </div>
                    @php
                        $counter++;
                        if ($counter % 3 == 0 || $loop->last) echo '</div>'; // Menutup baris setelah tiga hari atau pada hari terakhir
                    @endphp
                @endforeach
            </div>
            <div class="col-2">
                <button class="btn-tambah" data-bs-toggle="modal"
                data-bs-target="#createmodal">Tambah</button>
            </div>
        </div>
    </div>
    
    

    <!-- Modal create -->
    <div class="modal fade" id="createmodal" tabindex="-1" aria-labelledby="exampleModalLabel"
        data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Buat tugas baru</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" id="createForm">
                        @csrf
                        <div class="mb-3">
                            <label for="hari" class="form-label">Hari</label>
                            <select class="form-select" id="hari" name="hari" required>
                                <option value="" selected disabled>Pilih Hari</option>
                                @foreach ($hari as $nama_hari)
                                    <option value="{{ $nama_hari }}">{{ $nama_hari }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="createjudul" class="form-label">Judul tugas</label>
                            <input type="text" class="form-control" id="judultugas" name="judultugas">
                        </div>
                        <div class="mb-3">
                            <label for="createketerangan" class="form-label">Deskripsi tugas</label>
                            <input type="text" class="form-control" id="deskripsitugas" name="deskripsitugas">
                        </div>
                        <div class="text-end">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="button" class="btn btn-primary" id="createbutton"
                                onclick="createtugas()">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- content end --}}

</body>
<script src="{{ asset('js/listtugas.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
</script>

</html>
