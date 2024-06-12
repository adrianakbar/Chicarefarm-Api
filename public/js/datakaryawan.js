function createdata() {
    event.preventDefault(); // Mencegah perilaku default form submission

    var nama = $("#createnama").val();
    var tanggalMasuk = $("#createtanggalmasuk").val();
    var alamat = $("#createalamat").val();
    var noHp = $("#createnohp").val();
    var token = localStorage.getItem("token"); // Mengambil token dari localStorage

    // Memeriksa apakah semua field telah diisi
    if (nama === "" || tanggalMasuk === "" || alamat === "" || noHp === "") {
        Swal.fire({
            title: "Gagal",
            text: "Semua data harus diisi",
            icon: "warning",
            confirmButtonColor: "#515646",
        });
        return; // Menghentikan proses jika ada field yang kosong
    }

    // Memeriksa apakah nomor HP hanya terdiri dari angka
    var hpPattern = /^\d+$/;
    if (!hpPattern.test(noHp)) {
        Swal.fire({
            title: "Gagal",
            text: "Nomor HP harus berupa angka",
            icon: "warning",
            confirmButtonColor: "#515646",
        });
        return; // Menghentikan proses jika nomor HP tidak valid
    }

    // Kirim data ke server menggunakan Ajax
    $.ajax({
        url: "http://localhost:8000/api/datakaryawan",
        type: "POST",
        contentType: "application/json",
        headers: {
            Authorization: `Bearer ${token}`, // Mengirim token ke server
        },
        data: JSON.stringify({
            nama_karyawan: nama,
            tanggal_masuk: tanggalMasuk,
            alamat: alamat,
            no_hp: noHp,
        }),
        success: function (response) {
            Swal.fire({
                title: "Berhasil",
                text: "Data karyawan berhasil ditambahkan",
                icon: "success",
                showCancelButton: false, // Tidak menampilkan tombol Cancel
                confirmButtonText: "OK", // Mengubah teks tombol konfirmasi menjadi "OK"
                confirmButtonColor: "#515646", // Mengubah warna tombol konfirmasi menjadi hijau
            }).then((result) => {
                if (result.isConfirmed) {
                    location.reload(); // Me-refresh halaman jika tombol "OK" diklik
                }
            });
        },
        error: function (xhr) {
            Swal.fire({
                title: "Gagal",
                text: "Harap login terlebih dahulu",
                icon: "error",
                confirmButtonColor: "#515646",
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "/login"; // Redirect ke halaman login jika token tidak valid atau sudah kadaluarsa
                }
            });
        },
    });
}

$(".delete-btn").click(function (e) {
    e.preventDefault();
    var id_karyawan = $(this).data("id"); // Mengambil nilai ID dari atribut data-id
    var token = localStorage.getItem("token"); // Mengambil token dari localStorage

    Swal.fire({
        title: "Apakah Anda yakin?",
        text: "Data yang dihapus tidak dapat dikembalikan",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#515646",
        cancelButtonColor: "#d33",
        cancelButtonText: "Batal",
        confirmButtonText: "Yakin",
        confirmButtonColor: "#515646",
    }).then((result) => {
        if (result.isConfirmed) {
            // Jika user mengkonfirmasi untuk menghapus, kirim permintaan delete ke server
            $.ajax({
                url: "http://localhost:8000/api/datakaryawan/" + id_karyawan, // Sesuaikan dengan URL yang sesuai di Laravel
                type: "DELETE",
                headers: {
                    Authorization: `Bearer ${token}`, // Mengirim token ke server
                },
                success: function (response) {
                    // Tampilkan pesan sukses
                    Swal.fire({
                        title: "Terhapus",
                        text: "Data karyawan berhasil dihapus",
                        icon: "success",
                        confirmButtonColor: "#515646",
                    }).then(() => {
                        // Refresh halaman setelah penghapusan berhasil
                        location.reload();
                    });
                },
                error: function (xhr, status, error) {
                    // Tampilkan pesan error jika terjadi masalah saat menghapus
                    Swal.fire({
                        title: "Gagal",
                        text: "Harap login terlebih dahulu",
                        icon: "error",
                        confirmButtonColor: "#515646",
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = "/login"; // Redirect ke halaman login jika token tidak valid atau sudah kadaluarsa
                        }
                    });
                },
            });
        }
    });
});

$(".update-btn").click(function () {
    var id = $(this).data("id");
    $.get("/idkaryawan/" + id, function (data) {
        $("#updatenama").val(data.nama_karyawan);
        $("#updatetanggalmasuk").val(data.tanggal_masuk);
        $("#updatealamat").val(data.alamat);
        $("#updatenohp").val(data.no_hp);

        // Simpan id ke tombol #saveupdate
        $("#saveupdate").data("id", id);
    });
});

$("#saveupdate").click(function () {
    var id = $(this).data("id");
    var nama = $("#updatenama").val();
    var tanggalMasuk = $("#updatetanggalmasuk").val();
    var alamat = $("#updatealamat").val();
    var noHp = $("#updatenohp").val();
    var token = localStorage.getItem("token"); // Mengambil token dari localStorage

    // Periksa apakah nama atau tanggal kosong
    if (nama === "" || tanggalMasuk === "" || alamat === "" || noHp === "") {
        // Tampilkan Sweet Alert untuk error
        Swal.fire({
            icon: "error",
            title: "Gagal",
            text: "Semua data harus diisi",
            confirmButtonColor: "#515646",
        });
        return; // Berhenti eksekusi jika ada data yang kosong
    }

    // Memeriksa apakah nomor HP hanya terdiri dari angka
    var hpPattern = /^\d+$/;
    if (!hpPattern.test(noHp)) {
        Swal.fire({
            title: "Gagal",
            text: "Nomor HP harus berupa angka",
            icon: "warning",
            confirmButtonColor: "#515646",
        });
        return; // Menghentikan proses jika nomor HP tidak valid
    }

    // Kirim data ke URL yang diinginkan
    $.ajax({
        url: "http://localhost:8000/api/datakaryawan/" + id,
        type: "PUT",
        contentType: "application/json",
        headers: {
            Authorization: `Bearer ${token}`, // Mengirim token ke server
        },
        data: JSON.stringify({
            nama_karyawan: nama,
            tanggal_masuk: tanggalMasuk,
            alamat: alamat,
            no_hp: noHp,
        }),
        success: function (response) {
            // Tampilkan Sweet Alert untuk sukses
            Swal.fire({
                icon: "success",
                title: "Berhasil",
                text: "Data karyawan berhasil diperbarui",
                confirmButtonText: "OK",
                confirmButtonColor: "#515646",
            }).then(function () {
                location.reload(); // Muat ulang halaman setelah Sweet Alert tertutup
            });
        },
        error: function (xhr) {
            Swal.fire({
                title: "Gagal",
                text: "Harap login terlebih dahulu",
                icon: "error",
                confirmButtonColor: "#515646",
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "/login"; // Redirect ke halaman login jika token tidak valid atau sudah kadaluarsa
                }
            });
        },
    });
});

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
                success: function (response) {
                   window.location.href = "/"; // Redirect ke halaman login jika logout berhasil
                },
                error: function (xhr) {
                    Swal.fire({
                        title: "Gagal",
                        text: "Harap login terlebih dahulu",
                        icon: "error",
                        confirmButtonColor: "#515646",
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = "/login"; // Redirect ke halaman login jika token tidak valid atau sudah kadaluarsa
                        }
                    });
                },
            });
        }
    });
}
