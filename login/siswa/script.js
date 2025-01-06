function togglePassword() {
    var passwordField = document.getElementById("password");
    var showIcon = document.getElementById("show-password");
    var hideIcon = document.getElementById("hide-password");

    if (passwordField.type === "password") {
        // Show password, change icon
        passwordField.type = "text";
        showIcon.classList.add("hidden");
        hideIcon.classList.remove("hidden");
    } else {
        // Hide password, change icon
        passwordField.type = "password";
        showIcon.classList.remove("hidden");
        hideIcon.classList.add("hidden");
    }
}

document.addEventListener("DOMContentLoaded", function () {
    // Mengambil parameter URL
    const params = new URLSearchParams(window.location.search);
    const errorCode = params.get("error");

    if (errorCode) {
        const errorAlert = document.getElementById("errorAlert");
        const errorMessage = document.getElementById("errorMessage");

        // Menampilkan pesan berdasarkan error code
        if (errorCode === "1") {
            errorMessage.innerText = "Email tidak terdaftar.";
        } else if (errorCode === "2") {
            errorMessage.innerText = "Laman anda salah.";
        } else if (errorCode === "3") {
            errorMessage.innerText = "Password anda salah.";
        }

        // Tampilkan alert
        errorAlert.classList.remove("hidden");
        setTimeout(() => {
            errorAlert.classList.add("hidden");
        }, 3000);
    }
});
