window.onload = function () {
    // Validasi email
    document.getElementById("email").oninvalid = function (event) {
        event.target.setCustomValidity("Mohon isi email");
    };
    document.getElementById("email").oninput = function (event) {
        event.target.setCustomValidity("");
    };

    // Validasi password
    document.getElementById("pass").oninvalid = function (event) {
        event.target.setCustomValidity("Mohon isi password");
    };
    document.getElementById("pass").oninput = function (event) {
        event.target.setCustomValidity("");
    };
};

function submitform() {
    event.preventDefault(); // Mencegah form dari pengiriman default

    var email = $("#email").val();
    var password = $("#pass").val();

    // Kirim permintaan AJAX ke endpoint login
    $.ajax({
        url: "http://localhost:8000/api/auth/login", // Ganti dengan URL endpoint login Anda
        type: "POST",
        contentType: "application/json",
        data: JSON.stringify({
            email: email,
            password: password,
        }),
        success: function (response) {
            // Simpan token ke localStorage atau cookie
            localStorage.setItem("token", response.access_token);

            // Arahkan pengguna berdasarkan peran setelah login berhasil
            if (response.role == "owner") {
                window.location.href = "/owner/datakelembaban";
            } else if (response.role == "kepalakandang") {
                window.location.href = "/kepalakandang/datakelembaban";
            } else {
                // Peran tidak dikenali, tangani di sini (opsional)
                console.error("Peran pengguna tidak dikenali");
            }
        },
        error: function (xhr, status, error) {
            // Tangani kesalahan, misalnya tampilkan pesan kesalahan
            swal.fire({
                title: "Gagal",
                text: "Email atau password salah",
                icon: "error",
                confirmButtonColor: "#515646",
            });
        },
    });
}
