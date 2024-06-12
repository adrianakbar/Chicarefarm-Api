<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="{{ asset('css/datakelembaban.css') }}" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.30.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="text/javascript">
        google.charts.load('current', {
            'packages': ['gauge']
        });
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['Label', 'Value'],
                ['Lembab', 0]
            ]);

            var options = {
                width: 500,
                height: 250,
                redFrom: 70,
                redTo: 100,
                yellowFrom: 40,
                yellowTo: 90,
                greenFrom: 0,
                greenTo: 40,
                minorTicks: 5,
                max: 100 // Set maximum value to 100%
            };

            var chart = new google.visualization.Gauge(document.getElementById('chart_div'));

            chart.draw(data, options);

            // Function to update the gauge
            function updateGauge(kelembabanterbaru) {
                data.setValue(0, 1, kelembabanterbaru);
                chart.draw(data, options);
            }

            // AJAX function to fetch data from the server
            function fetchDataAndUpdateGauge() {
                $.ajax({
                    url: '/dataspeedometer', // URL to your route that fetches kelembaban data
                    type: 'GET',
                    success: function(response) {
                        updateGauge(response
                            .kelembabanterbaru
                        ); // Assuming the response is in JSON format with a 'kelembabanterbaru' field
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching data:', error);
                    }
                });
            }
            fetchDataAndUpdateGauge();
            setInterval(fetchDataAndUpdateGauge, 10000); // Fetch data every 5 seconds (adjust as needed)
        }
    </script>
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
                            <a class="nav-link mx-lg-3 active" aria-current="page" href="#">Data Kelembaban</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link mx-lg-3" href="/kepalakandang/listtugas">List Tugas</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link mx-lg-3" href="/kepalakandang/datakaryawan">Data Karyawan</a>
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
                            <img src="{{ asset('image/profile.png') }}" alt="" width="50px">&nbsp
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <a class="dropdown-item isidropdown2 mt-2" onclick="logout()"><img
                                    src="{{ asset('image/logout.png') }}" alt="" width="30px">&nbsp&nbspLogout
                                <span>></span>
                                <script>
                                    function logout() {
                                        var token = localStorage.getItem("token"); // Mengambil token dari local storage

                                        Swal.fire({
                                            title: "Apakah Anda yakin?",
                                            text: "Anda akan keluar dari akun ini",
                                            icon: "warning",
                                            showCancelButton: true,
                                            confirmButtonText: "Yakin",
                                            cancelButtonText: "Batal",
                                            confirmButtonColor: "#515646",
                                            cancelButtonColor: "#d33",
                                        }).then((result) => {
                                            if (result.isConfirmed) {
                                                // Jika pengguna mengklik "Iya"

                                                // Menghapus token dari local storage
                                                localStorage.removeItem("token");

                                                // Mengirim permintaan logout ke server
                                                $.ajax({
                                                    url: "http://localhost:8000/api/auth/logout",
                                                    type: "POST",
                                                    headers: {
                                                        Authorization: `Bearer ${token}`, // Menggunakan token dalam header Authorization
                                                    },
                                                    success: function(response) {
                                                        window.location.href =
                                                        "/"; // Redirect ke halaman login jika logout berhasil
                                                    },
                                                    error: function(xhr) {
                                                        Swal.fire({
                                                            title: "Gagal",
                                                            text: "Harap login terlebih dahulu",
                                                            icon: "error",
                                                            confirmButtonColor: "#515646",
                                                        }).then((result) => {
                                                            if (result.isConfirmed) {
                                                                window.location.href =
                                                                "/login"; // Redirect ke halaman login jika token tidak valid atau sudah kadaluarsa
                                                            }
                                                        });
                                                    },
                                                });
                                            }
                                        });
                                    }
                                </script>
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

    <!-- content -->
    <div class="container-fluid containersemua">
        <div class="row">
            <div class="container col-6 containertabel">
                <div class="judultabel">
                    <i class="fa-solid fa-table fa-xl"></i>
                    <span>Tabel Data Kelembaban</span>
                </div>
                <hr>
                <table class="table tabelbiasa" id="tabelawal">
                    <thead>
                        <tr>
                            <th scope="col" colspan="3" style="background-color: #515646;" class="text-light">Data
                                Kelembaban</th>
                            <td scope="col" class="text-end tdatas" style="background-color: #515646">
                                <a href="" data-bs-toggle="modal" data-bs-target="#staticBackdrop"
                                    id="lihatsemua">Lihat Semua <i class="fa-solid fa-expand"></i></a>
                            </td>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        <script>
                            $(document).ready(function() {
                                // Fungsi untuk memuat data kelembaban melalui AJAX
                                function tabelawal() {
                                    $.ajax({
                                        url: '/12data',
                                        method: 'GET',
                                        dataType: 'json',
                                        success: function(response) {
                                            // Hapus semua baris kecuali header
                                            $('#tabelawal tbody').empty();

                                            for (var i = 0; i < response.datatabel.length; i++) { // Mulai dari data terbaru
                                                var data = response.datatabel[i];
                                                // Format tanggal dan jam menggunakan moment.js
                                                var formattedDate = moment(data.date).format('D MMMM YYYY');
                                                var formattedTime = moment(data.date).format('HH:mm');
                                                if (data.kelembaban >= 20) {
                                                    // Buat baris tabel dengan latar belakang merah untuk menunjukkan kelembaban tinggi
                                                    var row = '<tr>' +
                                                        '<td style="background-color: red; color: white;">' + data
                                                        .kelembaban + '%</td>' +
                                                        '<td style="background-color: red; color: white;">' +
                                                        formattedDate + '</td>' +
                                                        '<td style="background-color: red; color: white;">' +
                                                        formattedTime + '</td>' +
                                                        '<td style="background-color: red; color: white;">' + data.status +
                                                        '</td>' +
                                                        '</tr>';
                                                    $('#tabelawal tbody').prepend(row); // Tambahkan di awal tabel
                                                } else {
                                                    // Buat baris tabel biasa untuk kelembaban normal
                                                    var row = '<tr>' +
                                                        '<td>' + data.kelembaban + '%</td>' +
                                                        '<td>' + formattedDate + '</td>' +
                                                        '<td>' + formattedTime + '</td>' +
                                                        '<td>' + data.status + '</td>' +
                                                        '</tr>';
                                                    $('#tabelawal tbody').prepend(row); // Tambahkan di awal tabel
                                                }
                                            }
                                        },
                                        error: function(xhr, status, error) {
                                            console.error(xhr.responseText);
                                        }
                                    });
                                }

                                // Memanggil fungsi untuk memuat data saat halaman dimuat
                                tabelawal();
                                setInterval(tabelawal, 10000);
                            });
                        </script>
                    </tbody>
                </table>
            </div>

            {{-- Modal lihatsemua --}}
            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false"
                tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="staticBackdropLabel">History data kelembaban</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <table class="table tabelmodal" id="tabelmodal">
                                <tbody class="text-center">
                                    <script>
                                        $(document).ready(function() {
                                            // Fungsi untuk memuat data kelembaban melalui AJAX
                                            function tabelmodal() {
                                                $.ajax({
                                                    url: '/datatabel',
                                                    method: 'GET',
                                                    dataType: 'json',
                                                    success: function(response) {
                                                        // Hapus semua baris kecuali header
                                                        $('#tabelmodal tbody').empty();

                                                        // Tampilkan semua data tanpa batasan
                                                        for (var i = 0; i < response.datatabel.length; i++) {
                                                            var data = response.datatabel[i];
                                                            // Format tanggal dan jam menggunakan moment.js
                                                            var formattedDate = moment(data.date).format('D MMMM YYYY');
                                                            var formattedTime = moment(data.date).format('HH:mm');
                                                            if (data.kelembaban >= 20) {
                                                                var row = '<tr>' +
                                                                    '<td style="background-color: red; color: white;">' + data
                                                                    .kelembaban + '%</td>' +
                                                                    '<td style="background-color: red; color: white;">' +
                                                                    formattedDate + '</td>' +
                                                                    '<td style="background-color: red; color: white;">' +
                                                                    formattedTime + '</td>' +
                                                                    // Ambil bagian waktu saja
                                                                    '<td style="background-color: red; color: white;">' + data.status +
                                                                    '</td>' +
                                                                    '</tr>';
                                                                $('#tabelmodal tbody').prepend(row);
                                                            } else {
                                                                var row = '<tr>' +
                                                                    '<td>' + data.kelembaban + '%</td>' +
                                                                    '<td>' + formattedDate + '</td>' +
                                                                    '<td>' + formattedTime + '</td>' + // Ambil bagian waktu saja
                                                                    '<td>' + data.status + '</td>' +
                                                                    '</tr>';
                                                                $('#tabelmodal tbody').prepend(row);
                                                            }
                                                        }
                                                    },
                                                    error: function(xhr, status, error) {
                                                        console.error(xhr.responseText);
                                                    }
                                                });
                                            }

                                            // Memanggil fungsi untuk memuat data saat halaman dimuat
                                            tabelmodal();
                                            setInterval(tabelmodal, 10000);
                                        });
                                    </script>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal end -->

            <div class="col-6">
                <div class="container containerspeedometer">
                    <div class="judultabel">
                        <i class="fa-solid fa-gauge fa-xl"></i>
                        <span>Tingkat Kelembaban Sekam</span>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col">
                            <div id="chart_div" class="speedometer"></div>
                        </div>
                        <div class="col mt-3">
                            Tingkat kelembaban sekam saat ini: <p class="persensekam"></p>
                            <script>
                                function angkaspeedometer() {
                                    $.ajax({
                                        url: '/dataspeedometer', // URL to your route that fetches kelembaban data
                                        type: 'GET',
                                        success: function(response) {
                                            if (response.kelembabanterbaru >= 20) {
                                                // Update the gauge color to red if kelembabanterbaru is greater than or equal to 20
                                                document.querySelector('.persensekam').style.color = 'red';
                                            } else {
                                                // Update the gauge color to green if kelembabanterbaru is less than 20
                                                document.querySelector('.persensekam').style.color = 'green';
                                            }
                                            document.querySelector('.persensekam').innerText = response.kelembabanterbaru +
                                                '%'; // Update the paragraph text with the kelembabanterbaru value
                                        },
                                        error: function(xhr, status, error) {
                                            console.error('Error fetching data:', error);
                                        }
                                    });
                                }
                                angkaspeedometer();
                                setInterval(angkaspeedometer, 10000); // Fetch data every 5 seconds (adjust as needed)
                            </script>
                        </div>

                    </div>
                </div>

                <div class="container containercuaca">
                    <div class="judultabel">
                        <i class="fa-solid fa-temperature-half fa-xl"></i>
                        <span>Kondisi Cuaca</span>
                    </div>
                    <hr>
                    <div class="text-center">
                        <h2>Cuaca hari ini</h2>
                        <div class="weather-info">
                            <div class="weather-icon">
                                <img src="" alt="Weather Icon" id="weather-icon">
                            </div>
                            <div class="weather-details">
                                <span class="celcius" id="temperature"></span>°C
                                <br><span class="deskripsi" id="description"></span>
                            </div>
                        </div>
                    </div>

                    <script>
                        function fetchWeatherData() {
                            $.ajax({
                                url: 'https://api.openweathermap.org/data/2.5/weather?lat=-8.1656481&lon=113.7170601&appid=fd2e80c52349079c21fa4f5023f62f23&units=metric',
                                method: 'GET',
                                success: function(data) {
                                    $('#temperature').text(data.main.temp);
                                    $('#description').text(data.name);
                                    $('#weather-icon').attr('src',
                                        `https://openweathermap.org/img/wn/${data.weather[0].icon}.png`);
                                },
                                error: function(error) {
                                    console.log('Error fetching weather data:', error);
                                }
                            });
                        }

                        // Panggil fetchWeatherData saat halaman dimuat pertama kali
                        fetchWeatherData();

                        // Perbarui data setiap 1 jam
                        setInterval(fetchWeatherData, 3600000); // 3600000ms = 1 jam
                    </script>
                </div>
            </div>
        </div>
    </div>
    <!-- content end -->



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>
