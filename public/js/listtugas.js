function createtugas() {
    var judul = $("#judultugas").val();
    var deskripsi = $("#deskripsitugas").val();
    var hari = $("#hari").val();
    var checkbox = $("#checkbox").prop("checked") ? 1 : 0; // Mendapatkan nilai checkbox
    var token = localStorage.getItem("token");

    // Memeriksa apakah semua field telah diisi
    if (judul === "" || deskripsi === "" || hari === "") {
        Swal.fire({
            title: "Gagal",
            text: "Semua data harus diisi",
            icon: "warning",
            confirmButtonColor: "#515646",
        });
        return; // Menghentikan proses jika ada field yang kosong
    }

    $.ajax({
        url: "http://localhost:8000/api/listtugas",
        type: "POST",
        contentType: "application/json",
        headers: {
            Authorization: `Bearer ${token}`,
        },
        data: JSON.stringify({
            judul: judul,
            deskripsi: deskripsi,
            hari: hari,
            checkbox: checkbox,
        }),
        success: function (response) {
            Swal.fire({
                title: "Berhasil",
                text: "Tugas berhasil ditambahkan",
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
        error: function (response) {
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

function deletetugas(id_tugas) {
    var token = localStorage.getItem("token");

    Swal.fire({
        title: "Apakah Anda yakin?",
        text: "Data yang dihapus tidak dapat dikembalikan",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#515646",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yakin",
        cancelButtonText: "Batal",
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: "http://localhost:8000/api/listtugas/" + id_tugas,
                type: "DELETE",
                headers: {
                    Authorization: `Bearer ${token}`,
                },
                success: function (response) {
                    // Tampilkan pesan sukses
                    Swal.fire({
                        title: "Terhapus",
                        text: "Tugas berhasil dihapus",
                        icon: "success",
                        confirmButtonColor: "#515646",
                    }).then(() => {
                        // Refresh halaman setelah penghapusan berhasil
                        location.reload();
                    });
                },
                error: function (response) {
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

