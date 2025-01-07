const riwayat = [
    { pembayaran: "Top Up", tanggal: "21 Nov 2024", koin: "+65", metode: "Gopay", kode: 239826},
    { pembayaran: "Modul", tanggal: "21 Nov 2024", koin: "-65", metode: "Bank", kode: 215436},
    { pembayaran: "Video", tanggal: "21 Nov 2024", koin: "-65", metode: "ShopeePay", kode: 134141},
    { pembayaran: "Diskusi", tanggal: "21 Nov 2024", koin: "-65", metode: "Dana", kode: 239836},
    { pembayaran: "Top Up", tanggal: "21 Nov 2024", koin: "+65", metode: "Gopay", kode: 311432},
];

// Menggunakan forEach untuk iterasi array
riwayat.forEach(item => notifikasiHTML(item.pembayaran, item.tanggal, item.koin, item.metode, item.kode));

function notifikasiHTML(pembayaran, tanggal, koin, metode, kode) {
    const riwayat = document.getElementById('list-riwayat');
    
    // Membuat HTML card dengan template literal
    const card = `
        <li id="riwayat"
            class="flex flex-auto rounded-lg ring-1 ring-gray-200 w-full py-2 px-3">
                <div class="flex-auto flex-col">
                    <h1 class="font-roboto font-normal text-gray">kode pembayaran:</h1>
                    <h1 class="font-roboto font-bold text-lg">${pembayaran}</h1>
                    <h1 class="font-roboto font-normal">${tanggal}</h1>
                </div>
                <div class="flex flex-col text-right">
                    <h1 class="font-roboto font-normal text-gray">#${kode}</h1>
                    <h1 class="font-roboto font-bold text-lg text-[#40BA6A]">${koin} Koin</h1>
                    <h1 class="font-roboto font-normal">${metode}</h1>
                </div>
        </li>
    `;
    
    // Menambahkan card ke dalam container
    riwayat.innerHTML += card;
}


function openModal(pembayaran, tanggal, koin, metode) {
    // Perbarui konten modal dengan data dinamis
    document.getElementById("modal-title").innerText = pembayaran;
    document.getElementById("modal-content").innerHTML = `
        <p><strong>Tanggal:</strong> ${tanggal}</p>
        <p><strong>Koin:</strong> ${koin}</p>
        <p><strong>Metode:</strong> ${metode}</p>
    `;
    // Tampilkan modal
    document.getElementById("modal").classList.remove("hidden");
    document.getElementById("modal").classList.remove("flex");
}

function closeModal() {
    document.getElementById('modal').classList.add('hidden');
}

/*
    <li id="riwayat"
        class="flex flex-auto rounded-lg ring-1 ring-gray-200 w-full py-2 px-3 cursor-pointer"
        onclick="openModal('${pembayaran}', '${tanggal}', '${koin}', '${metode}')">
            <div class="flex-auto flex-col">
                <h1 class="font-roboto font-normal text-gray">Kode Pembayaran: #${kode}</h1>
                <h1 class="font-roboto font-bold text-lg">${pembayaran}</h1>
                <h1 class="font-roboto font-normal">${tanggal}</h1>
            </div>
            <div class="flex flex-col text-right justify-end">
                <h1 class="font-roboto font-bold text-lg text-[#40BA6A]">${koin} Koin</h1>
                <h1 class="font-roboto font-normal">${metode}</h1>
            </div>
    </li>
*/