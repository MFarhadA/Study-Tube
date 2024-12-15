const sidebar = document.getElementById('sidebar');
const sidebarHTML = `
  <div class="absolute w-full h-[70px] bg-[#40BA6A] bg-fixed">
    <div class="p-1">
        <div class="sidebar-content my-[20px]">
            <div class="flex flex-column space-y-2">
                <!-- Foto Profil -->
                <div class="overflow-hidden w-[60px] h-[60px] rounded-full bg-white items-center z-10">
                    <div class="mx-auto">
                        <img src="/assets/foto_profil.jpg">
                    </div>
                </div>
                <h1 class="font-poppins text-xl text-white">Muhammad Farhad Ajilla</h1>
                <button type="button" onclick="location='/siswa/profil/index.html'"
                    class="px-3 w-max text-[#40BA6A] bg-white font-semibold text-xl rounded-[10px] font-poppins transition-transform transform hover:scale-110">
                    Edit Profil
                </button>
            </div>
        </div>
        
        <div class="fixed sidebar-content items-center mx-1">
            <ul class="nav flex-column space-y-2">
                <button onclick="location='/siswa/index.html'" class="px-4 py-2 w-[200px] nav-item flex space-x-3 bg-[#40BA6A] rounded-[10px] transition-transform transform hover:scale-110">
                    <svg width="34" height="34" viewBox="0 0 34 34" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M2 17L17 2L32 17M5.75 14.1875V30.125C5.75 30.6223 5.94754 31.0992 6.29918 31.4508C6.65081 31.8025 7.12772 32 7.625 32H13.25V26.375C13.25 25.8777 13.4475 25.4008 13.7992 25.0492C14.1508 24.6975 14.6277 24.5 15.125 24.5H18.875C19.3723 24.5 19.8492 24.6975 20.2008 25.0492C20.5525 25.4008 20.75 25.8777 20.75 26.375V32H26.375C26.8723 32 27.3492 31.8025 27.7008 31.4508C28.0525 31.0992 28.25 30.6223 28.25 30.125V14.1875" stroke="white" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    <a class="active font-poppins text-xl mt-1" href="#">Beranda</a>
                </button>
                <button onclick="location='/siswa/diskusi/index.html'" class="px-4 py-2 w-[200px] nav-item flex space-x-3 bg-[#40BA6A] rounded-[10px] transition-transform transform hover:scale-110">
                    <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M4.65804 24.3462C4.73814 24.0513 4.56112 23.6414 4.39218 23.346C4.33956 23.2579 4.2825 23.1725 4.22122 23.0902C2.77223 20.8928 1.99993 18.3185 2.00007 15.6863C1.97651 8.13106 8.24149 2 15.9886 2C22.7449 2 28.3846 6.68058 29.7025 12.8938C29.9 13.8149 29.9997 14.7543 30 15.6964C30 23.2625 23.9767 29.4898 16.2296 29.4898C14.9978 29.4898 13.3353 29.1802 12.4287 28.9264C11.5221 28.6727 10.6168 28.3362 10.3832 28.246C10.1443 28.1542 9.89067 28.1069 9.63476 28.1066C9.35524 28.1056 9.07841 28.1612 8.82101 28.2702L4.25554 29.9179C4.15552 29.961 4.04954 29.9887 3.94122 30C3.85573 29.9997 3.77115 29.9825 3.69237 29.9493C3.61359 29.9162 3.54217 29.8677 3.48226 29.8067C3.42235 29.7457 3.37514 29.6735 3.34335 29.5941C3.31156 29.5148 3.29584 29.4299 3.29708 29.3444C3.30277 29.2694 3.31631 29.1952 3.33747 29.123L4.65804 24.3462Z" stroke="white" stroke-width="4" stroke-miterlimit="10" stroke-linecap="round"/>
                    </svg>
                    <a class="active font-poppins text-xl" href="#">Diskusi</a>
                </button>
                <button onclick="location='/siswa/notifikasi/index.html'" class="px-4 py-2 w-[200px] nav-item flex space-x-3 bg-[#40BA6A] rounded-[10px] transition-transform transform hover:scale-110">
                    <svg width="30" height="34" viewBox="0 0 30 34" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M11.8192 32H18.1808M26.0279 21.833C25.5534 21.06 25.3015 20.1666 25.3011 19.2547V12.5027C25.3011 9.71719 24.2158 7.0458 22.284 5.07616C20.3521 3.10653 17.732 2 15 2C12.268 2 9.64787 3.10653 7.71604 5.07616C5.78421 7.0458 4.69893 9.71719 4.69893 12.5027V19.2515C4.69905 20.1645 4.44718 21.0591 3.97211 21.833L2.24175 24.6544C2.09128 24.8999 2.008 25.1819 2.00055 25.4713C1.9931 25.7607 2.06175 26.0468 2.19937 26.2999C2.33699 26.5531 2.53858 26.7641 2.78319 26.911C3.0278 27.0579 3.30652 27.1354 3.59041 27.1354H26.4096C26.6935 27.1354 26.9722 27.0579 27.2168 26.911C27.4614 26.7641 27.663 26.5531 27.8006 26.2999C27.9383 26.0468 28.0069 25.7607 27.9995 25.4713C27.992 25.1819 27.9087 24.8999 27.7583 24.6544L26.0279 21.833Z" stroke="white" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    <a class="active font-poppins text-xl" href="#">Notifikasi</a>
                </button>
                <button onclick="location='/siswa/koin/index.html'" class="px-4 py-2 w-[200px] nav-item flex space-x-3 bg-[#40BA6A] rounded-[10px] transition-transform transform hover:scale-110">
                    <svg width="37" height="35" viewBox="0 0 37 35" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M19.0363 13.6894C19.6711 14.2217 20.6172 14.1386 21.1494 13.5037C21.6817 12.8689 21.5986 11.9228 20.9637 11.3906L19.0363 13.6894ZM16.625 11.3L16.6275 9.8H16.625V11.3ZM20.9562 23.6157C21.5945 23.0877 21.6838 22.1421 21.1557 21.5038C20.6277 20.8655 19.6821 20.7762 19.0438 21.3043L20.9562 23.6157ZM0.5 17.5C0.5 26.7676 7.43527 34.5 16.25 34.5V31.5C9.32461 31.5 3.5 25.3532 3.5 17.5H0.5ZM16.25 34.5C25.0647 34.5 32 26.7676 32 17.5H29C29 25.3532 23.1754 31.5 16.25 31.5V34.5ZM32 17.5C32 8.23239 25.0647 0.5 16.25 0.5V3.5C23.1754 3.5 29 9.64678 29 17.5H32ZM16.25 0.5C7.43527 0.5 0.5 8.23239 0.5 17.5H3.5C3.5 9.64678 9.32461 3.5 16.25 3.5V0.5ZM20.9637 11.3906C19.7437 10.3677 18.2134 9.80259 16.6275 9.8L16.6225 12.8C17.495 12.8014 18.3473 13.1118 19.0363 13.6894L20.9637 11.3906ZM16.625 9.8C12.5563 9.8 9.5 13.3865 9.5 17.5H12.5C12.5 14.7625 14.4807 12.8 16.625 12.8V9.8ZM9.5 17.5C9.5 21.6135 12.5563 25.2 16.625 25.2V22.2C14.4807 22.2 12.5 20.2375 12.5 17.5H9.5ZM16.625 25.2C18.2668 25.2 19.7681 24.5987 20.9562 23.6157L19.0438 21.3043C18.3509 21.8775 17.5152 22.2 16.625 22.2V25.2ZM15.5 3.5C18.6791 3.5 23.256 3.88794 26.9905 5.84706C28.8341 6.81423 30.4426 8.1488 31.5961 9.98947C32.7468 11.8259 33.5 14.254 33.5 17.5H36.5C36.5 13.771 35.6281 10.7741 34.1382 8.39647C32.6509 6.02307 30.6031 4.35452 28.3842 3.19044C23.9935 0.887064 18.8204 0.5 15.5 0.5V3.5ZM33.5 17.5C33.5 20.746 32.7468 23.1741 31.5961 25.0105C30.4426 26.8512 28.8341 28.1858 26.9905 29.1529C23.256 31.1121 18.6791 31.5 15.5 31.5V34.5C18.8204 34.5 23.9935 34.1129 28.3842 31.8096C30.6031 30.6455 32.6509 28.9769 34.1382 26.6035C35.6281 24.2259 36.5 21.229 36.5 17.5H33.5Z" fill="white"/>
                    </svg>
                    <a class="active font-poppins text-xl" href="#">Koin</a>
                </button>
            </ul>
        </div>

        <div class="fixed sidebar-content bottom-0 mx-1">
            <button onclick="location='/login/index.html'" class="px-4 py-2 w-[200px] nav-item flex space-x-3 bg-[#40BA6A] rounded-[10px] transition-transform transform hover:scale-110">
                <svg width="31" height="31" viewBox="0 0 31 31" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M29 23.3344V15.5C29 11.9196 27.5777 8.4858 25.0459 5.95406C22.5142 3.42232 19.0804 2 15.5 2C11.9196 2 8.4858 3.42232 5.95406 5.95406C3.42232 8.4858 2 11.9196 2 15.5V23.3344M2 17.4279H7.83784C8.41845 17.4279 8.97528 17.6586 9.38583 18.0691C9.79638 18.4797 10.027 19.0365 10.027 19.6171V26.0811C10.027 26.8552 9.7195 27.5977 9.1721 28.1451C8.62469 28.6925 7.88225 29 7.10811 29H4.91892C4.14477 29 3.40233 28.6925 2.85493 28.1451C2.30753 27.5977 2 26.8552 2 26.0811V17.4279ZM20.973 19.6171C20.973 19.0365 21.2036 18.4797 21.6142 18.0691C22.0247 17.6586 22.5816 17.4279 23.1622 17.4279H29V26.0811C29 26.8552 28.6925 27.5977 28.1451 28.1451C27.5977 28.6925 26.8552 29 26.0811 29H23.8919C23.1177 29 22.3753 28.6925 21.8279 28.1451C21.2805 27.5977 20.973 26.8552 20.973 26.0811V19.6171Z" stroke="white" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>             
                <a class="active font-poppins text-xl" href="#">Bantuan</a>
            </button>
            <button type="button" onclick="location='/login/index.html'"
                    class="py-2 px-6 w-[200px] text-white font-semibold text-xl rounded-[15px] bg-[#D9534F] font-poppins transition-transform transform hover:scale-110 my-2">
                    Keluar
            </button>
        </div>
    </div>
  `;
  sidebar.innerHTML += sidebarHTML;

document.getElementById('toggleSidebar').addEventListener('click', function() {
document.getElementById('sidebar').classList.toggle('collapsed-sidebar');
document.getElementById('mainContent').classList.toggle('collapsed-content');
});