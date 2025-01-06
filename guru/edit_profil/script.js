document.addEventListener("DOMContentLoaded", function () {
    // Mengambil parameter URL
    const params = new URLSearchParams(window.location.search);
    const errorCode = params.get("error");

    if (errorCode) {
        const errorAlert = document.getElementById("errorAlert");
        const errorMessage = document.getElementById("errorMessage");

        // Menampilkan pesan berdasarkan error code
        if (errorCode === "1") {
            errorMessage.innerText = "Password dan konfirmasi password berbeda.";
        } else if (errorCode === "2") {
            errorMessage.innerText = "Format file tidak didukung.";
        } else if (errorCode === "3") {
            errorMessage.innerText = "Ukuran file terlalu besar. (maksimal 4 MB)";
        }

        // Tampilkan alert
        errorAlert.classList.remove("hidden");
        setTimeout(() => {
            errorAlert.classList.add("hidden");
        }, 3000);
    }
});

// Menampilkan nama file
const fileInput = document.getElementById('profile_photo');
const fileNameDisplay = document.getElementById('fileNameDisplay');

fileInput.addEventListener('change', function () {
    if (this.files && this.files.length > 0) {
        fileNameDisplay.textContent = this.files[0].name; // Tampilkan nama file
    } else {
        fileNameDisplay.textContent = ''; // Kosongkan jika tidak ada file
    }
});