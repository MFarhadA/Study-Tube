<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | Study Tube</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <!-- Sidebar -->
    <div id="sidebar" class="fixed top-0 left-0 h-screen bg-[#40BA6A]">
    </div>

    <!-- Main Content Area -->
    <div id="mainContent" class="main-content bg-white">
        
        <!-- Navbar -->
        <div class="fixed top-0 w-full bg-white z-50 shadow-sm">
            <div class="flex items-center space-x-5 p-2">
                <!-- Sidebar Button -->
                <button id="toggleSidebar" class="btn btn-secondary col-rounded bg-white">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="black" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                    </svg>
                </button>
                <h1 class="font-poppins font-extrabold text-[#40BA6A] text-xl my-auto">Dashboard</h1>
            </div>
        </div>
        
        <!-- Content -->
        <div class="container mt-12 p-3 my-min px-4 overflow-y-hidden">
            <div class="flex flex-row h-[90vh] space-x-4">

                <!-- Bagian Kiri -->
                <div class="flex-[2] flex flex-row space-x-4 w-full">

                    <!-- Pengikut -->
                    <div class="flex flex-auto">
                        <div class="col-rounded-shadow p-3 w-full">
                            <h1 class="font-poppins text-xl mx-auto line-clamp-1 mb-3">Pengikut</h1>
                            <div class="border-b-2 mt-2 mb-2"></div>
                            <p class="font-roboto font-normal text-lg mx-auto line-clamp-1">total pengikut</p>
                            <h1 class="font-poppins text-4xl mx-auto line-clamp-1">600</h1>
                            <div class="border-b-2 mt-2 mb-2"></div>
                            <p class="font-roboto font-normal text-lg mx-auto line-clamp-1 mb-2">list pengikut</p>
                            <div id="list-pengikut" class="flex flex-col space-y-3 overflow-auto max-h-[calc(100%-180px)] p-1">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 overflow-hidden w-[50px] h-[50px] rounded-full bg-white items-center mr-3">
                                        <div class="mx-auto">
                                            <img id="profilePhoto" src="/Study-Tube/assets/foto_profil.jpg">
                                        </div>
                                    </div>
                                    <p class="text-lg font-roboto font-normal line-clamp-1">Guru 1</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Rating -->
                    <div class="flex flex-auto">
                        <div class="col-rounded-shadow p-3 w-full">
                        <h1 class="font-poppins text-xl mx-auto line-clamp-1 mb-3">Rating</h1>
                            <div class="border-b-2 mt-2 mb-2"></div>
                            <p class="font-roboto font-normal text-lg mx-auto line-clamp-1">total rating</p>
                            <h1 class="font-poppins text-4xl mx-auto line-clamp-1">5.0</h1>
                            <div class="border-b-2 mt-2 mb-2"></div>
                            <p class="font-roboto font-normal text-lg mx-auto line-clamp-1">list rating</p>
                            <div id="list-rating" class="flex flex-col space-y-3 overflow-auto max-h-[calc(100%-180px)] p-1">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 overflow-hidden w-[50px] h-[50px] rounded-full bg-white items-center mr-3">
                                    <div class="mx-auto">
                                        <img id="profilePhoto" src="/Study-Tube/assets/foto_profil.jpg">
                                    </div>
                                </div>
                                <div class="flex flex-col text-left -space-y-2">
                                    <p class="text-lg font-roboto font-normal line-clamp-1">Guru 1</p>
                                    <div class="flex flex-row text-[#FFCC00]">
                                        <span>&#9733;</span>
                                        <span>&#9733;</span>
                                        <span>&#9733;</span>
                                        <span>&#9733;</span>
                                        <span class="text-gray-300">&#9733;</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Bagian Kanan -->
                <div class="flex-[3] flex flex-row space-x-4 w-full">

                    <!-- Video -->
                    <div class="flex flex-auto">
                        <div class="col-rounded-shadow p-2 px-3 w-full">
                            <h1 class="font-poppins text-xl mx-auto line-clamp-1 p-2 mb-2">Video</h1>
                            <div id="list-video" class="flex flex-col space-y-3 overflow-auto max-h-[calc(100%-180px)] p-1">
                            </div>
                        </div>
                    </div>

                    <!-- Modul -->
                    <div class="flex flex-auto">
                        <div class="col-rounded-shadow p-2 px-3 w-full">
                            <h1 class="font-poppins text-xl mx-auto line-clamp-1 p-2 mb-2">Modul</h1>
                            <div id="list-modul" class="flex flex-col space-y-3 overflow-auto max-h-[calc(100%-180px)] p-1">
                            </div>
                        </div>
                    </div>
                </div>
            
            </div>
        </div>

    
    </div>

    
    <script src="/Study-Tube/guru/sidebar/sidebar.js"></script>
    <script src="script.js"></script>

</body>
</html>