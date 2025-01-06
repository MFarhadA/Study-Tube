let scrollPosition = 0;

// Sidebar
fetch('/Study-Tube/siswa/sidebar/sidebar.php')
    .then(response => response.json())
    .then(data => {
        const profilePhoto = data.profile_photo;
        const userName = data.name;

        const sidebar = document.getElementById('sidebar');
        const sidebarHTML = `
            <div class="absolute w-full h-[70px] bg-[#40BA6A] bg-fixed"></div>
            <div class="flex flex-col justify-between p-1 h-screen">
                <div class="flex-none sidebar-content mt-[20px]">
                    <div class="flex flex-column space-y-2">
                        <!-- Foto Profil -->
                        <div class="overflow-hidden w-[60px] h-[60px] rounded-full bg-white items-center z-1">
                            <div class="mx-auto">
                                <img id="profilePhoto" src="${profilePhoto}">
                            </div>
                        </div>
                        <h1 id="userName" class="font-poppins text-xl text-white">${userName}</h1>
                        <button type="button" onclick="location='/Study-Tube/siswa/edit_profil/index.php'"
                            class="px-3 w-max text-[#40BA6A] bg-white font-semibold text-xl rounded-[10px] font-poppins transition-transform transform hover:scale-110">
                            Edit Profil
                        </button>
                    </div>
                </div>
                
                <div class="flex overflow-y-auto overflow-hidden sidebar-content justify-center mx-1">
                    <ul class="nav flex-wrap space-y-2 mb-5">
                        <button onclick="location='/Study-Tube/siswa/index.php'" class="px-4 py-2 w-[200px] nav-item flex space-x-3 bg-[#40BA6A] rounded-[10px] transition-transform transform hover:scale-110">
                            <svg width="34" height="34" viewBox="0 0 34 34" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M2 17L17 2L32 17M5.75 14.1875V30.125C5.75 30.6223 5.94754 31.0992 6.29918 31.4508C6.65081 31.8025 7.12772 32 7.625 32H13.25V26.375C13.25 25.8777 13.4475 25.4008 13.7992 25.0492C14.1508 24.6975 14.6277 24.5 15.125 24.5H18.875C19.3723 24.5 19.8492 24.6975 20.2008 25.0492C20.5525 25.4008 20.75 25.8777 20.75 26.375V32H26.375C26.8723 32 27.3492 31.8025 27.7008 31.4508C28.0525 31.0992 28.25 30.6223 28.25 30.125V14.1875" stroke="white" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            <a class="active font-poppins text-xl mt-1" href="#">Beranda</a>
                        </button>
                        <button onclick="location='/Study-Tube/siswa/diskusi/index.php'" class="px-4 py-2 w-[200px] nav-item flex space-x-3 bg-[#40BA6A] rounded-[10px] transition-transform transform hover:scale-110">
                            <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M4.65804 24.3462C4.73814 24.0513 4.56112 23.6414 4.39218 23.346C4.33956 23.2579 4.2825 23.1725 4.22122 23.0902C2.77223 20.8928 1.99993 18.3185 2.00007 15.6863C1.97651 8.13106 8.24149 2 15.9886 2C22.7449 2 28.3846 6.68058 29.7025 12.8938C29.9 13.8149 29.9997 14.7543 30 15.6964C30 23.2625 23.9767 29.4898 16.2296 29.4898C14.9978 29.4898 13.3353 29.1802 12.4287 28.9264C11.5221 28.6727 10.6168 28.3362 10.3832 28.246C10.1443 28.1542 9.89067 28.1069 9.63476 28.1066C9.35524 28.1056 9.07841 28.1612 8.82101 28.2702L4.25554 29.9179C4.15552 29.961 4.04954 29.9887 3.94122 30C3.85573 29.9997 3.77115 29.9825 3.69237 29.9493C3.61359 29.9162 3.54217 29.8677 3.48226 29.8067C3.42235 29.7457 3.37514 29.6735 3.34335 29.5941C3.31156 29.5148 3.29584 29.4299 3.29708 29.3444C3.30277 29.2694 3.31631 29.1952 3.33747 29.123L4.65804 24.3462Z" stroke="white" stroke-width="4" stroke-miterlimit="10" stroke-linecap="round"/>
                            </svg>
                            <a class="active font-poppins text-xl" href="#">Diskusi</a>
                        </button>
                        <button onclick="location='/Study-Tube/siswa/notifikasi/index.php'" class="px-4 py-2 w-[200px] nav-item flex space-x-3 bg-[#40BA6A] rounded-[10px] transition-transform transform hover:scale-110">
                            <svg width="30" height="34" viewBox="0 0 30 34" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M11.8192 32H18.1808M26.0279 21.833C25.5534 21.06 25.3015 20.1666 25.3011 19.2547V12.5027C25.3011 9.71719 24.2158 7.0458 22.284 5.07616C20.3521 3.10653 17.732 2 15 2C12.268 2 9.64787 3.10653 7.71604 5.07616C5.78421 7.0458 4.69893 9.71719 4.69893 12.5027V19.2515C4.69905 20.1645 4.44718 21.0591 3.97211 21.833L2.24175 24.6544C2.09128 24.8999 2.008 25.1819 2.00055 25.4713C1.9931 25.7607 2.06175 26.0468 2.19937 26.2999C2.33699 26.5531 2.53858 26.7641 2.78319 26.911C3.0278 27.0579 3.30652 27.1354 3.59041 27.1354H26.4096C26.6935 27.1354 26.9722 27.0579 27.2168 26.911C27.4614 26.7641 27.663 26.5531 27.8006 26.2999C27.9383 26.0468 28.0069 25.7607 27.9995 25.4713C27.992 25.1819 27.9087 24.8999 27.7583 24.6544L26.0279 21.833Z" stroke="white" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            <a class="active font-poppins text-xl" href="#">Notifikasi</a>
                        </button>
                        <button onclick="location='/Study-Tube/siswa/koin/index.php'" class="px-4 py-2 w-[200px] nav-item flex space-x-3 bg-[#40BA6A] rounded-[10px] transition-transform transform hover:scale-110">
                            <svg width="37" height="35" viewBox="0 0 37 35" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M19.0363 13.6894C19.6711 14.2217 20.6172 14.1386 21.1494 13.5037C21.6817 12.8689 21.5986 11.9228 20.9637 11.3906L19.0363 13.6894ZM16.625 11.3L16.6275 9.8H16.625V11.3ZM20.9562 23.6157C21.5945 23.0877 21.6838 22.1421 21.1557 21.5038C20.6277 20.8655 19.6821 20.7762 19.0438 21.3043L20.9562 23.6157ZM0.5 17.5C0.5 26.7676 7.43527 34.5 16.25 34.5V31.5C9.32461 31.5 3.5 25.3532 3.5 17.5H0.5ZM16.25 34.5C25.0647 34.5 32 26.7676 32 17.5H29C29 25.3532 23.1754 31.5 16.25 31.5V34.5ZM32 17.5C32 8.23239 25.0647 0.5 16.25 0.5V3.5C23.1754 3.5 29 9.64678 29 17.5H32ZM16.25 0.5C7.43527 0.5 0.5 8.23239 0.5 17.5H3.5C3.5 9.64678 9.32461 3.5 16.25 3.5V0.5ZM20.9637 11.3906C19.7437 10.3677 18.2134 9.80259 16.6275 9.8L16.6225 12.8C17.495 12.8014 18.3473 13.1118 19.0363 13.6894L20.9637 11.3906ZM16.625 9.8C12.5563 9.8 9.5 13.3865 9.5 17.5H12.5C12.5 14.7625 14.4807 12.8 16.625 12.8V9.8ZM9.5 17.5C9.5 21.6135 12.5563 25.2 16.625 25.2V22.2C14.4807 22.2 12.5 20.2375 12.5 17.5H9.5ZM16.625 25.2C18.2668 25.2 19.7681 24.5987 20.9562 23.6157L19.0438 21.3043C18.3509 21.8775 17.5152 22.2 16.625 22.2V25.2ZM15.5 3.5C18.6791 3.5 23.256 3.88794 26.9905 5.84706C28.8341 6.81423 30.4426 8.1488 31.5961 9.98947C32.7468 11.8259 33.5 14.254 33.5 17.5H36.5C36.5 13.771 35.6281 10.7741 34.1382 8.39647C32.6509 6.02307 30.6031 4.35452 28.3842 3.19044C23.9935 0.887064 18.8204 0.5 15.5 0.5V3.5ZM33.5 17.5C33.5 20.746 32.7468 23.1741 31.5961 25.0105C30.4426 26.8512 28.8341 28.1858 26.9905 29.1529C23.256 31.1121 18.6791 31.5 15.5 31.5V34.5C18.8204 34.5 23.9935 34.1129 28.3842 31.8096C30.6031 30.6455 32.6509 28.9769 34.1382 26.6035C35.6281 24.2259 36.5 21.229 36.5 17.5H33.5Z" fill="white"/>
                            </svg>
                            <a class="active font-poppins text-xl" href="#">Koin</a>
                        </button>
                    </ul>
                </div>

                <div class="flex-none sidebar-content bottom-0 mx-1 mt-2">
                    <button onclick="showBantuan()" class="px-4 py-2 w-[200px] nav-item flex space-x-3 bg-[#40BA6A] rounded-[10px] transition-transform transform hover:scale-110">
                        <svg width="31" height="31" viewBox="0 0 31 31" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M29 23.3344V15.5C29 11.9196 27.5777 8.4858 25.0459 5.95406C22.5142 3.42232 19.0804 2 15.5 2C11.9196 2 8.4858 3.42232 5.95406 5.95406C3.42232 8.4858 2 11.9196 2 15.5V23.3344M2 17.4279H7.83784C8.41845 17.4279 8.97528 17.6586 9.38583 18.0691C9.79638 18.4797 10.027 19.0365 10.027 19.6171V26.0811C10.027 26.8552 9.7195 27.5977 9.1721 28.1451C8.62469 28.6925 7.88225 29 7.10811 29H4.91892C4.14477 29 3.40233 28.6925 2.85493 28.1451C2.30753 27.5977 2 26.8552 2 26.0811V17.4279ZM20.973 19.6171C20.973 19.0365 21.2036 18.4797 21.6142 18.0691C22.0247 17.6586 22.5816 17.4279 23.1622 17.4279H29V26.0811C29 26.8552 28.6925 27.5977 28.1451 28.1451C27.5977 28.6925 26.8552 29 26.0811 29H23.8919C23.1177 29 22.3753 28.6925 21.8279 28.1451C21.2805 27.5977 20.973 26.8552 20.973 26.0811V19.6171Z" stroke="white" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>             
                        <a class="active font-poppins text-xl" href="#">Bantuan</a>
                    </button>
                    <button type="button" onclick="location='/Study-Tube/login/index.html'"
                            class="py-2 px-6 w-[200px] text-white font-semibold text-xl rounded-[15px] bg-[#D9534F] font-poppins transition-transform transform hover:scale-110 my-2">
                            Keluar
                    </button>
                </div>
            </div>
        `;
        sidebar.innerHTML += sidebarHTML;
    }
)
.catch(error => console.error("Error loading user data:", error));

    // Function untuk menampilkan popup
    function showBantuan() {
        // Cek jika popup sudah ada di DOM
        if (document.getElementById('popup')) return;

        scrollPosition = window.scrollY;

        // Buat elemen overlay (background gelap)
        document.body.style.overflow = 'hidden';
        document.body.style.position = 'fixed';
        document.body.style.top = `-${scrollPosition}px`;
        document.body.style.width = '100%';

        const popupOverlay = document.createElement('div');
        popupOverlay.id = 'popup';
        popupOverlay.className = 'fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50';

        // Buat kontainer popup
        const popupContent = document.createElement('div');
        popupContent.className = 'bg-[#40BA6A] px-5 py-4 rounded-lg text-center';

        // Tambahkan HTML konten ke dalam popup
        popupContent.innerHTML = `
            <h2 class="text-[#40BA6A] font-poppins font-semibold text-2xl mb-3 inline-block py-1 px-3 bg-white rounded-lg">BUTUH BANTUAN ?</h2>
            <p class="text-white font-poppins font-semibold text-2xl mb-3">Call Center</p>
            <div class="flex flex-auto justify-center">
                <div class="flex flex-col space-y-4 justify-center">
                    <svg width="35" height="35" viewBox="0 0 35 35" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M29.9007 5.08601C28.2828 3.46731 26.3607 2.18462 24.2451 1.31176C22.1294 0.4389 19.862 -0.00688 17.5734 8.02651e-05C7.96874 8.02651e-05 0.15 7.77975 0.146093 17.3438C0.141807 20.3892 0.94457 23.3814 2.47265 26.0156L0 35L9.23827 32.5883C11.7954 33.9737 14.658 34.6988 17.5664 34.6977H17.5734C27.1773 34.6977 34.9953 26.9172 34.9999 17.3539C35.0058 15.0731 34.5579 12.8139 33.6825 10.7078C32.8071 8.60169 31.5216 6.69069 29.9007 5.08601ZM17.5734 31.7703H17.5672C14.9745 31.7711 12.429 31.0772 10.1953 29.761L9.66639 29.4485L4.18437 30.8797L5.64765 25.5602L5.30312 25.0133C3.85342 22.7181 3.08535 20.0585 3.08828 17.3438C3.08828 9.39615 9.58905 2.92976 17.5789 2.92976C21.4117 2.92292 25.0902 4.43877 27.8055 7.14391C30.5208 9.84905 32.0503 13.5219 32.0578 17.3547C32.0546 25.3031 25.557 31.7703 17.5734 31.7703ZM25.5179 20.9743C25.0828 20.7571 22.9398 19.7086 22.5429 19.5641C22.1461 19.4196 21.8531 19.3469 21.5632 19.7813C21.2734 20.2157 20.4382 21.1875 20.1843 21.4805C19.9304 21.7735 19.6765 21.8055 19.2414 21.5883C18.8062 21.3711 17.4023 20.9141 15.739 19.4375C14.4445 18.2883 13.5711 16.8696 13.3172 16.436C13.0633 16.0024 13.2898 15.7672 13.5078 15.5516C13.7039 15.3571 13.9429 15.0454 14.1609 14.7922C14.3789 14.5391 14.4515 14.3579 14.5961 14.0688C14.7406 13.7797 14.6687 13.5266 14.5601 13.3102C14.4515 13.0938 13.5804 10.9602 13.2179 10.0922C12.864 9.24693 12.5054 9.36178 12.2383 9.3485C11.9844 9.336 11.6914 9.33287 11.4031 9.33287C11.1827 9.33861 10.9659 9.38972 10.7661 9.483C10.5664 9.57629 10.388 9.70975 10.2422 9.87506C9.84295 10.3094 8.71796 11.3594 8.71796 13.4907C8.71796 15.6219 10.2805 17.6844 10.4961 17.9735C10.7117 18.2625 13.5664 22.6399 17.9343 24.5172C18.7454 24.8646 19.5742 25.1692 20.4172 25.4297C21.4601 25.7594 22.4093 25.7133 23.1593 25.6016C23.9961 25.4774 25.7375 24.5532 26.0992 23.5407C26.4609 22.5282 26.4617 21.661 26.3531 21.4805C26.2445 21.3 25.9539 21.1907 25.5179 20.9743Z" fill="white"/>
                    </svg>
                    <svg width="35" height="27" viewBox="0 0 35 27" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M30.625 0H4.375C3.21506 0.00121824 2.10298 0.454165 1.28278 1.25946C0.462576 2.06475 0.0012408 3.1566 0 4.29545V22.7045C0.0012408 23.8434 0.462576 24.9353 1.28278 25.7405C2.10298 26.5458 3.21506 26.9988 4.375 27H30.625C31.7849 26.9988 32.897 26.5458 33.7172 25.7405C34.5374 24.9353 34.9988 23.8434 35 22.7045V4.29545C34.9988 3.1566 34.5374 2.06475 33.7172 1.25946C32.897 0.454165 31.7849 0.00121824 30.625 0ZM29.5172 7.10514L18.2672 15.6961C18.0478 15.8635 17.7779 15.9544 17.5 15.9544C17.2221 15.9544 16.9522 15.8635 16.7328 15.6961L5.48281 7.10514C5.35064 7.00714 5.23961 6.88432 5.1562 6.74383C5.07278 6.60334 5.01864 6.44797 4.99691 6.28675C4.97519 6.12554 4.98631 5.96169 5.02964 5.80473C5.07296 5.64777 5.14763 5.50083 5.2493 5.37245C5.35096 5.24407 5.4776 5.1368 5.62186 5.05689C5.76611 4.97698 5.92511 4.92601 6.0896 4.90695C6.25409 4.88789 6.4208 4.90111 6.58004 4.94586C6.73928 4.9906 6.88787 5.06597 7.01719 5.16758L17.5 13.1725L27.9828 5.16758C28.2449 4.97323 28.5744 4.88799 28.9001 4.9303C29.2257 4.9726 29.5213 5.13905 29.7229 5.39365C29.9245 5.64825 30.016 5.97054 29.9775 6.29082C29.939 6.6111 29.7736 6.90362 29.5172 7.10514Z" fill="white"/>
                    </svg>
                </div>
                <div class="flex flex-col space-y-4 mt-2 ml-5">
                    <p class="text-white font-poppins font-normal text-left">082121212167</p>
                    <p class="text-white font-poppins font-normal text-left">mfarhadainc@gmail.com</p>
                </div>
            </div>
            <button id="closePopupBtn" class="bg-[#D9534F] font-poppins text-white w-full py-2 rounded-lg mt-3 transition-transform transform hover:scale-110">kembali</button>
            
        `;

        // Tambahkan popup ke dalam overlay
        popupOverlay.appendChild(popupContent);

        // Tambahkan overlay ke dalam body
        document.body.appendChild(popupOverlay);

        // Event listener untuk tombol "kembali"
        document.getElementById('closePopupBtn').addEventListener('click', closePopup);
    }

    function closePopup() {
        const popup = document.getElementById('popup');
        if (popup) {
            popup.remove(); // Hapus popup dari DOM
            
            // Kembalikan scroll dan posisi halaman
            document.body.style.overflow = '';
            document.body.style.position = '';
            document.body.style.top = '';
            document.body.style.width = '';

            // Kembalikan scroll ke posisi sebelumnya
            window.scrollTo(0, scrollPosition);
        }
    }
    


    document.getElementById('toggleSidebar').addEventListener('click', function() {
    document.getElementById('sidebar').classList.toggle('collapsed-sidebar');
    document.getElementById('mainContent').classList.toggle('collapsed-content');
    });
