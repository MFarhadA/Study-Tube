const notifikasi = [
    { fotoProfil: "/assets/foto_profil.jpg", nama: "Ajil", konteks: "menyutujui diskusi dengan anda" },
    { fotoProfil: "/assets/foto_profil.jpg", nama: "Ajil", konteks: "menyutujui diskusi dengan anda" },
    { fotoProfil: "/assets/foto_profil.jpg", nama: "Ajil", konteks: "menyutujui diskusi dengan anda" },
    { fotoProfil: "/assets/foto_profil.jpg", nama: "Ajil", konteks: "menyutujui diskusi dengan anda" },
    { fotoProfil: "/assets/foto_profil.jpg", nama: "Ajil", konteks: "menyutujui diskusi dengan anda" },
    { fotoProfil: "/assets/foto_profil.jpg", nama: "Ajil", konteks: "menyutujui diskusi dengan anda" },
    { fotoProfil: "/assets/foto_profil.jpg", nama: "Ajil", konteks: "menyutujui diskusi dengan anda" },
    { fotoProfil: "/assets/foto_profil.jpg", nama: "Ajil", konteks: "menyutujui diskusi dengan anda" },
    { fotoProfil: "/assets/foto_profil.jpg", nama: "Ajil", konteks: "menyutujui diskusi dengan anda" }
];

// Menggunakan forEach untuk iterasi array
notifikasi.forEach(item => notifikasiHTML(item.fotoProfil, item.nama, item.konteks));

function notifikasiHTML(fotoProfil, nama, konteks) {
    const notifikasi = document.getElementById('notification');
    
    // Membuat HTML card dengan template literal
    const card = `
        <div class="flex rounded-lg ring-1 ring-gray-200 space-x-5 p-2 items-center">
            <div class="flex-shrink-0 overflow-hidden w-[60px] h-[60px] rounded-full bg-white items-center">
                <div class="mx-auto">
                    <img src="${fotoProfil}">
                </div>
            </div>
            <h1 class="font-roboto">
                <span class="font-semibold">${nama}</span> 
                <span class="font-normal">${konteks}</span>
            </h1>
        </div>
    `;
    
    // Menambahkan card ke dalam container
    notifikasi.innerHTML += card;
}
