$(document).ready(function () {
    $(".ukurancheckbox").on("change", function () {
        var isChecked = $(this).is(":checked");
        var taskId = $(this).data("id"); // Assumes you have a data-id attribute with task id
        var csrfToken = $('meta[name="csrf-token"]').attr("content");
        var checkboxValue = isChecked ? 1 : 0;
        var token = localStorage.getItem("token");

        console.log("Task ID:", taskId);

        Swal.fire({
            title: "Ubah Status Tugas",
            text: "Apakah Anda yakin?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#515646",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yakin",
            cancelButtonText: "Batal",
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "http://localhost:8000/api/listtugas/" + taskId,
                    type: "PUT",
                    headers: {
                        Authorization: `Bearer ${token}`,
                    },
                    data: {
                        _token: csrfToken,
                        id_tugas: taskId,
                        checkbox: checkboxValue,
                    },
                    success: function (response) {
                        Swal.fire({
                            title: "Berhasil",
                            text: "Tugas berhasil diperbarui",
                            icon: "success",
                            showCancelButton: false, // Tidak menampilkan tombol Cancel
                            confirmButtonText: "OK", // Mengubah teks tombol konfirmasi menjadi "OK"
                            confirmButtonColor: "#515646", // Mengubah warna tombol konfirmasi menjadi hijau
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
            } else {
                // If user cancels, revert the checkbox state
                $(this).prop("checked", !isChecked);
            }
        });
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
