<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Koin | Study Tube</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="/Study-Tube/siswa/style.css">
</head>
<body>

    <!-- Sidebar -->
    <div id="sidebar" class="fixed top-0 left-0 h-screen bg-[#40BA6A] z-0">
    </div>

    <!-- Main Content Area -->
    <div id="mainContent" class="main-content">
        
        <!-- Navbar -->
        <div class="fixed top-0 w-full bg-white shadow-sm">
            <div class="flex items-center space-x-5 p-2">
                <!-- Sidebar Button -->
                <button id="toggleSidebar" class="btn rounded-lg ring-1 ring-gray-400 bg-white">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="black" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                    </svg>
                </button>
                <h1 class="font-poppins font-extrabold text-[#40BA6A] text-xl my-auto">Koin</h1>
            </div>
        </div>
        
        <!-- Content -->
        <div class="container mt-12 p-3">
            <div class="flex flex-row space-x-4">

                <!-- Kolom Kiri -->
                <div class="flex flex-auto col-rounded-shadow max-w-[35vh] h-[10vh] space-y-2">
                    <div class="flex p-2 px-3 w-[100vh] items-center space-x-3">
                        <svg width="37" height="35" viewBox="0 0 37 35" fill="#40BA6A" xmlns="http://www.w3.org/2000/svg">
                            <path d="M19.0363 13.6894C19.6711 14.2217 20.6172 14.1386 21.1494 13.5037C21.6817 12.8689 21.5986 11.9228 20.9637 11.3906L19.0363 13.6894ZM16.625 11.3L16.6275 9.8H16.625V11.3ZM20.9562 23.6157C21.5945 23.0877 21.6838 22.1421 21.1557 21.5038C20.6277 20.8655 19.6821 20.7762 19.0438 21.3043L20.9562 23.6157ZM0.5 17.5C0.5 26.7676 7.43527 34.5 16.25 34.5V31.5C9.32461 31.5 3.5 25.3532 3.5 17.5H0.5ZM16.25 34.5C25.0647 34.5 32 26.7676 32 17.5H29C29 25.3532 23.1754 31.5 16.25 31.5V34.5ZM32 17.5C32 8.23239 25.0647 0.5 16.25 0.5V3.5C23.1754 3.5 29 9.64678 29 17.5H32ZM16.25 0.5C7.43527 0.5 0.5 8.23239 0.5 17.5H3.5C3.5 9.64678 9.32461 3.5 16.25 3.5V0.5ZM20.9637 11.3906C19.7437 10.3677 18.2134 9.80259 16.6275 9.8L16.6225 12.8C17.495 12.8014 18.3473 13.1118 19.0363 13.6894L20.9637 11.3906ZM16.625 9.8C12.5563 9.8 9.5 13.3865 9.5 17.5H12.5C12.5 14.7625 14.4807 12.8 16.625 12.8V9.8ZM9.5 17.5C9.5 21.6135 12.5563 25.2 16.625 25.2V22.2C14.4807 22.2 12.5 20.2375 12.5 17.5H9.5ZM16.625 25.2C18.2668 25.2 19.7681 24.5987 20.9562 23.6157L19.0438 21.3043C18.3509 21.8775 17.5152 22.2 16.625 22.2V25.2ZM15.5 3.5C18.6791 3.5 23.256 3.88794 26.9905 5.84706C28.8341 6.81423 30.4426 8.1488 31.5961 9.98947C32.7468 11.8259 33.5 14.254 33.5 17.5H36.5C36.5 13.771 35.6281 10.7741 34.1382 8.39647C32.6509 6.02307 30.6031 4.35452 28.3842 3.19044C23.9935 0.887064 18.8204 0.5 15.5 0.5V3.5ZM33.5 17.5C33.5 20.746 32.7468 23.1741 31.5961 25.0105C30.4426 26.8512 28.8341 28.1858 26.9905 29.1529C23.256 31.1121 18.6791 31.5 15.5 31.5V34.5C18.8204 34.5 23.9935 34.1129 28.3842 31.8096C30.6031 30.6455 32.6509 28.9769 34.1382 26.6035C35.6281 24.2259 36.5 21.229 36.5 17.5H33.5Z"/>
                        </svg>
                        <div class="flex-col min-w-max">
                            <div class="font-poppins mx-auto -mb-1">Total Koin</div>
                            <div id="" class="font-roboto font-semibold text-4xl">60</div>
                        </div>
                        <div class="flex flex-auto justify-end h-[40px]">
                            <button type="button" onclick="location='/login/index.html'"
                                class="inline-block px-3 text-white font-semibold text-xl rounded-[15px] bg-[#40BA6A] font-poppins transition-transform transform hover:scale-110">
                                Top Up
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Kolom Kanan -->
                <div class="flex flex-auto h-[90vh]">
                    <div class="col-rounded-shadow p-2 px-3 max-h-[100vh] w-full">
                        <h1 class="font-poppins text-xl mx-auto line-clamp-1 p-2 mb-2">Riwayat Saldo</h1>
                        <div id="list-riwayat" class="space-y-2 overflow-auto h-[80vh] p-1">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
    </div>

    <!-- Modal -->
    <div id="modal" class="hidden fixed inset-0 z-50 bg-black bg-opacity-50 justify-center items-center">
        <div class="bg-white rounded-lg shadow-lg w-96 p-5">
            <h2 id="modal-title" class="font-roboto font-bold text-xl mb-4">Default Title</h2>
            <div id="modal-content" class="text-sm text-gray-600">
                Default Content
            </div>
            <button 
                class="mt-5 px-4 py-2 bg-[#40BA6A] text-white rounded-lg hover:bg-green-600"
                onclick="closeModal()">Tutup
            </button>
        </div>
    </div>

    <script src="/Study-Tube/siswa/sidebar/sidebar.js"></script>
    <script src="script.js"></script>

</body>
</html>