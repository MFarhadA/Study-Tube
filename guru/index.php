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
        <div class="container mt-12 p-3">
            <div class="flex flex-row h-[90vh] space-x-4">

                <!-- Bagian Kiri -->
                <div class="flex flex-row space-x-2">

                    <!-- Pengikut -->
                        <div class="col-rounded-shadow p-3 w-[20%]">
                            <h1 class="font-poppins text-xl mx-auto line-clamp-1 mb-3">Pengikut</h1>

                            <p class="font-roboto font-normal text-lg mx-auto line-clamp-1">total pengikut</p>
                            <h1 class="font-poppins text-4xl mx-auto line-clamp-1 rounded-lg ring-1 ring-gray-200 p-2">600</h1>

                            <p class="font-roboto font-normal text-lg mx-auto line-clamp-1 mb-2">list pengikut</p>
                            <div id="list-pengikut" class="flex flex-col space-y-3 overflow-auto max-h-[calc(100%-180px)] p-1">
                                <div class="flex items-center rounded-lg ring-1 ring-gray-200 p-2">
                                    <div class="flex-shrink-0 overflow-hidden w-[50px] h-[50px] rounded-full bg-white items-center mr-3">
                                        <div class="mx-auto">
                                            <img id="profilePhoto" src="/Study-Tube/assets/foto_profil.jpg">
                                        </div>
                                    </div>
                                    <p class="text-lg font-roboto font-normal line-clamp-1">Guru 1</p>
                                </div>
                            </div>
                        </div>

                    <!-- Rating -->

                        <div class="col-rounded-shadow p-3 w-[20%]">
                        <h1 class="font-poppins text-xl mx-auto line-clamp-1 mb-3">Rating</h1>

                            <p class="font-roboto font-normal text-lg mx-auto line-clamp-1">total rating</p>
                            <h1 class="font-poppins text-4xl mx-auto line-clamp-1 rounded-lg ring-1 ring-gray-200 p-2">5.0</h1>

                            <p class="font-roboto font-normal text-lg mx-auto line-clamp-1 mb-2">list rating</p>
                            <div id="list-rating" class="flex flex-col space-y-3 overflow-auto max-h-[calc(100%-180px)] p-1">
                            <div class="flex items-center rounded-lg ring-1 ring-gray-200 p-2">
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

                <!-- Bagian Kanan -->
                <div class="flex flex-row flex-auto space-x-4">

                    <!-- Video -->

                        <div class="col-rounded-shadow p-2 px-3 w-full">
                            <h1 class="font-poppins text-xl mx-auto line-clamp-1 p-2 mb-2">Video</h1>
                            <div id="list-video" class="flex flex-col space-y-3 overflow-auto max-h-[calc(100%-75px)] p-1">
                                
                            <?php
                                for ($i = 0; $i < 10; $i++) {
                                    echo '
                                <div onclick="location.href=/Study-Tube/siswa/tonton/index.php?" class="w-full h-auto rounded-lg ring-1 ring-gray-200 py-2 px-3 cursor-pointer">
                                    <p class="font-roboto text-black text-ellipsis line-clamp-2 mb-1">
                                        how to make video (real no clickbait) how to make video (real no clickbait) how to make video (real no clickbait)
                                    </p>
                                    <div class="flex items-center space-x-3">
                                        <!-- Thumbnail -->
                                        <div class="overflow-hidden w-[125px] h-[70px] bg-white">
                                            <div class="mx-auto item thumbnail">
                                                <img src="/Study-Tube/assets/video_thumbnail.jpg" alt="" class="w-full h-full object-cover">
                                            </div>
                                        </div>
                                        <!-- Title and Details -->
                                        <div class="flex-1">
                                            <!-- Title -->
                                            
                                            <!-- Views and Koin -->
                                            <div class="flex justify-between items-center">
                                                <div>
                                                    <h1 class="font-roboto font-normal text-black text-sm truncate overflow-hidden">Views</h1>
                                                    <h1 class="font-roboto font-normal text-black text-sm truncate overflow-hidden">Koin</h1>
                                                </div>
                                                <div class="text-right">
                                                    <h1 class="font-roboto font-normal text-black text-sm truncate overflow-hidden">100</h1>
                                                    <h1 class="font-roboto font-normal text-black text-sm truncate overflow-hidden">1</h1>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                ';
                                }
                            ?>

                            </div>
                        </div>


                    <!-- Modul -->

                        <div class="col-rounded-shadow p-2 px-3 w-full">
                            <h1 class="font-poppins text-xl mx-auto line-clamp-1 p-2 mb-2">Modul</h1>
                            <div id="list-modul" class="flex flex-col space-y-3 overflow-auto max-h-[calc(100%-75px)] p-1">
                            
                            <?php
                                for ($i = 0; $i < 10; $i++) {
                                    echo '
                                <div onclick="location.href=/Study-Tube/siswa/tonton/index.php?" class="w-full h-auto rounded-lg ring-1 ring-gray-200 py-2 px-3 cursor-pointer items-center">
                                    <div class="flex flex-1 overflow-hidden rounded-lg mt-1 bg-[#D9534F] px-2 py-1">
                                        <p class="font-roboto text-white text-ellipsis line-clamp-1 pl-2">how to make video (real no clickbait)</p>
                                    </div>
                                    <div class="flex flex-1 justify-between items-center mt-1">
                                        <div>
                                            <h1 class="font-roboto font-normal text-black text-sm truncate overflow-hidden">Unduhan</h1>
                                            <h1 class="font-roboto font-normal text-black text-sm truncate overflow-hidden">Koin</h1>
                                        </div>
                                        <div class="text-right">
                                            <h1 class="font-roboto font-normal text-black text-sm truncate overflow-hidden">100</h1>
                                            <h1 class="font-roboto font-normal text-black text-sm truncate overflow-hidden">1</h1>
                                        </div>
                                    </div>
                                </div>
                                ';
                                }
                            ?>

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