const diskusi = [
    { fotoProfil: "/Study-Tube/assets/foto_profil.jpg", nama: "Muhammad Farhad Ajilla", pesan: "APALAH" },
    { fotoProfil: "/Study-Tube/assets/foto_profil.jpg", nama: "Ajil", pesan: "menyutujui diskusi dengan anda" },
    { fotoProfil: "/Study-Tube/assets/foto_profil.jpg", nama: "Ajil", pesan: "menyutujui diskusi dengan anda" },
    { fotoProfil: "/Study-Tube/assets/foto_profil.jpg", nama: "Ajil", pesan: "menyutujui diskusi dengan anda" },
    { fotoProfil: "/Study-Tube/assets/foto_profil.jpg", nama: "Ajil", pesan: "menyutujui diskusi dengan anda" },
    { fotoProfil: "/Study-Tube/assets/foto_profil.jpg", nama: "Ajil", pesan: "menyutujui diskusi dengan anda" },
    { fotoProfil: "/Study-Tube/assets/foto_profil.jpg", nama: "Ajil", pesan: "menyutujui diskusi dengan anda" },
    { fotoProfil: "/Study-Tube/assets/foto_profil.jpg", nama: "Ajil", pesan: "menyutujui diskusi dengan anda" },
    { fotoProfil: "/Study-Tube/assets/foto_profil.jpg", nama: "Ajil", pesan: "menyutujui diskusi dengan anda" }
];

const req_diskusi = [
    { fotoProfil: "/Study-Tube/assets/foto_profil.jpg", nama: "Muhammad Farhad Ajilla", status: 0 },
    { fotoProfil: "/Study-Tube/assets/foto_profil.jpg", nama: "Ajil", status: 0 },
    { fotoProfil: "/Study-Tube/assets/foto_profil.jpg", nama: "Ajil", status: 0 },
    { fotoProfil: "/Study-Tube/assets/foto_profil.jpg", nama: "Ajil", status: 1 },
    { fotoProfil: "/Study-Tube/assets/foto_profil.jpg", nama: "Ajil", status: 1 },
    { fotoProfil: "/Study-Tube/assets/foto_profil.jpg", nama: "Ajil", status: 0 },
    { fotoProfil: "/Study-Tube/assets/foto_profil.jpg", nama: "Ajil", status: 0 },
    { fotoProfil: "/Study-Tube/assets/foto_profil.jpg", nama: "Ajil", status: 0 },
    { fotoProfil: "/Study-Tube/assets/foto_profil.jpg", nama: "Ajil", status: 1 }
];

const chat_diskusi = {
    fotoProfil: "/Study-Tube/assets/foto_profil.jpg", nama: "Muhammad Farhad Ajilla", sekolah: 0
};

// Menggunakan forEach untuk iterasi array
diskusi.forEach(item => diskusiHTML(item.fotoProfil, item.nama, item.pesan));
req_diskusi.forEach(item => req_diskusiHTML(item.fotoProfil, item.nama, item.status));

function diskusiHTML(fotoProfil, nama, pesan) {
    const diskusi = document.getElementById('discussion');
    
    // Membuat HTML card dengan template literal
    const card = `
        <div class="flex rounded-lg ring-1 ring-gray-200 space-x-5 p-2 items-center overflow-hidden">
            <div class="flex-shrink-0 overflow-hidden w-[50px] h-[50px] rounded-full bg-white items-center">
                <div class="mx-auto">
                    <img src="${fotoProfil}">
                </div>
            </div>
            <div class="font-roboto text-ellipsis text-sm">
                <h1 class="font-semibold line-clamp-1">${nama}</h1> 
                <h1 class="font-normal line-clamp-1">${pesan}</h1>
            </div>
        </div>
    `;
    
    // Menambahkan card ke dalam container
    diskusi.innerHTML += card;
}

function req_diskusiHTML(fotoProfil, nama, status) {
    const req_diskusi = document.getElementById('req_discussion');

        
    // Menentukan warna kotak berdasarkan status
    let statusText = "";
    let statusClass = "";

    if (status === 0) {
        statusText = "pending";
        statusClass = "bg-gray-400";  // Kotak abu-abu untuk pending
    } else if (status === 1) {
        statusText = "ditolak";
        statusClass = "bg-red-600";  // Kotak merah untuk ditolak
    }
    
    // Membuat HTML card dengan template literal
    const card = `
        <div class="flex rounded-lg ring-1 ring-gray-200 space-x-5 p-2 items-center overflow-hidden">
            <div class="flex-shrink-0 overflow-hidden w-[50px] h-[50px] rounded-full bg-white items-center">
                <div class="mx-auto">
                    <img src="${fotoProfil}">
                </div>
            </div>
            <div class="font-roboto text-ellipsis text-sm">
                <h1 class="font-semibold line-clamp-1">${nama}</h1>
                <h1 class="font-semibold ${statusClass} p-1 px-3 rounded-md text-white inline-block mt-1">${statusText}</h1>
            </div>
        </div>
    `;
    
    // Menambahkan card ke dalam container
    req_diskusi.innerHTML += card;
}

document.addEventListener("DOMContentLoaded", function () {
    const discussion = document.getElementById("message");
    discussion.scrollTop = discussion.scrollHeight;
});